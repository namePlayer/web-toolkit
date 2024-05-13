<ul class="nav nav-underline mb-3" id="adminAccountViewTab" role="tablist">
    <li class="nav-item">
        <span class="nav-link disabled">Kontoverwaltung</span>
    </li>
    <div class="vr"></div>
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="adminAccountViewTabInformation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabInformationPane" type="button" role="tab" aria-controls="adminAccountViewTabInformationPane" aria-selected="true">
            <?= $this->e($this->translate('admin-account-view-navigation-info-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button disabled class="nav-link disabled" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-licenses-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button disabled class="nav-link disabled" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-support-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="adminAccountViewTabOrganisation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabOrganisationPane" type="button" role="tab" aria-controls="adminAccountViewTabOrganisationPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-organisation-tab-title')) ?>
        </button>
    </li>
    <li class="ms-auto nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Aktionen</a>
        <form action="" method="post">
            <ul class="dropdown-menu">
                <li>
                    <button type="submit" class="btn w-100" name="adminAccountTabSettingsResendActivationMailButton">
                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-resend-activation-mail-button')) ?>
                    </button>
                </li>
                <li>
                    <button type="submit" class="btn w-100" name="adminAccountTabSettingsResetPasswordMailButton">
                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-send-password-mail-button')) ?>
                    </button>
                </li>
                <li>
                    <button type="submit" class="btn w-100" name="adminAccountTabSettingsResetTFAButton">
                        <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-reset-two-factor-button')) ?>
                    </button>
                </li>
                <?php if(!$account->isAdmin()): ?>
                    <li>
                        <button type="submit" class="btn w-100" name="adminAccountTabSettingsDeleteAccountButton">
                            <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-delete-account-button')) ?>
                        </button>
                    </li>
                <?php endif; ?>
            </ul>
        </form>
    </li>

</ul>
