<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h2><?= $this->e($this->translate('organisation-manage-title')) ?></h2>
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
        <?php $this->insert('element/accountSettingNavigation', ['showOrganisation' => true]) ?>

        <div class="col-md-9">
            <div class="row">
                <div class="col-9">
                    <h3 class="mb-4">
                        <?= $this->e($this->translate('account-settings-organisation-navigation-invite-tab-title')) ?>
                    </h3>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#organisationInviteCreateModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                        </svg>
                        <?= $this->translate('organisation-settings-create-invite-label') ?>
                    </button>
                </div>
            </div>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <?= $this->translate('organisation-settings-invite-table-invite') ?>
                            </th>
                            <th scope="col">
                                <?= $this->translate('organisation-settings-invite-table-created') ?>
                            </th>
                            <th scope="col">
                                <?= $this->translate('organisation-settings-invite-table-expires') ?>
                            </th>
                            <th scope="col">
                                <?= $this->translate('organisation-settings-invite-table-actions') ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">default</th>
                            <td>28.05.2023</td>
                            <td>Never</td>
                            <td>
                                <a href="#" class="text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-slash-circle me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z"/>
                                    </svg>
                                    <?= $this->translate('organisation-settings-invite-table-action-disable') ?>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<form action="" method="post">
    <div class="modal fade" id="organisationInviteCreateModal" tabindex="-1" aria-labelledby="organisationInviteCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="organisationInviteCreateModalLabel">
                        <?= $this->translate('organisation-settings-invite-modal-title') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="organisationInviteExpiryDate" class="form-label">
                                <?= $this->translate('organisation-settings-invite-modal-expiry-label') ?>
                            </label>
                            <input type="datetime-local" class="form-control" id="organisationInviteExpiryDate" name="organisationInviteExpiryDate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->translate('abort-button') ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->translate('create-button') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
