<div class="container mb-5 mt-5">

    <hr>

    <div class="row">

        <div class="col-2 text-center">
            <a href="#" class="text-center"><?= $this->e($this->translate('homepage-footer-imprint-title')) ?></a>
        </div>
        <div class="col-2 text-center">
            <a href="#" class="text-center"><?= $this->e($this->translate('homepage-footer-privacy-title')) ?></a> <br>
            <a href="#" class="text-center"><?= $this->e($this->translate('homepage-footer-terms-title')) ?></a>
        </div>
        <div class="col-4 text-center">
            Web-Toolkit v<?= \App\Software::VERSION ?> Build <?= \App\Software::BUILD . '-' . \App\Software::TYPE?> <br>
            <span>Github: <a href="https://github.com/namePlayer/web-toolkit" class="link-secondary text-decoration-none">namePlayer/web-toolkit</a></span>
        </div>
        <div class="col-2 text-center">
            <a href="#" class="text-center"><?= $this->e($this->translate('homepage-footer-support-title')) ?></a> <br>
            <a href="#" class="text-center"><?= $this->e($this->translate('homepage-footer-status-title')) ?></a>
        </div>
        <div class="col-2 text-center">
            <a href="<?= \App\Software::DISCORD_INVITE ?>" class="text-center">
                <?= $this->e($this->translate('homepage-footer-discord-title')) ?>
            </a>
        </div>
    </div>

</div>
