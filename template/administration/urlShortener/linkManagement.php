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
            <div class="row">
                <div class="col-8 align-items-center">
                    <h3><?= $this->e($this->translate('administration-url-shortener-link-management-title')) ?></h3>
                    <span><a href="<?= $data->getDestination() ?>" class="link-secondary"><?= $data->getDestination() ?></a></span>
                </div>
                <div class="col-4">
                    <span><b>ID: </b> <?= $data->getId() ?></span> <br>
                    <span><b>Kundennummer: </b> <?= $data->getAccount() ?></span> <br>
                    <span><b>UUID: </b> <?= $data->getUUID() ?></span> <br>
                </div>

                <div class="col-md-12">



                </div>
            </div>
        </div>

    </div>

</div>
