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
            <div class="row mb-3">
                <div class="col-9">
                    <h4 class="mb-3">
                        <?= $this->e($this->translate('administration-mail-dashboard-title')) ?>
                    </h4>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#emailDashboardSendEmailModal">
                        <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-button-title')) ?>
                    </button>
                </div>
            </div>

            <?php $this->insert('element/alert') ?>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-mail-dashboard-unsent-mails-amount-card-title')) ?>
                            </span>
                            <span class="text-end">
                                <h4><?= $unsentMailAmount ?></h4>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-mail-dashboard-total-mails-recent-amount-card-title')) ?>
                            </span>
                            <span class="text-end">
                                <h4><?= $mailsLastSevenDaysAmount ?></h4>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<form method="post">
    <div class="modal fade" id="emailDashboardSendEmailModal" tabindex="-1" aria-labelledby="emailDashboardSendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="emailDashboardSendEmailModalLabel">
                        <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-modal-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailDashboardSendEmailModalAmount" class="form-label">
                            <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-modal-amount')) ?>
                        </label>
                        <input type="number" class="form-control"
                               id="emailDashboardSendEmailModalAmount"
                               name="emailDashboardSendEmailModalAmount"
                               min="0" max="<?= $unsentMailAmount ?>"
                               value="<?= min($unsentMailAmount, $_ENV['MAILER_MAX_BATCH_SIZE']) ?>">
                        <div id="emailDashboardSendEmailModalAmountHelp" class="form-text">
                            <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-modal-amount-helper')) ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-modal-close-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary" name="emailDashboardSendEmailModalSendButton">
                        <?= $this->e($this->translate('administration-mail-dashboard-send-unsent-mails-modal-send-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
