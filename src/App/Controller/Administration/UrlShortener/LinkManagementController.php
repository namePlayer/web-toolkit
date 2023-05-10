<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\DTO\UrlShortener\ShortlinkDeleteDTO;
use App\Http\HtmlResponse;
use App\Service\Security\SecurityKeyService;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use App\Service\UrlShortener\ShortlinkTrackingService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LinkManagementController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkService       $shortlinkService,
        private ShortlinkDomainService $shortlinkDomainService,
        private ShortlinkTrackingService $shortlinkTrackingService,
        private SecurityKeyService      $securityKeyService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if(empty((int)$args['id']))
        {
            return new RedirectResponse('/admin/urlshortener/alllinks');
        }

        $linkInformation = $this->shortlinkService->getShortlinkById((int)$args['id']);
        if($linkInformation === FALSE || $linkInformation === null)
        {
            return new RedirectResponse('/admin/urlshortener/alllinks');
        }

        if($request->getMethod() === "POST")
        {
            $disable = $this->disable((int)$args['id']);
            if($disable instanceof ResponseInterface)
            {
                return $disable;
            }
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/linkManagement',
                [
                    'data' => $linkInformation,
                    'domain' => $linkInformation->getDomain() !== null
                        ? $this->shortlinkDomainService->getDomainNameByID($linkInformation->getDomain())
                        : null,
                    'tracking' => $linkInformation->isTracking()
                        ? $this->shortlinkTrackingService->getLastClicksForLink($linkInformation->getId(), 25)
                        : null,
                    'clickCount' => $this->shortlinkTrackingService->getClickCountForLink($linkInformation->getId()),
                    'deleteCode' => $this->securityKeyService->generate()
                ]
            )
        );
    }

    public function disable(int $id): ?ResponseInterface
    {

        if(isset($_POST['deleteShortlinkModalConfirmationSubmit'], $_POST['deleteShortlinkModalConfirmationCode'], $_POST['deleteShortlinkModalConfirmationCodeInput']))
        {

            $shortlinkDeleteDTO = new ShortlinkDeleteDTO();
            $shortlinkDeleteDTO->setId($id);
            $shortlinkDeleteDTO->setVerificationCode($_POST['deleteShortlinkModalConfirmationCode']);
            $shortlinkDeleteDTO->setInput($_POST['deleteShortlinkModalConfirmationCodeInput']);

            if($this->shortlinkService->deleteShortlink($shortlinkDeleteDTO))
            {
                return new RedirectResponse('/admin/urlshortener/alllinks');
            }

        }

        return null;
    }

}
