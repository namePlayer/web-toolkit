<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/alert') ?>

    <div class="row mt-5 mb-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="mb-4 text-center">
                <h3 class="mb-3"><?= $this->e($this->translate('two-factor-authentication-title')) ?></h3>
                <span><?= $this->e($this->translate('two-factor-authentication-description')) ?></span>
            </div>

            <form action="" method="post">
                <div class="mb-4">
                    <h6><label for="totpCodeLoginTFA" class="form-text"><?= $this->e($this->translate('totp-code')) ?></label></h6>
                    <input type="text" class="form-control form-control-md" name="totpCodeLoginTFA" id="totpCodeLoginTFA" required>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col-7 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        <a href="/authentication/login" class="align-bottom align-text-bottom link-secondary text-decoration-none">
                            <?= $this->e($this->translate('two-factor-back-to-login-text')) ?>
                        </a>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('two-factor-authenticate-button')) ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>
