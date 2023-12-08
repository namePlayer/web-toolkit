<hr>
<div class="row">
    <div class="col-9">
        <span>
            <?= $isOwner ? $this->translate('organisation-owner') : $this->translate('organisation-member') ?>:
        </span>
        <h4>
            <?= $organisation['name'] ?>
        </h4>
    </div>
    <div class="col-3 <?= $account->isCreatedByOrganisation() ? '' : 'd-flex align-items-end' ?>">
        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#leaveOrganisationModal"
            <?= $account->isCreatedByOrganisation() || $account->getId() == $organisation['id'] ? 'disabled' : '' ?>>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
            <?= $this->translate('leave-button') ?>
        </button>
        <?= $account->isCreatedByOrganisation() ? '<small>' . $this->translate('organisation-settings-leave-organisation-created-by-organisation').'</small>' : '' ?>
    </div>
</div>

<form action="" method="post">
    <div class="modal fade" id="leaveOrganisationModal" tabindex="-1" aria-labelledby="leaveOrganisationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="leaveOrganisationModalLabel">
                        <?= $this->translate('organisation-settings-leave-organisation-modal-label') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle me-1 text-danger" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                        </svg>
                        <?= $this->translate('organisation-settings-leave-organisation-notice') ?>
                    </p>
                    <div class="mb-3">
                        <label for="leaveOrganisationModalPasswordConfirmation" class="form-label"><?= $this->translate('password') ?></label>
                        <input class="form-control" type="password" id="leaveOrganisationModalPasswordConfirmation" name="leaveOrganisationModalPasswordConfirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= $this->translate('close-button') ?></button>
                    <button type="submit" class="btn btn-danger"><?= $this->translate('leave-button') ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
