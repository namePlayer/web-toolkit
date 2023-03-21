<?php use App\Model\ApiKey\ApiKey;

$this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12">
            <h2><?= $this->e($this->translate($this->timeOfDayGreeting())) ?>, <?= $this->getAccountInformation()['name'] ?></h2>
            <small class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <?= $this->e($this->translate('administration-information')) ?>
            </small>
        </div>

        <hr class="mt-3 mb-3">

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">

            <h4 class="mb-3">API-Keys</h4>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Assigned Account</th>
                    <th scope="col">Created</th>
                    <th scope="col">Expires</th>
                    <th scope="col">Active</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($apiKeys as $apiKey):
                ?>
                    <tr>
                        <th scope="row"><?= $apiKey['id'] ?></th>
                        <td>
                            <?= $apiKey['account'] === NULL
                                ? '<small class="text-muted">Not Assigned</small>'
                                : '<a href="/admin/account/'.$apiKey['id'].'" class="text-decoration-none">' . $apiKey['name'] . '</a><small> (ID: ' . $apiKey['account'] . ')</small>'
                            ?>
                        </td>
                        <td><?= (new DateTime($apiKey['created']))->format($this->translate('dateTime-format')) ?></td>
                        <td>
                            <?= $apiKey['expires'] !== NULL
                                ? (new DateTime($apiKey['expires']))->format($this->translate('dateTime-format'))
                                : 'Never'
                            ?>
                        </td>
                        <th>
                            <?= $apiKey['active'] === 1
                                ? '<span class="badge text-bg-success">Active</span>'
                                : '<span class="badge text-bg-danger">Disabled</span>'
                            ?>
                        </th>
                        <td>
                            <a href="#" class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                </svg>
                                Manage
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>
