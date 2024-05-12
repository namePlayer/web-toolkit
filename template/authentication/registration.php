<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/alert') ?>

    <div class="row mt-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?php if(($_ENV['SOFTWARE_ENABLE_REGISTRATION'] ?? true) === true): ?>
                <div class="mb-4 text-center">
                    <h3 class="mb-3"><?= $this->e($this->translate('create-account-title')) ?></h3>
                    <span><?= $this->e($this->translate('create-account-text')) ?></span> <br>
                    <span><?= $this->e($this->translate('create-account-header-already-account-text')) ?> <a href="/authentication/login"><?= $this->e($this->translate('login-button-text')) ?></a></span>
                </div>
                <form action="" method="post">
                    <div class="mb-4 mt-4">
                        <h6><label for="account-type" class="form-text"><?= $this->e($this->translate('create-account-for')) ?></label></h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="account-type" id="account-type-1 account-type" value="private" checked>
                            <label class="form-check-label" for="account-type-1 account-type"><?= $this->e($this->translate('for-private-account')) ?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="account-type" id="account-type-2" value="business">
                            <label class="form-check-label" for="account-type-2"><?= $this->e($this->translate('for-company-account')) ?></label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6><label for="email" class="form-text"><?= $this->e($this->translate('account-name')) ?></label></h6>
                        <input type="text" class="form-control" name="account-name" id="account-name" required>
                    </div>
                    <div class="mb-4">
                        <h6><label for="email" class="form-text"><?= $this->e($this->translate('email')) ?></label></h6>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-4">
                        <h6><label for="password" class="form-text"><?= $this->e($this->translate('password')) ?></label></h6>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-8 d-flex align-items-center">

                            <small class="text-muted">
                                <?= $this->e($this->translate('create-account-tos-privacy-information')) ?>
                            </small>

                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('register-button-text')) ?></button>
                        </div>
                    </div>
                </form>
            <?php else: ?>

                <div class="text-center mt-5 mb-5   ">
                    <?= $this->e($this->translate('create-account-disabled')) ?>
                    <br>
                    <br>
                    <?= $this->e($this->translate('page-goto-string')) ?>
                    <a href="/authentication/login" class="text-decoration-none">
                        <?= $this->e($this->translate('login-page-title')) ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </a>
                </div>

            <?php endif; ?>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>