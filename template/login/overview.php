<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-6">
            <h2><?= $this->e($this->translate($this->timeOfDayGreeting())) ?>, <?= $this->getAccountInformation()['name'] ?></h2>
            <small class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <?= $this->e($this->translate('managed-by-organisation')) ?> <a href="/account/organisation"><?= $this->e($this->translate('learn-more')) ?></a>
            </small>
        </div>
    </div>
    <hr>

    <h4><?= $this->e($this->translate('your-products-list-title')) ?></h4>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="text-start">URL-Kürzer</h5>
                        </div>
                        <div class="col-4">
                            <span class="badge text-bg-secondary text-end float-end">
                                <?= $this->e($this->translate('products-user-license-status-inclusive')) ?>
                            </span>
                        </div>
                    </div>
                    <span>Schafft kurze URLs zum einfachen Versenden von Webseiten</span>
                </div>
            </div>
        </div>
    </div>

</div>
