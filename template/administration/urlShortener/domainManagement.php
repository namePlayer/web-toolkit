<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">
            <?php $this->insert('element/alert') ?>

            <div class="row d-flex align-items-end">
                <div class="col-8 mb-3">
                    <h3>
                        <a href="/admin/urlshortener/alldomains"  style="text-decoration: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <?= $this->e($this->translate('administration-url-shortener-domain-management-title')) ?>
                    </h3>
                    <h5><?= $this->e($data['address']) ?></h5>
                </div>
                <div class="col-4 mb-3">
                    <span><b>ID: </b> <?= $this->e($data['id']) ?></span> <br>
                    <span><b><?= $this->translate('customer-id-string') ?>: </b> <?= $this->e($data['user']) ?></span> <br>
                </div>

                <div class="col-md-12 mt-4">

                    <form action="" method="post">
                        <div class="row">

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body text-center">

                                        <span><?= $this->translate('administration-url-shortener-domain-management-status') ?></span>
                                        <h3>
                                            <?= $data['disabled'] === 0
                                                ? $this->translate('active-string')
                                                : $this->translate('disabled-string')
                                            ?>
                                        </h3>
                                        <?= $data['disabled'] === 0
                                            ? '<button type="submit" class="btn btn-danger mt-3" name="toggleDomainActivation">'.$this->translate('disable-button').'</button>'
                                            : '<button type="submit" class="btn btn-success mt-3" name="toggleDomainActivation">'.$this->translate('activate-button').'</button>'
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body text-center">

                                        <span><?= $this->translate('administration-url-shortener-domain-management-verification') ?></span>
                                        <h3>
                                            <?= $data['verified'] === 1
                                                ? $this->translate('verified-string')
                                                : $this->translate('outstanding-string')
                                            ?>
                                        </h3>
                                        <?= $data['verified'] === 0
                                            ? '<button type="submit" class="btn btn-info mt-3" name="verifyDomain">'.$this->translate('verify-button').'</button>'
                                            : '<button type="button" class="btn btn-success disabled mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill me-2" viewBox="0 0 16 16">
                                              <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                            </svg>'.$this->translate('verified-string').'</button>'
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="deleteShortlinkModal" tabindex="-1" aria-labelledby="deleteShortlinkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteShortlinkModalLabel">
                        <?= $this->translate('administration-url-shortener-link-management-delete-title') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span>
                        <?= $this->translate('administration-url-shortener-link-management-delete-security-key') ?>:
                        <b><?= $deleteCode ?></b>
                    </span>
                    <input type="hidden" name="deleteShortlinkModalConfirmationCode" value="<?= $deleteCode ?>">
                    <div class="mt-3 mb-3">
                        <label for="deleteShortlinkModalConfirmationCodeInput" class="form-label">Code</label>
                        <input type="text" class="form-control" name="deleteShortlinkModalConfirmationCodeInput" id="deleteShortlinkModalConfirmationCodeInput" placeholder="<?= $deleteCode ?>" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary"><?= $this->translate('abort-button') ?></a>
                    <button type="submit" class="btn btn-danger" name="deleteShortlinkModalConfirmationSubmit">
                        <?= $this->translate('delete-button') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

