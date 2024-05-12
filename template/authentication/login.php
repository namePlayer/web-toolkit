<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/alert') ?>

    <div class="row mt-5 mb-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="mb-4 text-center">
                <h3 class="mb-3"><?= $this->e($this->translate('login-account-title')) ?></h3>
                <span><?= $this->e($this->translate('login-account-header-text')) ?></span> <br>
                <?php if($_ENV['SOFTWARE_DISABLE_REGISTRATION'] === false): ?>
                    <span><?= $this->e($this->translate('login-account-header-no-account-text')) ?> <a href="/authentication/registration"><?= $this->e($this->translate('register-button-text')) ?></a></span>
                <?php endif; ?>
            </div>

            <form action="" method="post">
                <div class="mb-4">
                    <h6><label for="email" class="form-text"><?= $this->e($this->translate('email')) ?></label></h6>
                    <input type="email" class="form-control form-control-md" name="email" id="email" required>
                </div>
                <div class="mb-4">
                    <h6><label for="password" class="form-text"><?= $this->e($this->translate('password')) ?></label></h6>
                    <input type="password" class="form-control form-control-md" name="password" id="password" required>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col-8 d-flex align-items-center">
                        <a href="/authentication/lost-password" class="align-bottom align-text-bottom link-secondary text-decoration-none">
                            <?= $this->e($this->translate('login-forgot-password-link-text')) ?>
                        </a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('login-button-text')) ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>