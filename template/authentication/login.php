<?php $this->layout('basetemplate'); ?>

<div class="container mt-3">

    <?php foreach (MESSAGES->getAll() as $alert): ?>

        <?php $this->insert('element/alert', $alert) ?>

    <?php endforeach; ?>

    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3><?= $_ENV['SOFTWARE_TITLE'] ?></h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <h4><?= $this->e($this->translate('login-account-title')) ?></h4>
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
                                <a href="/authentication/registration">Noch kein Konto?</a> <br>
                                <a href="/authentication/lost-password">Passwort vergessen?</a>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('login-button-text')) ?></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>

</div>