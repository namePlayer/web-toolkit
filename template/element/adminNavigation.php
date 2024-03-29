<div class="col-md-3">
    <div class="list-group mb-3">
        <a href="/admin/dashboard" class="list-group-item list-group-item-action">
            <b><?= $this->e($this->translate('admin-navigation-general-tab-title')) ?></b>
        </a>
        <a href="/admin/accounts" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-general-tab-user-management-title')) ?>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-general-tab-license-management-title')) ?>
        </a>
        <a href="/admin/apikeys" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-general-tab-api-key-management-title')) ?>
        </a>
        <a href="/admin/mails" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-general-tab-mail-title')) ?>
        </a>
        <a href="/admin/support" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-general-tab-support-interface-title')) ?>
        </a>
    </div>
    <div class="list-group mb-3">
        <a href="/admin/tools" class="list-group-item list-group-item-action">
            <b><?= $this->e($this->translate('admin-navigation-tools-tab-title')) ?></b>
        </a>
        <a href="/admin/urlshortener" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-tools-tab-url-shortener-title')) ?>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <?= $this->e($this->translate('admin-navigation-tools-tab-qrcode-generator-title')) ?>
        </a>
    </div>
</div>