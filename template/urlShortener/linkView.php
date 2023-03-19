<?php

use App\Model\UrlShortener\Shortlink;

$this->layout('tooltemplate', ['toolInformation' => $toolInformation]);
/* @var $shortlink Shortlink */
?>

<div class="container">

    <?= $this->insert('urlShortener/navigation', ['path' => $toolInformation['tool-path']]) ?>

    <div class="row">
        <div class="col-md-3 mb-3">
            <h5 class="mb-3">Übersicht</h5>
            <ol class="list-group list-group-flush">
                <li class="list-group-item text-center">

                    <?= $shortlink->getUuid() ?>

                </li>

                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Erstellt</div>
                    </div>
                    <span><?= $shortlink->getDateTime()->format('d.m.Y H:i') ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Ablauf</div>
                    </div>
                    <span class="badge bg-secondary rounded-pill">

                        <?= $shortlink->getExpiryDate() === NULL
                            ? 'Nie'
                            : $shortlink->getExpiryDate()->format('d.m.Y H:i')
                        ?>

                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Passwort</div>
                    </div>
                    <?= $shortlink->getPassword() === NULL
                        ? '<span class="badge bg-danger rounded-pill">Deaktiviert</span>'
                        : '<span class="badge bg-success rounded-pill">Aktiviert</span>'
                    ?>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Tracking</div>
                    </div>
                    <?= $shortlink->isTracking()
                        ? '<span class="badge bg-success rounded-pill">Aktiviert</span>'
                        : '<span class="badge bg-danger rounded-pill">Deaktiviert</span>'
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
                                <th scope="col">Datum</th>
                                <th scope="col">Browser</th>
                                <th scope="col">Betriebssystem</th>
                                <th scope="col">Land</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($trackingData as $data): ?>


                                    <tr>
                                        <th scope="row"><?= $data['accessed'] ?></th>
                                        <td><?= $data['browser'] ?></td>
                                        <td><?= $data['operatingSystem'] ?></td>
                                        <td><?= empty($data['country']) ? 'UNK' : $data['country'] ?></td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    <?php else: ?>

                        <span class="text-center">Tracking ist für diesen Kurzlink deaktiviert</span>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>