<footer class="footer mt-auto py-3">
    <div class="container">
        <hr class="mt-4 mb-4">
        <div class="row">
            <div class="col-12 col-md">
                Web-Toolkit v<?= \App\Software::VERSION ?> <br> Build <?= \App\Software::BUILD . '-' . \App\Software::TYPE?> <br>
                <small class="d-block mb-3 text-body-secondary">© <?= (new DateTime())->format('Y') ?></small> <br>
            </div>
            <div class="col-6 col-md">
            </div>
            <div class="col-6 col-md">
                <h5><?= $this->e($this->translate('homepage-footer-about-header-title')) ?></h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="#" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-support-title')) ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= \App\Software::DISCORD_INVITE ?>" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-discord-title')) ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-status-title')) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5><?= $this->e($this->translate('homepage-footer-legal-header-title')) ?></h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="<?= $_ENV['LEGAL_IMPRINT_URL'] ?>" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-imprint-title')) ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['LEGAL_PRIVACY_URL'] ?>" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-privacy-title')) ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['LEGAL_TERMS_URL'] ?>" class="text-center text-decoration-none fw-lighter">
                            <?= $this->e($this->translate('homepage-footer-terms-title')) ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
