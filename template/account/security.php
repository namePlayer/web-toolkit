<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-manage-title']); ?>

    <div class="row mt-3">

        <?php $this->insert('element/accountSettingNavigation') ?>

        <div class="col-md-9">

            <h3 class="mb-4">
                <?= $this->e($this->translate('account-settings-navigation-security-tab-title')) ?>
            </h3>

            <?php $this->insert('element/alert') ?>

            <div class="row mb-3">
                <div class="col-12 mb-1">
                    <h5><?= $this->e($this->translate('account-settings-security-general')) ?></h5>
                </div>
                <form method="post" class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="sendLoginEmailCheck" name="sendLoginEmailCheck"
                                <?= $account['sendMailUnknownLogin'] === 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="sendLoginEmailCheck">
                                    <?= $this->e($this->translate('account-settings-security-general-send-login-information-mail')) ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary float-end" name="securityBasicSettingsSave">
                            <?= $this->e($this->translate('save-button')) ?>
                        </button>
                    </div>

                </form>
            </div>

            <div class="row mb-3">
                <div class="col-9 mb-3">
                    <h5>
                        <?= $this->e($this->translate('account-settings-security-two-factor')) ?>
                    </h5>
                </div>
                <div class="col-3 mb-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addTwoFactorModal">
                        <?= $this->e($this->translate('account-settings-security-two-factor-add-button')) ?>
                    </button>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <?= $this->e($this->translate('account-settings-security-two-factor-table-name')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('account-settings-security-two-factor-table-type')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('account-settings-security-two-factor-table-added')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('account-settings-security-two-factor-table-remove')) ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($twoFactors !== FALSE): ?>

                                <?php foreach($twoFactors as $twoFactor): ?>

                                    <tr>
                                        <th scope="row"><?= $twoFactor['name'] ?></th>
                                        <td>TOTP</td>
                                        <td>
                                            <?= (new DateTime($twoFactor['created']))->format($this->translate('dateTime-format')) ?>
                                        </td>
                                        <td>
                                            <a href="/account/security/removetwofactor/<?= $twoFactor['id'] ?>" class="text-danger text-decoration-none">
                                                <?= $this->e($this->translate('remove-button')) ?>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-9 mb-3">
                    <h5>
                        <?= $this->e($this->translate('account-settings-security-verified-ips')) ?>
                    </h5>
                    <small>
                        <?= $this->e($this->translate('account-settings-security-verified-ips-note')) ?>
                    </small>
                </div>
                <div class="col-3 mb-3">
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">
                                <?= $this->e($this->translate('account-settings-security-verified-ips-table-ip')) ?>
                            </th>
                            <th scope="col">
                                <?= $this->e($this->translate('account-settings-security-verified-ips-table-allowed-at')) ?>
                            </th>
                            <th scope="col">
                                <?= $this->e($this->translate('account-settings-security-verified-ips-remove')) ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allowedAddresses as $allowedAddress): ?>

                                <tr>
                                    <th scope="row"><?= $allowedAddress['ipAddress'] ?></th>
                                    <td><?= (new DateTime($allowedAddress['allowed']))->format($this->translate('dateTime-format')); ?></td>
                                    <td>
                                        <a href="#" class="text-danger text-decoration-none"><?= $this->e($this->translate('remove-button')) ?></a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>

</div>

<form method="post" action="/account/security/addtwofactor">
    <div class="modal fade" id="addTwoFactorModal" tabindex="-1" aria-labelledby="addTwoFactorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTwoFactorModalLabel"><?= $this->e($this->translate('account-settings-security-two-factor-add')) ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addTwoFactorModalName" class="form-label"><?= $this->e($this->translate('account-settings-security-two-factor-name')) ?></label>
                        <input type="text" class="form-control" id="addTwoFactorModalName" name="addTwoFactorModalName" value="Web-Toolkit">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= $this->e($this->translate('close-button')) ?></button>
                    <button type="submit" class="btn btn-primary" name="addTwoFactorModalSubmit"><?= $this->e($this->translate('save-button')) ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
