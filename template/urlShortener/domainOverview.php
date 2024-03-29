<?php $this->layout('tooltemplate', ['tool' => $tool]); ?>

<div class="container">

    <div class="row mb-4 mt-4 d-flex align-items-center">
        <div class="col-4">
            <h3><?= $this->e($this->translate('url-shortener-domain-list')) ?></h3>
        </div>
        <div class="col-6">
            <?= $this->insert('urlShortener/navigation', ['tool' => $tool]) ?>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#urlShortenerAddNewDomain">
                Hinzufügen
            </button>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= $this->translate('url-shortener-domains-table-domain-name-title') ?></th>
                    <th scope="col"><?= $this->translate('url-shortener-domains-table-created-date-title') ?></th>
                    <th scope="col"><?= $this->translate('url-shortener-domains-table-status-title') ?></th>
                    <th scope="col"><?= $this->translate('url-shortener-domains-table-privacy-title') ?></th>
                    <th scope="col"><?= $this->translate('url-shortener-domains-table-actions-title') ?></th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach($domainList as $domain): ?>

                        <?php $this->insert('urlShortener/domainTableElement', ['domain' => $domain]); ?>

                    <?php endforeach; ?>

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

<form method="post">
    <div class="modal fade" id="urlShortenerAddNewDomain" tabindex="-1" aria-labelledby="urlShortenerAddNewDomainLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="urlShortenerAddNewDomainLabel">
                        <?= $this->translate('url-shortener-domains-add-domain-modal-title') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 mb-3">
                            <label for="urlShortenerAddNewDomainName" class="form-label">
                            <?= $this->translate('url-shortener-domains-add-domain-modal-domain-name-field') ?>
                            </label>
                            <input type="text" class="form-control" id="urlShortenerAddNewDomainName" name="urlShortenerAddNewDomainName" placeholder="examp.le/aka">
                        </div>
                        <div class="col-12 mb-3 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="urlShortenerAddNewDomainLabelRadio" id="urlShortenerAddNewDomainLabelRadioGlobal" value="global">
                                <label class="form-check-label" for="urlShortenerAddNewDomainLabelRadioGlobal">
                                <?= $this->translate('url-shortener-domains-add-domain-modal-domain-availability-select-public') ?>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="urlShortenerAddNewDomainLabelRadio" id="urlShortenerAddNewDomainLabelRadioPrivate" value="private">
                                <label class="form-check-label" for="inlineRadio3">
                                <?= $this->translate('url-shortener-domains-add-domain-modal-domain-availability-select-private') ?>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->translate('url-shortener-domains-add-domain-modal-domain-cancel-button') ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->translate('url-shortener-domains-add-domain-modal-domain-submit-button') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
