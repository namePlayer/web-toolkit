<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\Http\HtmlResponse;
use App\Service\Security\SecurityKeyService;
use App\Service\UrlShortener\ShortlinkDomainService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class DomainManagementController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkDomainService $shortlinkDomainService,
        private SecurityKeyService     $securityKeyService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if(empty((int)$args['id']))
        {
            return new RedirectResponse('/admin/urlshortener/alldomains');
        }

        $domainInformation = $this->shortlinkDomainService->getById((int)$args['id']);
        if(empty($domainInformation))
        {
            return new RedirectResponse('/admin/urlshortener/alldomains');
        }

        if($request->getMethod() === 'POST')
        {
            $update = $this->stateChange($domainInformation);
            if(is_array($update))
            {
                $domainInformation = $update;
            }
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/domainManagement',
                [
                    'data' => $domainInformation
                ]
            )
        );
    }

    private function stateChange(array $domainInformation): ?array
    {

        if(isset($_POST['verifyDomain']))
        {
            if($domainInformation['verified'] === 0)
            {
                if($this->shortlinkDomainService->changeVerificationState($domainInformation['id'], true))
                {
                    $domainInformation['verified'] = 1;
                }
                return $domainInformation;
            }
        }

        if(isset($_POST['toggleDomainActivation']))
        {
            if($domainInformation['disabled'] === 1)
            {
                if($this->shortlinkDomainService->changeDisabledState($domainInformation['id'], false))
                {
                    $domainInformation['disabled'] = 0;
                    return $domainInformation;
                }
                return null;
            }

            if($this->shortlinkDomainService->changeDisabledState($domainInformation['id'], true))
            {
                $this->shortlinkDomainService->changeVerificationState($domainInformation['id'], false);
                $domainInformation['disabled'] = 1;
                $domainInformation['verified'] = 0;
                return $domainInformation;
            }
        }

        return null;
    }

}
