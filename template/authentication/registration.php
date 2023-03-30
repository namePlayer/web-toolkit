<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/alert') ?>

    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
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

                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('register-button-text')) ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4"></div>
    </div>

</div>