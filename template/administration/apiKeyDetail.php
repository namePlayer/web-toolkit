<?php $this->layout('basetemplate') ?>

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
                <div class="col-12">
                    <h4>API Key Verwalten</h4>
                </div>
            </div>

            <?php foreach (MESSAGES->getAll() as $alert): ?>

                <?php $this->insert('element/alert', $alert) ?>

            <?php endforeach; ?>

            <div class="card">
                <div class="card-body">
                    <div class="row align-middle">
                        <div class="col-4 text-center">
                            <span>User</span>
                            <h4>
                                <?= $account->getName(); ?>
                            </h4>
                        </div>
                        <div class="col-4 text-center">
                            <span>Created</span>
                            <h4>
                                <?= $apiKey->getCreated()->format($this->translate('dateTime-format')) ?>
                            </h4>
                        </div>
                        <div class="col-4 text-center">
                            <span>Status</span>
                            <h4>
                                <?= $apiKey->isActive()
                                    ? 'Active'
                                    : 'Disabled'
                                ?>
                                <?= $apiKey->isActive()
                                    ? '
                                    <button type="button" class="btn btn-danger btn-sm" name="apiKeyLockSwitch" title="Lock">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </button>
                                    '
                                    : '<button type="button" class="btn btn-success btn-sm" name="apiKeyLockSwitch">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                                            <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                        </svg>
                                    </button>'
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h4>Scopes</h4>
                </div>
                <div class="col-md-6">
                    <h4>Recent Access</h4>
                </div>
            </div>

        </div>
    </div>
</div>
