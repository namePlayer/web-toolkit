<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 text-center mb-3">
            <small class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <?= $this->e($this->translate('administration-information')) ?>
            </small>
        </div>

        <?= $this->insert('administration/element/supportNavigation', [
                'currentPage' => null, 'openTickets' => $allOpenTickets
        ]) ?>

        <hr class="mt-3">

        <div class="col-md-12 mb-3">

            <h3><small>Ticket #<?= $ticketData['id'] ?>:</small> <?= $this->e($ticketData['title']) ?></h3>

        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    Eigenschaften
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Erstellt:
                            </div>
                            <span>
                                <?= (new DateTime($ticketData['created']))->format('d.m.Y H:i') ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Geändert:
                            </div>
                            <span>
                                <?= (new DateTime($ticketData['updated']))->format('d.m.Y H:i') ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Status:
                            </div>
                            <?php if($ticketData['status'] === 0): ?>
                                <span class="badge rounded-pill text-bg-success">
                                    Geöffnet
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill text-bg-danger">
                                    Geschlossen
                                </span>
                            <?php endif; ?>
                        </li>
                    </ul>

                </div>
            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="row mb-3">
                <div class="col-8">
                    <h3>Historie</h3>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-outline-primary w-100">Antwort erstellen</button>
                </div>
            </div>

            <?php foreach ($ticketMessages as $ticketMessage): ?>

                <div class="card mb-3">
                    <div class="card-body">
                        <?= nl2br($this->e($ticketMessage['message'])) ?>
                    </div>
                    <div class="card-footer">
                        <span class="<?= $ticketMessage['account'] === $ticketData['account'] ? 'text-warning' : '' ?>">
                            <?= $ticketMessage['accountFirstname'] . ' ' . $ticketMessage['accountSurname'] ?>
                        </span>
                        am
                        <span class="<?= $ticketMessage['account'] === $ticketData['account'] ? 'text-warning' : '' ?>">
                            <?= (new DateTime($ticketMessage['created']))->format('d.m.Y H:i') ?>
                        </span>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="col-3 mb-3">

            <div class="card">

                <div class="card-header">
                    Aktionen
                </div>
                <div class="card-body">

                    <button type="button" class=" btn btn-outline-danger w-100 mb-3">
                        Ticket schließen
                    </button>
                    <button type="button" class="btn btn-outline-primary w-100 mb-3">
                        Ticket zuweisen
                    </button>
                    <button type="button" class="btn btn-outline-warning w-100 mb-3">
                        On-Hold setzen
                    </button>


                </div>

            </div>

        </div>

    </div>

</div>
