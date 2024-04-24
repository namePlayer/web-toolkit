<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-manage-title']); ?>

    <div class="row mt-3">

        <?php $this->insert('element/accountSettingNavigation') ?>

        <div class="col-md-9">

            <div class="row mb-3">
                <div class="col-8">
                    <h3><?= $this->e($this->translate('account-settings-navigation-general-tab-title')) ?></h3>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <span>Kundennummer: <b><?= $this->e($accountData['id']) ?></b></span>
                </div>
                <div class="col-12">
                    <?php $this->insert('element/alert') ?>
                </div>
            </div>
            <form action="" method="post">
                <div class="row">

                    <div class="col-12 mb-3">
                        <label for="accountUserAccountname" class="form-label">
                            <?= $this->e($this->translate('account-settings-general-accountname')) ?>
                        </label>
                        <input type="text" class="form-control" id="accountUserAccountname" name="accountUserAccountname" value="<?= $this->e($accountData['name']) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="accountUserFirstname" class="form-label">
                            <?= $this->e($this->translate('account-settings-general-firstname')) ?>
                        </label>
                        <input type="text" class="form-control" id="accountUserFirstname" name="accountUserFirstname" value="<?= $this->e($accountData['firstname']) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="accountUserLastname" class="form-label">
                            <?= $this->e($this->translate('account-settings-general-lastname')) ?>
                        </label>
                        <input type="text" class="form-control" id="accountUserLastname" name="accountUserLastname" value="<?= $this->e($accountData['surname']) ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="accountUserEmail" class="form-label">
                            <?= $this->e($this->translate('account-settings-general-email')) ?>
                        </label>
                        <input type="email" class="form-control" id="accountUserEmail" name="accountUserEmail" value="<?= $this->e($accountData['email']) ?>">
                    </div>

                    <div class="col-3">
                        <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#accountSettingsChangePasswordModal">
                            <?= $this->e($this->translate('account-settings-change-password-button')) ?>
                        </button>
                    </div>
                    <div class="col-5"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $this->e($this->translate('save-button')) ?>
                        </button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="accountSettingsChangePasswordModal" tabindex="-1" aria-labelledby="accountSettingsChangePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="accountSettingsChangePasswordModalLabel">
                        <?= $this->e($this->translate('account-settings-change-password-modal-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="accountSettingsChangePasswordOldPassword" class="form-label">
                            <?= $this->e($this->translate('account-settings-change-password-old-password')) ?>
                        </label>
                        <input type="password" class="form-control" id="accountSettingsChangePasswordOldPassword" name="accountSettingsChangePasswordOldPassword">
                    </div>
                    <div class="mb-3">
                        <label for="accountSettingsChangePasswordOldPassword" class="form-label">
                            <?= $this->e($this->translate('account-settings-change-password-new-password')) ?>
                        </label>
                        <input type="password" class="form-control" id="accountSettingsChangePasswordNewPassword" name="accountSettingsChangePasswordNewPassword">
                    </div>
                    <div class="mb-3">
                        <label for="accountSettingsChangePasswordOldPassword" class="form-label">
                            <?= $this->e($this->translate('account-settings-change-password-repeat-new-password')) ?>
                        </label>
                        <input type="password" class="form-control" id="accountSettingsChangePasswordRepeatNewPassword" name="accountSettingsChangePasswordRepeatNewPassword">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary" name="accountSettingsChangePasswordSubmit">
                        <?= $this->e($this->translate('save-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
