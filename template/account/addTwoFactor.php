<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-manage-title']); ?>

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
