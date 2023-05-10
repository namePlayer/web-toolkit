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
            <?php $this->insert('element/alert') ?>

            <div class="row d-flex align-items-end">
                <div class="col-8 mb-3">
                    <h3>
                        <a href="/admin/urlshortener/alllinks"  style="text-decoration: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <?= $this->e($this->translate('administration-url-shortener-link-management-title')) ?>
                    </h3>
                    <span><a href="<?= $data->getDestination() ?>" class="link-secondary"><?= $this->e($data->getDestination()) ?></a></span>
                </div>
                <div class="col-4 mb-3">
                    <span><b>ID: </b> <?= $data->getId() ?></span> <br>
                    <span><b><?= $this->translate('customer-id-string') ?>: </b> <?= $data->getAccount() ?></span> <br>
                    <span><b>UUID: </b> <?= $this->e($data->getUUID()) ?></span> <br>
                </div>

                <div class="col-md-12 mt-4">

                    <ul class="nav nav-pills nav-fill mb-3" id="link-management-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="link-management-home-tab" data-bs-toggle="pill" data-bs-target="#link-management-home" type="button" role="tab" aria-controls="link-management-home" aria-selected="true">
                                <?= $this->translate('administration-url-shortener-link-management-information-tab-title') ?>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="link-management-tracking-tab" data-bs-toggle="pill" data-bs-target="#link-management-tracking" type="button" role="tab" aria-controls="link-management-tracking" aria-selected="false"
                                <?= $data->isTracking() ? '' : ' disabled' ?>>
                                <?= $this->translate('administration-url-shortener-link-management-tracking-tab-title') ?>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <?= $this->translate('administration-url-shortener-link-management-actions-tab-title') ?>
                            </a>
                            <ul class="dropdown-menu w-100">
                                <li><a class="dropdown-item link-danger" role="button" data-bs-toggle="modal" data-bs-target="#deleteShortlinkModal">
                                        <?= $this->translate('administration-url-shortener-link-management-actions-tab-lock') ?>
                                    </a></li>
                                <li><a class="dropdown-item link-danger" role="button" data-bs-toggle="modal" data-bs-target="#deleteShortlinkModal">
                                        <?= $this->translate('administration-url-shortener-link-management-actions-tab-delete') ?>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="tab-content" id="link-management-tabContent">
                        <div class="tab-pane fade show active" id="link-management-home" role="tabpanel" aria-labelledby="link-management-home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5><?= $this->translate('url-shortener-link-list-table-domain-title') ?></h5>
                                            <span><?= $this->e($domain ?? \App\Tool\ShortlinkTool::getDefaultUrl()) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5><?= $this->translate('url-shortener-link-information-tracking') ?></h5>
                                            <?= $data->isTracking()
                                                ? '<span class="text-success">'.$this->translate('active-string').'</span>'
                                                : '<span class="text-danger">'.$this->translate('disabled-string').'</span>'
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5><?= $this->translate('url-shortener-link-information-password') ?></h5>
                                            <?= $data->getPassword() !== NULL
                                                ? '<span class="text-success">'.$this->translate('active-string').'</span>'
                                                : '<span class="text-danger">'.$this->translate('disabled-string').'</span>'
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Erstellt</h5>
                                            <span>
                                                <?= $data->getDateTime()->format($this->translate('dateTime-format')) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5><?= $this->translate('url-shortener-link-information-expiry') ?></h5>
                                            <?= $data->getExpiryDate() !== NULL
                                                ? $data->getExpiryDate()->format($this->translate('dateTime-format'))
                                                : '<span>'.$this->translate('url-shortener-link-information-never-string').'</span>'
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($tracking !== NULL): ?>
                            <div class="tab-pane fade" id="link-management-tracking" role="tabpanel" aria-labelledby="link-management-tracking-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="float-start"><?= $this->translate('url-shortener-link-information-clicks') ?></span>
                                                <h4 class="text-end"><b><?= $clickCount ?></b></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-date-title') ?>
                                                        </th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-browser-title') ?>
                                                        </th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-os-title') ?>
                                                        </th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-country-title') ?>
                                                        </th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-device-title') ?>
                                                        </th>
                                                        <th scope="col">
                                                            <?= $this->translate('url-shortener-link-information-tracking-table-referer-title') ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($tracking as $track): ?>
                                                        <tr>
                                                            <th scope="row"><?= $track['id'] ?></th>
                                                            <td><?= $this->e($track['accessed']) ?></td>
                                                            <td><?= $this->e($track['browser']) ?></td>
                                                            <td><?= $this->e($track['operatingSystem']) ?></td>
                                                            <td><?= $this->e($track['country']) ?></td>
                                                            <td><?= $this->e($track['device']) ?></td>
                                                            <td><?= $this->e($track['referer']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


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
                    <h1 class="modal-title fs-5" id="deleteShortlinkModalLabel">Delete Shortlink</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span>To confirm this action please enter the following: <b><?= $deleteCode ?></b></span>
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

