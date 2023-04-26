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

            <div class="row mb-3">
                <div class="col-9">
                    <h4><?= $this->e($this->translate('admin-account-list-title')) ?></h4>
                </div>
            </div>

            <?php $this->insert('element/alert') ?>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-name-heading')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-organisation-heading')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-created-heading')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-last-login-heading')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-active-heading')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('admin-account-list-table-actions-heading')) ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($accounts as $account): ?>

                    <tr>
                        <th><?= $account['id'] ?></th>
                        <td><?= $account['name'] ?></td>
                        <td>
                            <?= $account['business'] === NULL
                                ? $this->e($this->translate('admin-account-list-table-organisation-field-none'))
                                : ($account['business'] === $account['id']
                                    ? $this->e($this->translate('admin-account-list-table-organisation-field-is-same'))
                                    : '<a href="/admin/account/'.$account['business'].'">'.$account['businessName'].'</a>'
                                )
                            ?>
                        </td>
                        <td><?= (new DateTime($account['registered']))->format($this->translate('dateTime-format')) ?></td>
                        <td>
                            <?= $account['lastLogin'] === NULL
                                ? $this->e($this->translate('admin-account-list-table-last-login-field-never'))
                                : (new DateTime($account['lastLogin']))->format($this->translate('dateTime-format'))
                            ?>
                        </td>
                        <td>
                            <?= $account['active'] === 1
                                ? $this->e($this->translate('admin-account-list-table-active-status-active'))
                                : $this->e($this->translate('admin-account-list-table-active-status-disabled'))
                            ?>
                        </td>
                        <td>
                            <a href="/admin/account/<?= $account['id'] ?>" class="text-decoration-none">
                                <?= $this->e($this->translate('admin-account-list-table-actions-manage-button')) ?>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
