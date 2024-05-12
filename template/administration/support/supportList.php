<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('administration/element/supportNavigation', [
                'currentPage' => $currentPage, 'openTickets' => $allOpenTickets
        ]) ?>

        <div class="col-md-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-ticketId-header')) ?>
                        </th>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-created-header')) ?>
                        </th>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-updated-header')) ?>
                        </th>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-subject-header')) ?>
                        </th>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-account-header')) ?>
                        </th>
                        <th scope="col">
                            <?= $this->e($this->translate('admin-support-management-list-assignedTech-header')) ?>
                        </th>
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
