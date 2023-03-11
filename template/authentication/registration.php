<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php foreach (MESSAGES->getAll() as $alert): ?>

        <?php $this->insert('element/alert', $alert) ?>

    <?php endforeach; ?>

    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4><?= $this->e($this->translate('create-account-title')) ?></h4>
                </div>
                <div class="card-body">
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
                        <div class="row">
                            <div class="col-8">
                                <a href="/authentication/login">Bereits ein Konto?</a> <br>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('register-button-text')) ?></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>

</div>