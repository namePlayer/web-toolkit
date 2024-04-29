<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'support-tab-title']); ?>

    <div class="row mt-3">

        <div class="col-12">
            <?php $this->insert('element/alert') ?>
        </div>

        <div class="col-3">

            <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#createTicketModal">
                <?= $this->translate('support-create-ticket-button') ?>
            </button>

            <div class="card mb-3">
                <div class="card-body text-center">
                    <h5>Support-PIN</h5>
                    <span class="align-middle">
                        000000
                    </span>
                    <button type="button" class="btn btn-secondary btn-sm ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <div class="row col-9">

            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Status</th>
                            <th scope="col">Erstellt</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ticketList as $ticket): ?>
                            <tr class="align-middle">
                                <th scope="row"><?= $ticket['id'] ?></th>
                                <td>
                                    <?php if($ticket['waitingForCustomerResponse'] === 1): ?>
                                        <span class="badge rounded-pill text-bg-danger p-1">
                                        </span>
                                    <?php endif?>
                                    <?= $ticket['title'] ?>
                                </td>
                                <td>
                                    <?php if($ticket['status'] === 0): ?>
                                        <span class="badge rounded-pill text-bg-success">Eröffnet</span>
                                    <?php elseif($ticket['status'] === 1): ?>
                                        <span class="badge rounded-pill text-bg-danger">Geschlossen</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= (new DateTime($ticket['created']))->format('d.m.Y H:i') ?></td>
                                <td>
                                    <a href="/support/ticket/<?= $ticket['id'] ?>" role="button" class="btn btn-outline-secondary rounded-pill btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

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
