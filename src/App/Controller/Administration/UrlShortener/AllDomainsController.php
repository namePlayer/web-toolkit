<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\DTO\UrlShortener\ShortlinkDomainSearchDTO;
use App\Http\HtmlResponse;
use App\Service\UrlShortener\ShortlinkDomainService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AllDomainsController
{

    public function __construct(
        private readonly Engine                 $template,
        private readonly ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/allDomains',
                [
                    'domainList' => $this->search()
                ]
            )
        );
    }

    private function search(): array
    {

        $domainSearchDTO = new ShortlinkDomainSearchDTO();

        if (!empty($_POST['adminSearchShortlinkDomainModalId'])) {
            $domainSearchDTO->setId((int)$_POST['adminSearchShortlinkDomainModalId']);
        }

        if (!empty($_POST['adminSearchShortlinkDomainModalAccount'])) {
            $domainSearchDTO->setAccount((int)$_POST['adminSearchShortlinkDomainModalAccount']);
        }

        if (!empty($_POST['adminSearchShortlinkDomainModalAddress'])) {
            $domainSearchDTO->setAddress($_POST['adminSearchShortlinkDomainModalAddress']);
        }

        if (!empty($_POST['adminSearchShortlinkDomainModalLimit'])) {
            $domainSearchDTO->setLimit((int)$_POST['adminSearchShortlinkDomainModalLimit']);
        }

        return $this->shortlinkDomainService->getAllDomains($domainSearchDTO);
    }

}
