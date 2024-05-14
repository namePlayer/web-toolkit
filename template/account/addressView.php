<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row mt-3">

        <div class="col-md-3 mb-4">
            <?php $this->insert('element/accountSettingNavigation', ['ignoreCol' => '']) ?>
        </div>

        <div class="col-md-9">
            <div class="row mb-3">
                <div class="col-11 mb-3">
                    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-address-page-view-address', 'return' => '/account/address']); ?>
                </div>
                <div class="col-1 mb-3">
                    <button type="button" class="btn btn-outline-danger float-end" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 mb-3">
                    <label for="addNewAddressCompany" class="form-label">
                        <?= $this->e($this->translate('account-address-company')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressCompany"
                           name="addNewAddressCompany" value="<?= $address->getCompany() ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="addNewAddressFirstname" class="form-label">
                        <?= $this->e($this->translate('account-address-firstname')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressFirstname"
                           name="addNewAddressFirstname" value="<?= $address->getFirstname() ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="addNewAddressLastname" class="form-label">
                        <?= $this->e($this->translate('account-address-lastname')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressLastname"
                           name="addNewAddressLastname" value="<?= $address->getLastname() ?>">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="addNewAddressStreet" class="form-label">
                        <?= $this->e($this->translate('account-address-street')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressStreet" 7
                           name="addNewAddressStreet" value="<?= $address->getStreet() ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="addNewAddressHouseNumber" class="form-label">
                        <?= $this->e($this->translate('account-address-house-number')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressHouseNumber"
                           name="addNewAddressHouseNumber" value="<?= $address->getHouseNumber() ?>">
                </div>
                <div class="col-md-5 mb-3">
                    <label for="addNewAddressZipCode" class="form-label">
                        <?= $this->e($this->translate('account-address-zip-code')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressZipCode"
                           name="addNewAddressZipCode" value="<?= $address->getZipCode() ?>">
                </div>
                <div class="col-md-7 mb-3">
                    <label for="addNewAddressCity" class="form-label">
                        <?= $this->e($this->translate('account-address-city')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressCity"
                           name="addNewAddressCity" value="<?= $address->getCity() ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="addNewAddressCountry" class="form-label">
                        <?= $this->e($this->translate('account-address-country')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressCountry"
                           name="addNewAddressCountry" value="<?= $address->getCountry() ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="addNewAddressPhone" class="form-label">
                        <?= $this->e($this->translate('account-address-phone')) ?>
                    </label>
                    <input type="text" class="form-control" id="addNewAddressPhone"
                           name="addNewAddressPhone" value="<?= $address->getPhone() ?>">
                </div>

            </div>
        </div>

    </div>

</div>
