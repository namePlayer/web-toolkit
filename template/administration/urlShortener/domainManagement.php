<?php $this->layout('basetemplate') ?>

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
            <?php $this->insert('element/alert') ?>

            <div class="row d-flex align-items-end">
                <div class="col-8 mb-3">
                    <h3>
                        <a href="/admin/urlshortener/alldomains"  style="text-decoration: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <?= $this->e($this->translate('administration-url-shortener-link-management-title')) ?>
                    </h3>
                    <h5><?= $this->e($data['address']) ?></h5>
                </div>
                <div class="col-4 mb-3">
                    <span><b>ID: </b> <?= $this->e($data['id']) ?></span> <br>
                    <span><b><?= $this->translate('customer-id-string') ?>: </b> <?= $this->e($data['user']) ?></span> <br>
                </div>

                <div class="col-md-12 mt-4">

                </div>
            </div>
        </div>

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="deleteShortlinkModal" tabindex="-1" aria-labelledby="deleteShortlinkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteShortlinkModalLabel">
                        <?= $this->translate('administration-url-shortener-link-management-delete-title') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span>
                        <?= $this->translate('administration-url-shortener-link-management-delete-security-key') ?>:
                        <b><?= $deleteCode ?></b>
                    </span>
                    <input type="hidden" name="deleteShortlinkModalConfirmationCode" value="<?= $deleteCode ?>">
                    <div class="mt-3 mb-3">
                        <label for="deleteShortlinkModalConfirmationCodeInput" class="form-label">Code</label>
                        <input type="text" class="form-control" name="deleteShortlinkModalConfirmationCodeInput" id="deleteShortlinkModalConfirmationCodeInput" placeholder="<?= $deleteCode ?>" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary"><?= $this->translate('abort-button') ?></a>
                    <button type="submit" class="btn btn-danger" name="deleteShortlinkModalConfirmationSubmit">
                        <?= $this->translate('delete-button') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

