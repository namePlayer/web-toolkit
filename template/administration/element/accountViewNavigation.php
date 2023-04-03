<ul class="nav nav-pills mb-3" id="adminAccountViewTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="adminAccountViewTabInformation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabInformationPane" type="button" role="tab" aria-controls="adminAccountViewTabInformationPane" aria-selected="true">
            <?= $this->e($this->translate('admin-account-view-navigation-info-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-settings-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button disabled class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-licenses-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button disabled class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-support-tab-title')) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="adminAccountViewTabOrganisation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabOrganisationPane" type="button" role="tab" aria-controls="adminAccountViewTabOrganisationPane" aria-selected="false">
            <?= $this->e($this->translate('admin-account-view-navigation-organisation-tab-title')) ?>
        </button>
    </li>
</ul>
