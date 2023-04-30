<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\DTO\UrlShortener\ShortlinkSearchDTO;
use App\Http\HtmlResponse;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AllLinksController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkService       $shortlinkService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/allLinks',
                [
                    'lastShortlinkList' => $this->search($request)
                ]
            )
        );
    }

    private function search(ServerRequestInterface $request): array
    {
        if($request->getMethod() !== "POST")
        {
            return $this->shortlinkService->getAllShortlinksByLimit(25);
        }

        $searchDTO = new ShortlinkSearchDTO();
        $searchDTO->setId(empty($_POST['adminSearchShortlinkModalId']) ? 0 : (int)$_POST['adminSearchShortlinkModalId']);
        $searchDTO->setAccount(empty($_POST['adminSearchShortlinkModalAccount']) ? 0 : (int)$_POST['adminSearchShortlinkModalAccount']);
        $searchDTO->setDomain(empty($_POST['adminSearchShortlinkModalDomain']) ? '' : (string)$_POST['adminSearchShortlinkModalDomain']);
        $searchDTO->setShortcode(empty($_POST['adminSearchShortlinkModalShortcode']) ? '' : (string)$_POST['adminSearchShortlinkModalShortcode']);
        $searchDTO->setResultLimit(empty($_POST['adminSearchShortlinkModalLimit']) ? 25 : (int)$_POST['adminSearchShortlinkModalLimit']);

        return $this->shortlinkService->search($searchDTO);
    }

}
