<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-12">
            <h2><?= $this->e($this->translate('support-tab-title')) ?></h2>
            <?php if($this->getAccountInformation()['business'] !== NULL): ?>
                <small class="text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    <?= $this->e($this->translate('managed-by-organisation-extended-information-settings')) ?> <a href="/authentication/account/organisation"><?= $this->e($this->translate('learn-more')) ?></a>
                </small>
            <?php endif; ?>
        </div>
    </div>
    <hr>

    <div class="row mt-3">

        <div class="col-12">
            <?php $this->insert('element/alert') ?>
        </div>

        <div class="row col-12">

            <div class="col-12 mb-3">
                <h2><?= $ticketData['title'] ?></h2>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Erstellt am</h3>
                        <span><?= (new DateTime($ticketData['created']))->format('d.m.Y H:i') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Letztes Update</h3>
                        <span><?= (new DateTime($ticketData['updated']))->format('d.m.Y H:i') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Status</h3>
                        <?php if($ticketData['status'] === 0): ?>
                            <span class="badge rounded-pill text-bg-success">Eröffnet</span>
                        <?php elseif ($ticketData['status'] === 1): ?>
                            <span class="badge rounded-pill text-bg-warning">On-Hold</span>
                        <?php elseif ($ticketData['status'] === 2): ?>
                            <span class="badge rounded-pill text-bg-danger">Geschlossen</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3 mt-3">
                <hr>
            </div>

            <div class="col-1"></div>
            <div class="col-10">

                <?php foreach ($ticketMessages as $message): ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <?= $message['message'] ?>
                        </div>
                        <div class="card-footer">
                            <b><?= $message['accountFirstname'] ?> <?= $message['accountSurname'] ?></b>
                            um
                            <?= (new DateTime($message['created']))->format('d.m.Y H:i') ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="col-1"></div>

        </div>

    </div>

</div>

<div class="modal modal-lg fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTicketModalLabel">Neues Ticket erstellen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createTicketTitle" class="form-label">Betreff</label>
                        <input type="text" class="form-control" id="createTicketTitle" name="createTicketTitle">
                    </div>
                    <div class="mb-3">
                        <label for="createTicketMessage" class="form-label">Nachricht</label>
                        <textarea class="form-control" id="createTicketMessage" name="createTicketMessage" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Abbruch</button>
                    <button type="submit" class="btn btn-primary">Erstellen</button>
                </div>
            </div>
        </div>
    </form>
</div>
