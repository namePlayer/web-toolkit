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
                <div class="col-9">
                    <h4>API Key Verwalten</h4>
                </div>
                <div class="col-3">
                    <button type="button" class="w-100 btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Settings
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <?php foreach (MESSAGES->getAll() as $alert): ?>

                <?php $this->insert('element/alert', $alert) ?>

            <?php endforeach; ?>

            <div class="card">
                <div class="card-body">
                    <div class="row align-middle">
                        <div class="col-md-3 text-center mb-3">
                            <span>User</span>
                            <h4>
                                <?= $account->getName(); ?>
                            </h4>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <span>Created</span>
                            <h4>
                                <?= $apiKey->getCreated()->format($this->translate('dateTime-format')) ?>
                            </h4>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <span>Status</span>
                            <form method="post">
                                <h4>
                                    <?= $apiKey->isActive()
                                        ? $apiKey->getExpires() !== NULL && $apiKey->getExpires() <= new DateTime()
                                            ? 'Expired'
                                            : 'Active'
                                        : 'Disabled'
                                    ?>
                                    <?= $apiKey->isActive()
                                        ? '<button type="submit" class="ms-2 btn btn-danger btn-sm" name="apiKeyLockSwitch" title="Lock">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                                </svg>
                                            </button>'
                                        : '<button type="submit" class="ms-2 btn btn-success btn-sm" name="apiKeyLockSwitch">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                                                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                                </svg>
                                            </button>'
                                    ?>
                                </h4>
                            </form>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <span>Expiry</span>
                            <h4>
                                <?= $apiKey->getExpires() !== NULL
                                    ? $apiKey->getExpires()->format($this->translate('dateTime-format'))
                                    : 'Never'
                                ?>
                            </h4>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h4>Recent Access</h4>
                </div>
            </div>

        </div>
    </div>
</div>

<form method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Manage API Key</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="manageApiKeyExpiryField" class="form-label">Link Expiry</label>
                        <input type="datetime-local" class="form-control" id="manageApiKeyExpiryField" name="manageApiKeyExpiryField"
                               value="<?= $apiKey->getExpires() !== NULL
                                        ? $apiKey->getExpires()->format('Y-m-d\TH:i')
                                        : ''
                               ?>">
                    </div>
                    <div class="row mb-3">
                        <div class="col-10">
                            <label for="manageApiKeyPasswordField" class="form-label">Access Password</label>
                            <input type="password" class="form-control" id="manageApiKeyPasswordField" name="manageApiKeyPasswordField" aria-describedby="manageApiKeyPasswordFieldHelp"
                                   value="<?= $apiKey->getPassword() ?>">
                            <div id="manageApiKeyPasswordFieldHelp" class="form-text">Only change this value if necessary, it will break stuff!</div>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Show</label>
                            <button type="button" id="togglePassword" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="manageApiKeySave">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const togglePassword = document
        .querySelector('#togglePassword');

    const password = document.querySelector('#manageApiKeyPasswordField');

    togglePassword.addEventListener('click', () => {
        const type = password
            .getAttribute('type') === 'password' ?
            'text' : 'password';

        password.setAttribute('type', type);

        this.classList.toggle('bi-eye');
    });
</script>
