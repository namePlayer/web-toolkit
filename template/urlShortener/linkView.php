<?php

use App\Model\UrlShortener\Shortlink;

$this->layout('tooltemplate', ['tool' => $tool]);
/* @var $shortlink Shortlink */
?>

<div class="container">

    <div class="row mb-4 mt-4">
        <div class="col-md-4 d-flex align-items-center">
            <h3><?= $this->e($this->translate('url-shortener-link-info-pane-title')) ?></h3>
        </div>
        <div class="col-md-8 d-flex align-items-center">
            <?= $this->insert('urlShortener/navigation', ['tool' => $tool]) ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 200px;">

        <div class="col-8 mb-5 align-self-center">
            <h4><?= $shortlinkDomain . '/' . $shortlink->getUuid()?></h4>
            <small>
                <a href="<?= $shortlink->getDestination() ?>" class="text-muted text-decoration-none">
                    <?= $shortlink->getDestination() ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right ms-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                    </svg>
                </a>
            </small>
        </div>
        <div class="col-4 mt-auto mb-5">
            <?php if($shortlink->isTracking()): ?>
                <span>
                    <b><?= $this->e($this->translate('url-shortener-link-information-clicks')) ?>: </b>
                    <?= $linkClicks ?>
                </span> <br>
            <?php endif; ?>
            <span>
                <b><?= $this->e($this->translate('url-shortener-link-information-created')) ?>: </b>
                <?= $shortlink->getDateTime()->format('d.m.Y H:i') ?>
            </span> <br>
            <span>
                <b><?= $this->e($this->translate('url-shortener-link-information-expiry')) ?>: </b>
                <?= $shortlink->getDateTime()->format('d.m.Y H:i') ?>
            </span> <br>
            <span>
                <b><?= $this->e($this->translate('url-shortener-link-information-password')) ?>: </b>
                <?= $shortlink->getPassword() === NULL
                    ? '<span class="badge bg-danger rounded-pill">'. $this->e($this->translate('disabled-string')) .'</span>'
                    : '<span class="badge bg-success rounded-pill">'. $this->e($this->translate('active-string')) .'</span>'
                ?>
            </span>
        </div>
        <?php if($shortlink->isTracking()): ?>
            <div class="col-sm-6 mb-3">
                <h5 class="mb-3"><?= $this->e($this->translate('url-shortener-link-information-tracking-table-browser-title')) ?></h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->e($this->translate('url-shortener-link-information-tracking-table-browser-title')) ?></th>
                        <th scope="col"><?= $this->e($this->translate('url-shortener-link-list-table-clicks-title')) ?></th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php foreach ($browserList as $browser): ?>
                        <tr>
                            <td>
                                <?= empty($browser['browser'])
                                    ? $this->e($this->translate('unknown-string'))
                                    : $browser['browser'] ?>
                            </td>
                            <td><?= $browser['amount'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6 mb-3">
                <h5 class="mb-3"><?= $this->e($this->translate('url-shortener-link-information-tracking-table-country-title')) ?></h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">
                            <?= $this->e($this->translate('url-shortener-link-information-tracking-table-country-title')) ?>
                        </th>
                        <th scope="col"><?= $this->e($this->translate('url-shortener-link-list-table-clicks-title')) ?></th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php foreach ($countryList as $country): ?>
                        <tr>
                            <td>
                                <?= empty($country['country'])
                                    ? $this->e($this->translate('unknown-string'))
                                    : $country['country'] ?>
                            </td>
                            <td><?= $country['amount'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="col-md-12">
            <h5 class="mb-3">Letzte 10 Aufrufe:</h5>
            <div class="<?= !$shortlink->isTracking() ? 'text-center' : '' ?>">
                <?php if($shortlink->isTracking()): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <?= $this->e($this->translate('url-shortener-link-information-tracking-table-date-title')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('url-shortener-link-information-tracking-table-browser-title')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('url-shortener-link-information-tracking-table-os-title')) ?>
                                </th>
                                <th scope="col">
                                    <?= $this->e($this->translate('url-shortener-link-information-tracking-table-country-title')) ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach ($trackingData as $data): ?>
                                <tr>
                                    <th scope="row"><?= $data['accessed'] ?></th>
                                    <td>
                                        <?= empty($data['browser'])
                                            ? $this->e($this->translate('unknown-string'))
                                            : $data['browser'] ?>
                                    </td>
                                    <td>
                                        <?= empty($data['operatingSystem'])
                                            ? $this->e($this->translate('unknown-string'))
                                            : $data['operatingSystem'] ?>
                                    </td>
                                    <td>
                                        <?= empty($data['country'])
                                            ? $this->e($this->translate('unknown-string'))
                                            : $data['country'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <span class="text-center">
                        <?= $this->e($this->translate('url-shortener-link-information-tracking-table-tracking-disabled')) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
