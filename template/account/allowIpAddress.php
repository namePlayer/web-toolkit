<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-12">
            <h2><?= $this->e($this->translate('account-manage-title')) ?></h2>
            <?php if($this->getAccountInformation()['business'] !== NULL): ?>
                <small class="text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    <?= $this->e($this->translate('managed-by-organisation-extended-information-settings')) ?> <a href="/authentication/-account/organisation"><?= $this->e($this->translate('learn-more')) ?></a>
                </small>
            <?php endif; ?>
        </div>
    </div>
    <hr>

    <div class="row mt-3">

        <?php $this->insert('element/accountSettingNavigation') ?>

        <div class="col-md-9">

            <h3>
                <?= $this->e($this->translate('account-settings-navigation-security-allow-ip-address-title')) ?>
            </h3>
            <p class="mb-4"><?= $this->e($this->translate('account-settings-navigation-security-allow-ip-address-note')) ?></p>

            <?php $this->insert('element/alert') ?>

            <div class="row mb-3">

                <div class="col-12 mb-2">
                    <h4 class="text-center"><?= $ipAddress ?></h4>
                </div>

                <div class="col-3"></div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check2 text-success" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                        IP-Adresse freigeben
                    </button>
                </div>
                <div class="col-3"></div>

            </div>



        </div>

    </div>

</div>
