<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-manage-title']); ?>

    <div class="row mt-3">

        <?php $this->insert('element/accountSettingNavigation') ?>

        <div class="col-md-9">

            <h3>
                <?= $this->e($this->translate('account-settings-security-remove-two-factor-title')) ?>
            </h3>
            <p class="mb-4"><?= $this->e($this->translate('account-settings-security-remove-two-factor-note')) ?></p>

            <?php $this->insert('element/alert') ?>

            <form method="post">
                <div class="row mb-3">

                    <div class="col-12 mb-2">
                        <h4 class="text-center"><?= $twoFactorName ?></h4>
                    </div>

                    <div class="col-3"></div>
                    <div class="col-6">

                        <div class="mb-3">

                            <label class="form-label" for="removeTwoFactorTOTP">Sicherheitscode</label>
                            <input type="text" class="form-control" id="removeTwoFactorTOTP" name="removeTwoFactorTOTP">

                        </div>

                    </div>
                    <div class="col-3"></div>

                    <div class="col-3"></div>
                    <div class="col-6">
                            <button type="submit" name="removeTwoFactor" class="btn btn-outline-secondary w-100 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill text-danger" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                                2. Faktor entfernen
                            </button>
                    </div>
                    <div class="col-3"></div>

                </div>
            </form>



        </div>

    </div>

</div>
