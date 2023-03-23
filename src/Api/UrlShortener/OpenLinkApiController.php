<?php declare(strict_types=1);

namespace Api\UrlShortener;

use App\Http\JsonResponse;
use App\Model\UrlShortener\Shortlink;
use App\Model\UrlShortener\ShortlinkTracking;
use App\Service\ApiKey\ApiKeyService;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkPasswordService;
use App\Service\UrlShortener\ShortlinkService;
use App\Service\UrlShortener\ShortlinkTrackingService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OpenLinkApiController
{

    public function __construct(
        private readonly ApiKeyService $apiKeyService,
        private readonly ShortlinkDomainService $shortlinkDomainService,
        private readonly ShortlinkService $shortlinkService,
        private readonly ShortlinkPasswordService $shortlinkPasswordService,
        private readonly ShortlinkTrackingService $shortlinkTrackingService
    )
    {
    }

    public function access(ServerRequestInterface $request): ResponseInterface
    {

        $input = json_decode(file_get_contents('php://input'), true);

        if(!isset($input['shortcode'], $input['domain']))
        {
            return new JsonResponse(400, [], 'missing-instructions');
        }

        $domain = $this->shortlinkDomainService->getByDomain($input['domain']);
        if($domain === FALSE || $domain['verified'] === 0 || $domain['disabled'] === 1)
        {
            return new JsonResponse(404, [], 'domain-not-registered');
        }

        $shortlink = new Shortlink();
        $shortlink->setDomain($domain['id']);
        $shortlink->setUuid($input['shortcode']);

        $this->shortlinkService->openShortlink($shortlink);

        if($shortlink->isTracking() && !isset($input['client']['ip']) && !isset($input['client']['useragent']))
        {
            return new JsonResponse(400, [], 'client-information-missing');
        }

        if(empty($shortlink->getDestination()))
        {
            return new JsonResponse(404, [], 'shortlink-not-found');
        }

        if($shortlink->getExpiryDate() !== NULL && $shortlink->getExpiryDate() <= new \DateTime())
        {
            return new JsonResponse(400, [], 'link-expired');
        }

        if($shortlink->getPassword() !== NULL)
        {
            if(isset($input['password']))
            {
                if($this->shortlinkPasswordService->verifyPassword($input['password'], $shortlink->getPassword()))
                {
                    return $this->respond($request, $shortlink, $input['client']);
                }
            }

            return new JsonResponse(400, [], 'password-required');
        }

        return $this->respond($request, $shortlink, $input['client']);

    }

    private function respond(ServerRequestInterface $request, Shortlink $shortlink, array $userInformation): ResponseInterface
    {
        if($shortlink->isTracking())
        {
            $tracking = new ShortlinkTracking();
            $tracking->setUserIp($userInformation['ip']);
            $tracking->setUseragent($userInformation['useragent']);
            $tracking->setLink($shortlink->getId());
            $tracking->setAccessed(new \DateTime());

            $this->shortlinkTrackingService->track($tracking);
        }

        return new JsonResponse(200, ['destination' => $shortlink->getDestination()], 'success');
    }

}
