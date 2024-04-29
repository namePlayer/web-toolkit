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
                'currentPage' => $currentPage, 'openTickets' => $allOpenTickets
        ]) ?>

        <div class="col-md-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Erstellt</th>
                        <th scope="col">Letztes Update</th>
                        <th scope="col">Betreff</th>
                        <th scope="col">Benutzer</th>
                        <th scope="col">Zugewiesener Tech</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($openTickets as $ticket): ?>
                        <tr onclick="window.location='/admin/support/ticket/<?= $ticket['id'] ?>';" style="cursor: pointer;">
                            <th scope="row">
                                <?= $ticket['onHold'] === 1 ? '<span class="badge rounded-pill text-bg-warning p-1"> </span>' : '' ?>
                                <?= $ticket['id'] ?>
                            </th>
                            <td><?= (new DateTime($ticket['created']))->format('d.m.Y H:i') ?></td>
                            <td><?= (new DateTime($ticket['updated']))->format('d.m.Y H:i') ?></td>
                            <td>
                                <?= $ticket['title'] ?>
                            </td>
                            <td><?= $ticket['ticketCreatorFirstname'] . ' ' . $ticket['ticketCreatorSurname'] ?></td>
                            <td><?= $ticket['assignedTechAccount'] !== null ? $ticket['techFirstname'] . ' ' . $ticket['techSurname'] : 'Keiner' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>
