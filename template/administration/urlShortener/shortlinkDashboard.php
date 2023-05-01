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
            <h3 class="mb-4"><?= $this->e($this->translate('administration-url-shortener-dashboard-title')) ?></h3>

            <div class="row mb-3">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-total-link-count-title')) ?>
                            </span>
                            <span class="text-end">
                                <h4><?= $shortlinkAmount ?></h4>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-link-last-seven-days-count-title')) ?>
                            </span>
                            <span class="text-end">
                                <h4><?= $shortlinkAmountLastSevenDays ?></h4>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-total-domain-count-title')) ?>
                            </span>
                            <span class="text-end">
                                <h4><?= $shortlinkDomainAmount ?></h4>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-4">
                        <?= $this->e($this->translate('administration-url-shortener-dashboard-recent-links-title')) ?>
                    </h4>
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
                                    <?= $this->e($this->translate('administration-url-shortener-dashboard-link-table-uuid-header')) ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lastShortlinkList as $link): ?>
                                <tr>
                                    <th scope="row"><?= $link['id'] ?></th>
                                    <td>
                                        <?= $link['domain'] === NULL ? \App\Tool\ShortlinkTool::getDefaultUrl() : $this->e($link['address']) ?>
                                    </td>
                                    <td><?= $this->e($link['uuid']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="/admin/urlshortener/alllinks" class="text-decoration-none float-end">
                        <?= $this->e($this->translate('administration-url-shortener-dashboard-all-links-title')) ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-md-6">
                    <h4><?= $this->e($this->translate('administration-url-shortener-dashboard-recent-domains-title')) ?></h4>
                    <table class="table mt-4">
                        <thead>
                        <tr>
                            <th scope="col">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-domain-table-id-header')) ?>
                            </th>
                            <th scope="col">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-domain-table-address-header')) ?>
                            </th>
                            <th scope="col">
                                <?= $this->e($this->translate('administration-url-shortener-dashboard-domain-table-status-header')) ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($lastDomainList as $domain): ?>
                            <tr>
                                <th scope="row"><?= $domain['id'] ?></th>
                                <td><?= $domain['address'] ?></td>
                                <td>
                                    <?= $domain['verified'] == 1
                                        ? '<span class="badge text-bg-success">'
                                            .$this->e($this->translate('administration-url-shortener-dashboard-domain-table-status-verified')).
                                        '</span>'
                                        : '<span class="badge text-bg-info">'
                                            .$this->e($this->translate('administration-url-shortener-dashboard-domain-table-status-verification')).
                                        '</span>'
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="#" class="text-decoration-none float-end">
                        <?= $this->e($this->translate('administration-url-shortener-dashboard-all-domains-title')) ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
