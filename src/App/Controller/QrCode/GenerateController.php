<?php declare(strict_types=1);

namespace App\Controller\QrCode;

use App\DTO\QrCodeGenerator\ContactQrCodeDTO;
use App\DTO\QrCodeGenerator\EmailQrCodeDTO;
use App\DTO\QrCodeGenerator\TextQrCodeDTO;
use App\DTO\QrCodeGenerator\WebsiteQrCodeDTO;
use App\DTO\QrCodeGenerator\WifiQrCodeDTO;
use App\Factory\QrCodeGeneratorFactory;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\QrCodeGenerator\QrCodeGeneratorService;
use App\Service\QrCodeGenerator\QrCodeStringFormatService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class GenerateController
{

    public function __construct(
        private QrCodeGeneratorService $qrCodeGeneratorService,
        private QrCodeStringFormatService $qrCodeStringFormatService,
        private Engine $template
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        /* @var $tool Tool */
        $account = $request->getAttribute(Account::class);
        $tool = $request->getAttribute(Tool::class);

        $modules = ['text', 'website', 'wifi', 'contact', 'email'];
        $module = 'text';
        if(isset($args['module']) && in_array($args['module'], $modules))
        {
            $module = $args['module'];
        }

        $qrCode = [];
        if($request->getMethod() === "POST")
        {
            $qrCode = $this->create($request, $module);
        }

        return new HtmlResponse($this->template->render('qrCodeGenerator/generate',
            ['tool' => $tool, 'module' => $module, 'qrCode' => $qrCode['base64Img'] ?? '', 'data' => $qrCode['data'] ?? '', 'object' => $qrCode['object'] ?? '']
        ));
    }

    public function create(ServerRequestInterface $request, string $module): ?array
    {

        $qrCode = [];
        $qrCode['data'] = '';
        $qrCode['object'] = null;

        if($module === 'text')
        {
            $textDto = new TextQrCodeDTO();
            $textDto->setText($_POST['qrcodeGeneratorTextFormTextareaInput']);

            $qrCode['data']  = $textDto->getText();
            $qrCode['object'] = $textDto;
        }

        if($module === 'website')
        {
            $websiteDto = new WebsiteQrCodeDTO();
            $websiteDto->setWebsite($_POST['qrcodeGeneratorWebsiteInput']);

            $qrCode['data'] = $websiteDto->getWebsite();
            $qrCode['object'] = $websiteDto;
        }

        if($module === "wifi")
        {
            $wifiDto = new WifiQrCodeDTO();
            $wifiDto->setNetworkName($_POST['qrcodeGeneratorWifiFormNetworkNameInput']);

            switch ($_POST['qrcodeGeneratorWifiFormEncryptionSelect'])
            {
                case 'WPA':
                    $wifiDto->setEncryption('WPA');
                    break;
                case 'WEP':
                    $wifiDto->setEncryption('WEP');
                    break;
                default:
                    $wifiDto->setEncryption('nopass');
            }

            $wifiDto->setPassword($_POST['qrcodeGeneratorWifiFormPasswordInput']);
            $wifiDto->setHidden(isset($_POST['qrcodeGeneratorWifiFormHiddenNetwork']));

            $qrCode['data'] = $this->qrCodeStringFormatService->createWifiFormatString($wifiDto);
            $qrCode['object'] = $wifiDto;
        }

        if($module === "contact")
        {
            $contactDto = new ContactQrCodeDTO();
            $contactDto->setForename($_POST['qrcodeGeneratorContactForename']);
            $contactDto->setSurname($_POST['qrcodeGeneratorContactSurname']);
            $contactDto->setOrganisation($_POST['qrcodeGeneratorContactOrganisation']);
            $contactDto->setJob($_POST['qrcodeGeneratorContactJobTitle']);
            $contactDto->setWebsite($_POST['qrcodeGeneratorContactWebsite']);
            $contactDto->setEmail($_POST['qrcodeGeneratorContactEmail']);
            $contactDto->setPhoneMobile($_POST['qrcodeGeneratorContactMobilePhoneNumber']);
            $contactDto->setPhoneLandline($_POST['qrcodeGeneratorContactHomePhoneNumber']);
            $contactDto->setFax($_POST['qrcodeGeneratorContactFaxNumber']);
            $contactDto->setStreet($_POST['qrcodeGeneratorContactStreet']);
            $contactDto->setZipCode($_POST['qrcodeGeneratorContactZipCode']);
            $contactDto->setCity($_POST['qrcodeGeneratorContactCity']);
            $contactDto->setState($_POST['qrcodeGeneratorContactState']);
            $contactDto->setCountry($_POST['qrcodeGeneratorContactCountry']);

            $qrCode['data'] = $this->qrCodeStringFormatService->createContactFormatString($contactDto);
            $qrCode['object'] = $contactDto;
        }

        if($module === "email")
        {
            $emailDto = new EmailQrCodeDTO();
            $emailDto->setRecipient($_POST['qrcodeGeneratorEmailFormEmailRecipientAddressInput']);
            $emailDto->setSubject($_POST['qrcodeGeneratorEmailFormSubjectInput']);
            $emailDto->setMessage($_POST['qrcodeGeneratorEmailFormMessage']);

            $qrCode['data'] = $this->qrCodeStringFormatService->createEmailFormatString($emailDto);
            $qrCode['object'] = $emailDto;
        }

        $qrCode['base64Img'] = $this->qrCodeGeneratorService->createBase64QrCodeFromString($qrCode['data']);

        return $qrCode;

    }

}
