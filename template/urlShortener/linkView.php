<?php

use App\Model\UrlShortener\Shortlink;

$this->layout('tooltemplate', ['toolInformation' => $toolInformation]);
/* @var $shortlink Shortlink */
?>

<div class="container">

    <?= $this->insert('urlShortener/navigation', ['path' => $toolInformation['tool-path']]) ?>

    <div class="row">
        <div class="col-md-3 mb-3">
            <h5 class="mb-3"><?= $this->e($this->translate('url-shortener-link-information-title')) ?></h5>
            <ol class="list-group list-group-flush">
                <li class="list-group-item text-center">

                    <?= $shortlink->getUuid() ?>

                </li>

                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                            <?= $this->e($this->translate('url-shortener-link-information-created')) ?>
                        </div>
                    </div>
                    <span><?= $shortlink->getDateTime()->format('d.m.Y H:i') ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $this->e($this->translate('url-shortener-link-information-expiry')) ?></div>
                    </div>
                    <span class="badge bg-secondary rounded-pill">

                        <?= $shortlink->getExpiryDate() === NULL
                            ? $this->e($this->translate('url-shortener-link-information-never-string'))
                            : $shortlink->getExpiryDate()->format('d.m.Y H:i')
                        ?>

                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $this->e($this->translate('url-shortener-link-information-password')) ?></div>
                    </div>
                    <?= $shortlink->getPassword() === NULL
                        ? '<span class="badge bg-danger rounded-pill">'. $this->e($this->translate('url-shortener-link-information-disabled-string')) .'</span>'
                        : '<span class="badge bg-success rounded-pill">'. $this->e($this->translate('url-shortener-link-information-enabled-string')) .'</span>'
                    ?>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $this->e($this->translate('url-shortener-link-information-tracking')) ?></div>
                    </div>
                    <?= $shortlink->isTracking()
                        ? '<span class="badge bg-success rounded-pill">'. $this->e($this->translate('url-shortener-link-information-enabled-string')) .'</span>'
                        : '<span class="badge bg-danger rounded-pill">'. $this->e($this->translate('url-shortener-link-information-disabled-string')) .'</span>'
                    ?>
                </li>
            </ol>
        </div>

        <div class="col-md-9 mb-3">
            <div class="card">
                <div class="card-header">
                    Letzte 10 Aufrufe:
                </div>
                <div class="card-body <?= !$shortlink->isTracking() ? 'text-center' : '' ?>">

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
                            <tbody>

                            <?php foreach ($trackingData as $data): ?>

                                    <tr>
                                        <th scope="row"><?= $data['accessed'] ?></th>
                                        <td>
                                            <?= empty($data['browser'])
                                                ? $this->e($this->translate('url-shortener-link-information-tracking-table-unknown-string'))
                                                : $data['browser'] ?>
                                        </td>
                                        <td>
                                            <?= empty($data['operatingSystem'])
                                                ? $this->e($this->translate('url-shortener-link-information-tracking-table-unknown-string'))
                                                : $data['operatingSystem'] ?>
                                        </td>
                                        <td>
                                            <?= empty($data['country'])
                                                ? $this->e($this->translate('url-shortener-link-information-tracking-table-unknown-string'))
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

</div>