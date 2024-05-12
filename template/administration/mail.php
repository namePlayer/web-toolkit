<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

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
                <div class="col-6 mb-3">
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
                <div class="col-6 mb-3">
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
                <div class="col-12 mb-3">
                    <h5><?= $this->e($this->translate('administration-mail-dashboard-mail-type-stats-title')) ?></h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->e($this->translate('administration-mail-dashboard-mail-type-stats-table-title')) ?></th>
                            <th scope="col"><?= $this->e($this->translate('administration-mail-dashboard-mail-type-stats-table-amount')) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mailTypeAmountGrouped as $mailTypeAmount): ?>
                                <tr>
                                    <td><?= $this->e($mailTypeAmount['title']) ?></td>
                                    <td><?= $this->e($mailTypeAmount['amount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
