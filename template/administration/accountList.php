<?php

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
                <div class="col-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#adminSearchAccountModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        <?= $this->e($this->translate('search-button')) ?>
                    </button>
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
                                ? $this->e($this->translate('active-string'))
                                : $this->e($this->translate('disabled-string'))
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

<form action="" method="post">
    <div class="modal fade" id="adminSearchAccountModal" tabindex="-1" aria-labelledby="adminSearchAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adminSearchAccountModalLabel">
                        <?= $this->e($this->translate('admin-account-list-search-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="adminSearchAccountModalID" class="form-label">
                                <?= $this->e($this->translate('admin-account-list-search-id')) ?>
                            </label>
                            <input type="number" class="form-control" id="adminSearchAccountModalID" name="adminSearchAccountModalID">
                        </div>
                        <div class="col-8 mb-3">
                            <label for="adminSearchAccountModalName" class="form-label">
                                <?= $this->e($this->translate('admin-account-list-search-name')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchAccountModalName" name="adminSearchAccountModalName">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="adminSearchAccountModalEmail" class="form-label">
                                <?= $this->e($this->translate('admin-account-list-search-email')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchAccountModalEmail" name="adminSearchAccountModalEmail">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="adminSearchAccountModalFirstname" class="form-label">
                                <?= $this->e($this->translate('admin-account-list-search-firstname')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchAccountModalFirstname" name="adminSearchAccountModalFirstname">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="adminSearchAccountModalSurname" class="form-label">
                                <?= $this->e($this->translate('admin-account-list-search-surname')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchAccountModalSurname" name="adminSearchAccountModalSurname">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->e($this->translate('search-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
