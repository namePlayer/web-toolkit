<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">

            <div class="row mb-3">
                <div class="col-9">
                    <h4><?= $this->e($this->translate('admin-account-view-title')) ?></h4>
                </div>
            </div>

            <?php $this->insert('administration/element/accountViewNavigation') ?>

            <?php $this->insert('element/alert') ?>

            <hr >
            <div class="tab-content" id="adminAccountViewTabContent">
                <div class="tab-pane fade show active" id="adminAccountViewTabInformationPane" role="tabpanel" aria-labelledby="adminAccountViewTabInformation" tabindex="0">

                    <div class="card mb-3">
                        <div class="card-body row">
                            <div class="col-md-4 text-center mb-lg-3">
                                <span><?= $this->e($this->translate('admin-account-view-info-tab-organisation-title')) ?></span>
                                <h4>
                                    <?= $this->e($this->translate('admin-account-view-info-tab-organisation-none')) ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-lg-3">
                                <span><?= $this->e($this->translate('admin-account-view-info-tab-registered-title')) ?></span>
                                <h4>
                                    <?= $account->getRegistered()->format($this->translate('dateTime-format')) ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-lg-3">
                                <span><?= $this->e($this->translate('admin-account-view-info-tab-last-login-title')) ?></span>
                                <h4>
                                    <?= $account->getLastLogin() === NULL
                                        ? $this->e($this->translate('admin-account-view-info-tab-last-login-never'))
                                        : $account->getLastLogin()->format($this->translate('dateTime-format'))
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <form method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="adminAccountTabSettingsAccountName" class="form-label">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-account-name')) ?>
                                </label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsAccountName" name="adminAccountTabSettingsAccountName" value="<?= $account->getName(); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adminAccountTabSettingsFirstname" class="form-label">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-firstname')) ?>
                                </label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsFirstname" name="adminAccountTabSettingsFirstname" value="<?= $account->getFirstname(); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adminAccountTabSettingsSurname" class="form-label">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-lastname')) ?>
                                </label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsSurname" name="adminAccountTabSettingsSurname" value="<?= $account->getSurname(); ?>">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="adminAccountTabSettingsEmail" class="form-label">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-email')) ?>
                                </label>
                                <input type="email" class="form-control" id="adminAccountTabSettingsEmail" name="adminAccountTabSettingsEmail" value="<?= $account->getEmail(); ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="adminAccountTabSettingsLevel" class="form-label">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-level')) ?>
                                </label>
                                <select class="form-select" aria-label="Default select example" name="adminAccountTabSettingsAccountLevel">
                                    <?php foreach($levels as $item): ?>
                                        <option value="<?= $item['id'] ?>" <?= $account->getLevel() === $item['id'] ? 'selected' : '' ?>>
                                            <?= $this->e($this->translate($item['title'])) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsActive"
                                        <?= $account->isAdmin() ? 'onclick="this.checked=!this.checked;" ' : '' ?>
                                        <?= $account->isActive() ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-enable-account')) ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsSupport"
                                        <?= $account->isSupport() || $account->isAdmin() ? 'checked' : '' ?> disabled>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-enable-support')) ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsAdmin"
                                        <?= $account->isAdmin() ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-enable-admin')) ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2">

                                <button type="submit" class="w-100 btn btn-primary" name="adminAccountTabSettingsSaveButton">
                                    <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-save-button')) ?>
                                </button>

                            </div>
                        </div>

                    </form>

                    <hr>

                    <form class="row mt-3" method="post">
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-primary" name="adminAccountTabSettingsResendActivationMailButton">
                                <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-resend-activation-mail-button')) ?>
                            </button>

                        </div>
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-danger" name="adminAccountTabSettingsResetPasswordMailButton">
                                <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-send-password-mail-button')) ?>
                            </button>

                        </div>
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-danger" name="adminAccountTabSettingsResetTFAButton">
                                <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-reset-two-factor-button')) ?>
                            </button>

                        </div>
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-danger" name="adminAccountTabSettingsDeleteAccountButton" <?= $account->isAdmin() ? 'disabled' : '' ?>>
                                <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-delete-account-button')) ?>
                            </button>

                        </div>
                    </form>

                </div>

                <div class="tab-pane fade" id="adminAccountViewTabOrganisationPane" role="tabpanel" aria-labelledby="adminAccountViewTabOrganisation" tabindex="0">

                </div>
            </div>
        </div>
    </div>
</div>
