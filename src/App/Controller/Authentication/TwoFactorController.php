<?php declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Mail\MailType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class TwoFactorController
{

    public function __construct(
        private Engine $template,
        private SecurityService $securityService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(!$this->securityService->accountHasTwoFactorEnabled($account->getId()))
        {
            return new RedirectResponse('/overview');
        }

        if ($request->getMethod() === "POST") {
            if($this->authenticate($account->getId()))
            {

                if(isset($_GET['redirect'])) {
                    return new RedirectResponse($_GET['redirect']);
                }

                return new RedirectResponse('/overview');
            }
        }

        return new HtmlResponse($this->template->render('authentication/twoFactor'));
    }

    public function authenticate(int $account): bool
    {
        if(isset($_POST['totpCodeLoginTFA']))
        {
            if($this->securityService->verifyAccountTwoFactor($account, $_POST['totpCodeLoginTFA']))
            {
                MESSAGES->add('success', 'two-factor-authentication-success');
                $_SESSION[Software::SESSION_TFA_NAME] = $_POST['totpCodeLoginTFA'];
                return true;
            }

            MESSAGES->add('danger', 'two-factor-authentication-failed');
        }
        return false;
    }

}
