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

                <div class="row mb-3">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <form action="" method="post">
                            <button type="submit" name="ticketUserChangeStatus" class="btn btn-outline-danger w-100">
                                Ticket schließen
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addTicketResponseModal">
                            Antworten
                        </button>
                    </div>
                    <div class="col-2"></div>
                </div>

                <?php foreach ($ticketMessages as $message): ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <?= nl2br($message['message']) ?>
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

<div class="modal modal-lg fade" id="addTicketResponseModal" tabindex="-1" aria-labelledby="addTicketResponseModalLabel" aria-hidden="true">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTicketResponseModalLabel">Auf Ticket antworten</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addTicketResponseModalLabelMessage" class="form-label">Nachricht</label>
                        <textarea class="form-control" id="addTicketResponseModalLabelMessage" name="addTicketResponseModalLabelMessage" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Abbruch</button>
                    <button type="submit" class="btn btn-primary">Antworten</button>
                </div>
            </div>
        </div>
    </form>
</div>
