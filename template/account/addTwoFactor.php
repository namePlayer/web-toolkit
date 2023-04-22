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

            <h3 class="mb-3"><?= $this->e($this->translate('account-settings-add-second-factor-general-tab-title')) ?></h3>

            <?php $this->insert('element/alert') ?>

            <div class="row mt-3">

                <div class="col-4">
                    <?= $totpQrCode ?>

                    <?= $totpToken ?>
                </div>

                <div class="col-8">

                    <p class="mb-2"><?= $this->e($this->translate('account-settings-add-second-factor-totp-apps-note')) ?></p>
                    <ul>
                        <li>Google Authenticator</li>
                        <li>Authy</li>
                    </ul>

                    <hr>

                    <form method="post">

                        <input type="hidden" name="twoFactorToken" value="<?= $totpToken ?>">
                        <input type="hidden" name="addTwoFactorModalName" value="<?= $twoFactorName ?>">

                        <div class="mb-3">
                            <label for="addTwoFactorModalName" class="form-label"><?= $this->e($this->translate('account-settings-security-two-factor-name')) ?></label>
                            <input type="text" class="form-control" id="addTwoFactorModalName" value="<?= $twoFactorName ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="addTwoFactorTotpTFACode" class="form-label"><?= $this->e($this->translate('account-settings-security-two-factor-generated-code')) ?></label>
                            <input type="text" class="form-control" id="addTwoFactorTotpTFACode" name="addTwoFactorTotpTFACode" placeholder="000000">
                        </div>

                        <div class="row">
                            <div class="col-9">

                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary w-100" name="addTwoFactorModalSubmit"><?= $this->translate('add-button') ?></button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
