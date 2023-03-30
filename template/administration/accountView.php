<?php use App\Model\ApiKey\ApiKey;

$this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12">
            <h2><?= $this->e($this->translate($this->timeOfDayGreeting())) ?>, <?= $this->getAccountInformation()['name'] ?></h2>
            <small class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <?= $this->e($this->translate('administration-information')) ?>
            </small>
        </div>

        <hr class="mt-3 mb-3">

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">

            <div class="row mb-3">
                <div class="col-9">
                    <h4>Account Information</h4>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="adminAccountViewTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="adminAccountViewTabInformation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabInformationPane" type="button" role="tab" aria-controls="adminAccountViewTabInformationPane" aria-selected="true">
                        Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
                        Settings
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button disabled class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
                        Licenses
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button disabled class="nav-link" id="adminAccountViewTabSettings" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabSettingsPane" type="button" role="tab" aria-controls="adminAccountViewTabSettingsPane" aria-selected="false">
                        Support
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="adminAccountViewTabOrganisation" data-bs-toggle="tab" data-bs-target="#adminAccountViewTabOrganisationPane" type="button" role="tab" aria-controls="adminAccountViewTabOrganisationPane" aria-selected="false">
                        Organisation
                    </button>
                </li>
            </ul>

            <?php $this->insert('element/alert') ?>

            <hr >
            <div class="tab-content" id="adminAccountViewTabContent">
                <div class="tab-pane fade show active" id="adminAccountViewTabInformationPane" role="tabpanel" aria-labelledby="adminAccountViewTabInformation" tabindex="0">

                    <div class="card">
                        <div class="card-body row">

                            <div class="col-md-4 text-center mb-4">
                                <span>Account Name</span>
                                <h4>
                                    <?= $account->getName(); ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <span>Subscription</span>
                                <h4>
                                    <?= $this->e($this->translate($level['title'])) ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <span>Status</span>
                                <h4>
                                    <?= $account->isActive()
                                        ? 'Active'
                                        : 'Inactive'
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <span>Member of Organisation</span>
                                <h4>
                                    None
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <span>Registered</span>
                                <h4>
                                    <?= $account->getRegistered()->format($this->translate('dateTime-format')) ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <span>Last Login</span>
                                <h4>
                                    <?= $account->getLastLogin() === NULL
                                        ? 'Never'
                                        : $account->getLastLogin()->format($this->translate('dateTime-format'))
                                    ?>
                                </h4>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="adminAccountViewTabSettingsPane" role="tabpanel" aria-labelledby="adminAccountViewTabSettings" tabindex="0">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="adminAccountTabSettingsAccountName" class="form-label">Account or Organisation Name</label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsAccountName" name="adminAccountTabSettingsAccountName" value="<?= $account->getName(); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adminAccountTabSettingsFirstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsFirstname" name="adminAccountTabSettingsFirstname" value="<?= $account->getFirstname(); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adminAccountTabSettingsSurname" class="form-label">Surname</label>
                                <input type="text" class="form-control" id="adminAccountTabSettingsSurname" name="adminAccountTabSettingsSurname" value="<?= $account->getSurname(); ?>">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="adminAccountTabSettingsEmail" class="form-label">E-Mail Address</label>
                                <input type="email" class="form-control" id="adminAccountTabSettingsEmail" name="adminAccountTabSettingsEmail" value="<?= $account->getEmail(); ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="adminAccountTabSettingsLevel" class="form-label">Level</label>
                                <select class="form-select" aria-label="Default select example" name="adminAccountTabSettingsAccountLevel">
                                    <?php foreach($levels as $item): ?>
                                        <option value="<?= $item['id'] ?>" <?= $account->getLevel() === $item['id'] ? 'selected' : '' ?>>
                                            <?= $this->e($this->translate($item['title'])) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsActive"
                                        <?= $account->isAdmin() ? 'onclick="this.checked=!this.checked;" ' : '' ?>
                                        <?= $account->isActive() ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable Account</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsSupport"
                                        <?= $account->isSupport() || $account->isAdmin() ? 'checked' : '' ?> disabled>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Support Permissions</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="adminAccountTabSettingsAdmin"
                                        <?= $account->isAdmin() ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Admin Permissions</label>
                                </div>
                            </div>
                            <div class="col-2">

                                <button type="submit" class="w-100 btn btn-primary" name="adminAccountTabSettingsSaveButton">
                                    Save
                                </button>

                            </div>
                            <div class="col-1"></div>
                        </div>

                    </form>

                    <form class="row mt-3">
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-primary" name="adminAccountTabSettingsResendActivationMailButton">
                                Resend Activation Email
                            </button>

                        </div>
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-danger" name="adminAccountTabSettingsResetPasswordMailButton">
                                Reset Password
                            </button>

                        </div>
                        <div class="col-3">

                            <button type="submit" class="w-100 btn btn-danger" name="adminAccountTabSettingsDeleteAccountButton" <?= $account->isAdmin() ? 'disabled' : '' ?>>
                                Delete Account
                            </button>

                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="adminAccountViewTabOrganisationPane" role="tabpanel" aria-labelledby="adminAccountViewTabOrganisation" tabindex="0">

                </div>
            </div>
        </div>
    </div>
</div>
