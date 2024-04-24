<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row">

        <div class="col-12">
            <?php $this->insert('element/alert') ?>
        </div>

        <div class="row col-12">

            <div class="col-6 mb-3">
                <h4 class="align-items-center"><?= $ticketData['title'] ?></h4>
                <p class="text-muted align-items-center">Ticket #<?= $ticketData['id'] ?></p>
            </div>

            <div class="col-6 row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>Erstellt am</b>
                            <span><?= (new DateTime($ticketData['created']))->format('d.m.Y H:i') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>Letztes Update</b>
                            <span><?= (new DateTime($ticketData['updated']))->format('d.m.Y H:i') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>Status</b> <br>
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
            </div>

            <hr>

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
