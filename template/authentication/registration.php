<?php $this->layout('basetemplate'); ?>

<div class="container mt-3">

    <?php foreach (MESSAGES->getAll() as $alert): ?>

        <?php $this->insert('element/alert', $alert) ?>

    <?php endforeach; ?>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h2><?= $this->e($this->translate('login-account-title')) ?></h2>
            <form action="" method="post">

                <div class="mb-3 mt-4">
                    <span><?= $this->e($this->translate('create-account-for')) ?></span><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="account-type" id="account-type-1" value="private" checked>
                        <label class="form-check-label" for="account-type-1"><?= $this->e($this->translate('for-private-account')) ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="account-type" id="account-type-2" value="business">
                        <label class="form-check-label" for="account-type-2"><?= $this->e($this->translate('for-company-account')) ?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-text"><?= $this->e($this->translate('account-name')) ?></label>
                    <input type="text" class="form-control" name="account-name" id="account-name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-text"><?= $this->e($this->translate('email')) ?></label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-text"><?= $this->e($this->translate('password')) ?></label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary"><?= $this->e($this->translate('register-button-text')) ?></button>

            </form>
        </div>
        <div class="col-4"></div>
    </div>

</div>