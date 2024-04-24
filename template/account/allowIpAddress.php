<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-manage-title']); ?>

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
                    <form method="post">
                        <button type="submit" name="allowIpAddress" class="btn btn-outline-secondary w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check2 text-success" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                            IP-Adresse freigeben
                        </button>
                    </form>
                </div>
                <div class="col-3"></div>

            </div>



        </div>

    </div>

</div>
