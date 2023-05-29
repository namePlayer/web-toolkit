<div class="col-md-3">
    <div class="list-group mb-3">
        <a href="#" class="list-group-item disabled">
            <?= $this->e($this->translate('account-settings-navigation-title')) ?>
        </a>
        <a href="/account" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('account-settings-navigation-general-tab-title')) ?>
        </a>
        <a href="/account/security" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('account-settings-navigation-security-tab-title')) ?>
        </a>
        <a href="/account/organisation" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('account-settings-navigation-organisation-tab-title')) ?>
        </a>
        <a href="/account/licenses" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('account-settings-navigation-licenses-tab-title')) ?>
        </a>
    </div>

    <?php if(!empty($showOrganisation)): ?>

        <div class="list-group mb-3">
            <a href="#" class="list-group-item disabled">
                <?= $this->e($this->translate('account-settings-organisation-navigation-title')) ?>
            </a>
            <a href="/account/organisation/accounts" class="list-group-item list-group-item-action">
                <?= $this->e($this->translate('account-settings-organisation-navigation-user-tab-title')) ?>
            </a>
            <a href="/account/organisation/license" class="list-group-item list-group-item-action">
                <?= $this->e($this->translate('account-settings-organisation-navigation-licenses-tab-title')) ?>
            </a>
            <a href="/account/organisation/invite" class="list-group-item list-group-item-action">
                <?= $this->e($this->translate('account-settings-organisation-navigation-invite-tab-title')) ?>
            </a>
        </div>

    <?php endif; ?>
</div>