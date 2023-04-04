<div class="container mb-5 mt-5 position-absolute bottom-0 start-50 translate-middle-x">

    <hr>

    <div class="d-flex align-items-center flex-wrap text-center">

        <div class="p-2 flex-fill order-1">
            Web-Toolkit v<?= \App\Software::VERSION ?> Build <?= \App\Software::BUILD . '-' . \App\Software::TYPE?> <br>
            <span>Github: <a href="https://github.com/namePlayer/web-toolkit" class="link-secondary text-decoration-none">namePlayer/web-toolkit</a></span>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="<?= $_ENV['LEGAL_IMPRINT_URL'] ?>" class="text-center text-decoration-none fw-lighter"><?= $this->e($this->translate('homepage-footer-imprint-title')) ?></a>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="<?= $_ENV['LEGAL_PRIVACY_URL'] ?>" class="text-center text-decoration-none fw-lighter"><?= $this->e($this->translate('homepage-footer-privacy-title')) ?></a> <br>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="<?= $_ENV['LEGAL_TERMS_URL'] ?>" class="text-center text-decoration-none fw-lighter"><?= $this->e($this->translate('homepage-footer-terms-title')) ?></a>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="#" class="text-center text-decoration-none fw-lighter"><?= $this->e($this->translate('homepage-footer-support-title')) ?></a> <br>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="#" class="text-center text-decoration-none fw-lighter"><?= $this->e($this->translate('homepage-footer-status-title')) ?></a>
        </div>
        <div class="p-2 flex-fill order-3">
            <a href="<?= \App\Software::DISCORD_INVITE ?>" class="text-center text-decoration-none fw-lighter">
                <?= $this->e($this->translate('homepage-footer-discord-title')) ?>
            </a>
        </div>
    </div>

</div>
