<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row mt-3">

        <div class="col-md-3 mb-4">
            <?php $this->insert('element/accountSettingNavigation', ['ignoreCol' => '']) ?>
        </div>

        <div class="col-md-9">
            <div class="row mb-4">
                <div class="col-md-8 mb-3">
                    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-address-page-title']); ?>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-outline-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                        <?= $this->e($this->translate('account-address-page-add-new-address')) ?>
                    </button>
                </div>
            </div>

            <div class="row">

                <div class="col-4 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <span><b>Max Mustermann</b></span> <br>
                            <span>Musterstraße 42</span> <br>
                            <span>12345 Musterstadt</span> <br>
                            <span>Deutschland</span> <br>

                            <a href="/account/address/1" class="stretched-link"></a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
