<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 text-center">
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

            <?php $this->insert('element/alert') ?>

        </div>

        <div class="col-md-3 mb-3">
            <div class="card mb-3">
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
                            <?php if($ticketData['status'] === 1): ?>
                                <span class="badge rounded-pill text-bg-success">
                                    Geöffnet
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill text-bg-danger">
                                    Geschlossen
                                </span>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Wartet:
                            </div>
                            <?php if($ticketData['waitingForCustomerResponse'] === 0): ?>
                                <span>
                                    Antwort von Support
                                </span>
                            <?php else: ?>
                                <span>
                                    Antwort von Kunden
                                </span>
                            <?php endif; ?>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Kundeninformationen
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Kundennummer:
                            </div>
                            <span>
                                <a href="/admin/account/<?= $customerInformation['id'] ?>" class="text-decoration-none">
                                    <?= $customerInformation['id'] ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                    </svg>
                                </a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Kontoname:
                            </div>
                            <span>
                                <?= $customerInformation['name'] ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Name:
                            </div>
                            <span>
                                <?= $customerInformation['firstname'] . ' ' . $customerInformation['surname'] ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Organisation:
                            </div>
                            <span>
                                <?= $customerInformation['business'] !== null ? 'Ja (' . $customerInformation['business'] . ')' : 'Nein' ?>
                            </span>
                        </li>
                        <?php if($customerInformation['business'] !== null): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    Erstellt von Organisation
                                </div>
                                    <span>
                                    <?= $customerInformation['createdByOrganisation'] === 1 ? 'Ja' : 'Nein' ?>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="row mb-3">
                <div class="col-8">
                    <h3><small>Ticket #<?= $ticketData['id'] ?>:</small> <?= $this->e($ticketData['title']) ?></h3>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-outline-primary w-100"
                            data-bs-toggle="modal" data-bs-target="#addNewTechResponseModal">
                        Antwort erstellen
                    </button>
                </div>
            </div>

            <?php foreach ($ticketMessages as $ticketMessage): ?>

                <div class="card mb-3">
                    <div class="card-body">
                        <?= nl2br($this->e($ticketMessage['message'])) ?>
                    </div>
                    <div class="card-footer">
                        <span class="<?= $ticketMessage['account'] === $ticketData['account'] ? 'fw-bolder' : '' ?>">
                            <?= $ticketMessage['accountFirstname'] . ' ' . $ticketMessage['accountSurname'] ?>
                        </span>
                        am
                        <span class="<?= $ticketMessage['account'] === $ticketData['account'] ? 'fw-bolder' : '' ?>">
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

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Zuständiger Tech</label>
                            <select id="disabledSelect" class="form-select" name="ticketSettingAssignedTech">
                                <option value=""></option>
                                <?php foreach ($supportPermissionUserList as $user): ?>
                                    <option value="<?= $user['id'] ?>" <?= $ticketData['assignedTechAccount'] === $user['id'] ? 'selected' : '' ?>>
                                        <?= $user['firstname'] ?> <?= $user['surname'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Status</label>
                            <select id="disabledSelect" class="form-select" name="ticketSettingStatus">
                                <option value="1" <?= $ticketData['status'] === 1 ? 'selected' : '' ?>>Geöffnet</option>
                                <option value="0" <?= $ticketData['status'] === 0 ? 'selected' : '' ?>>Geschlossen</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">On Hold</label>
                            <select id="disabledSelect" class="form-select" name="ticketSettingOnHold">
                                <option value="1" <?= $ticketData['onHold'] === 1 ? 'selected' : '' ?>>Setzen</option>
                                <option value="0" <?= $ticketData['onHold'] === 0 ? 'selected' : '' ?>>Nicht setzen</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary w-100" name="ticketSettingsSave">
                            Speichern
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<form action="" method="post">
    <div class="modal modal-lg fade" id="addNewTechResponseModal" tabindex="-1" aria-labelledby="addNewTechResponseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNewTechResponseModalLabel">Auf Ticket antworten</h1>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addNewTechResponseModalText" class="form-label">Antwort</label>
                        <textarea class="form-control" id="addNewTechResponseModalText" name="addNewTechResponseModalText" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">Antworten</button>
                </div>
            </div>
        </div>
    </div>
</form>
