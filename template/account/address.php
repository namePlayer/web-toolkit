<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row mt-3">

        <div class="col-md-3 mb-4">
            <?php $this->insert('element/accountSettingNavigation', ['ignoreCol' => '']) ?>
        </div>

        <div class="col-md-9">
            <div class="row mb-3">
                <div class="col-md-8 mb-3">
                    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-address-page-title']); ?>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                        <?= $this->e($this->translate('account-address-page-add-new-address')) ?>
                    </button>
                </div>
            </div>

            <div class="row">

                <div class="col-12 mb-3">
                    <?php $this->insert('element/alert') ?>
                </div>

                <?php foreach($addresses as $address): ?>
                    <div class="col-4 mb-3">
                        <div class="card">
                            <div class="card-body">

                                <span><b><?= $address->getCompany() ?></b></span> <?= !empty($address->getCompany()) ? '<br>' : '' ?>
                                <span><b><?= $address->getFirstname() ?> <?= $address->getLastname() ?></b></span> <br>
                                <span><?= $address->getStreet() ?> <?= $address->getHouseNumber() ?></span> <br>
                                <span><?= $address->getZipCode() ?> <?= $address->getCity() ?></span> <br>
                                <span><?= $address->getCountry() ?></span> <br>

                                <a href="/account/address/<?= $address->getId() ?>" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNewAddressModalLabel">
                        <?= $this->e($this->translate('account-address-page-add-new-address-modal-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="addNewAddressCompany" class="form-label">
                                <?= $this->e($this->translate('account-address-company')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressCompany" name="addNewAddressCompany">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addNewAddressFirstname" class="form-label">
                                <?= $this->e($this->translate('account-address-firstname')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressFirstname" name="addNewAddressFirstname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addNewAddressLastname" class="form-label">
                                <?= $this->e($this->translate('account-address-lastname')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressLastname" name="addNewAddressLastname">
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="addNewAddressStreet" class="form-label">
                                <?= $this->e($this->translate('account-address-street')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressStreet" name="addNewAddressStreet">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="addNewAddressHouseNumber" class="form-label">
                                <?= $this->e($this->translate('account-address-house-number')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressHouseNumber" name="addNewAddressHouseNumber">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="addNewAddressZipCode" class="form-label">
                                <?= $this->e($this->translate('account-address-zip-code')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressZipCode" name="addNewAddressZipCode">
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="addNewAddressCity" class="form-label">
                                <?= $this->e($this->translate('account-address-city')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressCity" name="addNewAddressCity">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="addNewAddressCountry" class="form-label">
                                <?= $this->e($this->translate('account-address-country')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressCountry" name="addNewAddressCountry">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="addNewAddressPhone" class="form-label">
                                <?= $this->e($this->translate('account-address-phone')) ?>
                            </label>
                            <input type="text" class="form-control" id="addNewAddressPhone" name="addNewAddressPhone">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary" name="addNewAddressSubmit">
                        <?= $this->e($this->translate('create-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
