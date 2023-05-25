<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TwoFactor;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class RemoveTwoFactorController
{

    public function __construct(
        private Engine          $template,
        private AccountService  $accountService,
        private SecurityService $securityService,
        private MailerService   $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        $twoFactor = new TwoFactor();
        if (empty($args['id'])) {
            return new RedirectResponse('/account/security');
        }

        $twoFactor->setId((int)$args['id']);
        $twoFactor->setAccount($account->getId());

        $data = $this->securityService->getTwoFactorByIdAndAccount($twoFactor);
        if ($data === FALSE) {
            return new RedirectResponse('/account/security');
        }

        $twoFactor->setToken($data['secret']);

        if ($request->getMethod() === "POST") {
            if ($this->remove($twoFactor)) {
                return new RedirectResponse('/account/security');
            }
        }

        $twoFactor->setName($data['name']);
        $twoFactor->setType($data['type']);

        return new HtmlResponse(
            $this->template->render(
                'account/removeTwoFactor',
                [
                    'twoFactorName' => $twoFactor->getName()
                ]
            ));

    }

    public function remove(TwoFactor $twoFactor): bool
    {

        if (isset($_POST['removeTwoFactorTOTP'], $_POST['removeTwoFactor'])) {
            if ($this->securityService->verifyAccountTwoFactor($twoFactor->getAccount(), $_POST['removeTwoFactorTOTP'])) {
                $this->securityService->removeTwoFactorByIdAndAccount($twoFactor->getId(), $twoFactor->getAccount());
                MESSAGES->add('success', 'account-settings-security-remove-two-factor-success');
                return true;
            }
            MESSAGES->add('danger', 'account-settings-security-remove-two-factor-invalid-code');
        }

        return false;
    }

}
