<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">
            <div class="row">
                <h3 class="col-9">
                    <?= $this->e($this->translate('administration-url-shortener-all-links-title')) ?>
                </h3>
                <div class="col-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#adminSearchShortlinkModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        <?= $this->e($this->translate('search-button')) ?>
                    </button>
                </div>

                <div class="col-md-12">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-id-header')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-domain-header')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-account-header')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-uuid-header')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-created-header')) ?>
                                </th>
                                <th scope="col">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lastShortlinkList as $link): ?>
                                <tr>
                                    <th scope="row"><?= $link['id'] ?></th>
                                    <td>
                                        <?= $link['domain'] === NULL ? \App\Tool\ShortlinkTool::getDefaultUrl() : $link['address'] ?>
                                    </td>
                                    <td>
                                        <a href="/admin/account/<?= $this->e($link['account']) ?>" class="text-decoration-none">
                                            <?= $this->e($link['accountName']) ?>
                                        </a>
                                        <span class="text-muted">
                                            <?= $this->e($link['account']) ?>
                                        </span>
                                    </td>
                                    <td><?= $this->e($link['uuid']) ?></td>
                                    <td><?= (new DateTime($link['created']))->format($this->translate('dateTime-format')) ?></td>
                                    <td>
                                        <a href="/admin/urlshortener/link/<?= $link['id'] ?>" class="text-decoration-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                                <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z"/>
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

</div>

<form action="" method="post">
    <div class="modal fade" id="adminSearchShortlinkModal" tabindex="-1" aria-labelledby="adminSearchShortlinkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adminSearchShortlinkModalLabel">
                        <?= $this->e($this->translate('administration-url-shortener-all-links-search-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-6 mb-3">
                            <label for="adminSearchShortlinkModalId" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-id')) ?>
                            </label>
                            <input type="number" class="form-control" id="adminSearchShortlinkModalId" name="adminSearchShortlinkModalId">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="adminSearchShortlinkModalAccount" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-customerid')) ?>
                            </label>
                            <input type="number" class="form-control" id="adminSearchShortlinkModalAccount" name="adminSearchShortlinkModalAccount">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="adminSearchShortlinkModalShortcode" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-shortcode')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchShortlinkModalShortcode" name="adminSearchShortlinkModalShortcode">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="adminSearchShortlinkModalDestination" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-destination')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchShortlinkModalDestination" name="adminSearchShortlinkModalDestination">
                        </div>
                        <div class="col-8 mb-3">
                            <label for="adminSearchShortlinkModalDomain" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-domain')) ?>
                            </label>
                            <input type="text" class="form-control" id="adminSearchShortlinkModalDomain" name="adminSearchShortlinkModalDomain">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="adminSearchShortlinkModalLimit" class="form-label">
                                <?= $this->e($this->translate('administration-url-shortener-all-links-search-result-limit')) ?>
                            </label>
                            <input type="number" class="form-control" id="adminSearchShortlinkModalLimit" name="adminSearchShortlinkModalLimit" value="25">
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
