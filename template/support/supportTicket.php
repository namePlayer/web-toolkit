<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row">

        <div class="col-12">
            <?php $this->insert('element/alert') ?>
        </div>

        <div class="row col-12">

            <div class="col-6 d-flex align-items-center">
                <h3>
                    <a href="/support"  style="text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </a>
                    <?= $this->e($ticketData['title']) ?>
                </h3>
                <p class="ms-1 text-muted align-items-center"> #<?= $ticketData['id'] ?></p>
            </div>

            <div class="col-6 row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>
                                <?= $this->e($this->translate('support-ticket-created')) ?>
                            </b>
                            <span><?= (new DateTime($ticketData['created']))->format($this->translate('dateTime-format')) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>
                                <?= $this->e($this->translate('support-ticket-updated')) ?>
                            </b>
                            <span><?= (new DateTime($ticketData['updated']))->format($this->translate('dateTime-format')) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>
                                <?= $this->e($this->translate('support-ticket-status')) ?>
                            </b>
                            <br>
                            <?php if($ticketData['status'] === 0): ?>
                                <?= $this->e($this->translate('support-ticket-status-open')) ?>
                            <?php else: ?>
                                <?= $this->e($this->translate('support-ticket-status-closed')) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="col-1"></div>
            <div class="col-10">

                <div class="row mb-3">
                    <div class="col-2"></div>
                    <div class="col">
                        <form action="" method="post">
                            <?php if($ticketData['status'] === 0): ?>
                                <button type="submit" name="ticketUserChangeStatus" class="btn btn-outline-danger w-100">
                                    <?= $this->e($this->translate('support-ticket-close-ticket-button')) ?>
                                </button>

                            <?php else: ?>
                                <button type="submit" name="ticketUserChangeStatus" class="btn btn-outline-success w-100">
                                    <?= $this->e($this->translate('support-ticket-reopen-ticket-button')) ?>
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <?php if($ticketData['status'] === 0): ?>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addTicketResponseModal">
                                <?= $this->e($this->translate('answer-button')) ?>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="col-2"></div>
                </div>

                <?php foreach ($ticketMessages as $message): ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <?= nl2br($message['message']) ?>
                        </div>
                        <div class="card-footer">
                            <b><?= $message['accountFirstname'] ?> <?= $message['accountSurname'] ?></b>
                            -
                            <?= (new DateTime($message['created']))->format($this->translate('dateTime-format')) ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="col-1"></div>

        </div>

    </div>

</div>

<div class="modal modal-lg fade" id="addTicketResponseModal" tabindex="-1" aria-labelledby="addTicketResponseModalLabel" aria-hidden="true">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTicketResponseModalLabel">
                        <?= $this->e($this->translate('support-ticket-answer-modal-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addTicketResponseModalLabelMessage" class="form-label">
                            <?= $this->e($this->translate('support-ticket-message')) ?>
                        </label>
                        <textarea class="form-control" id="addTicketResponseModalLabelMessage" name="addTicketResponseModalLabelMessage" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->e($this->translate('answer-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
