<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">
            <h4 class="mb-3">Dashboard</h4>

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-dashboard-registered-accounts-card-title')) ?>
                            </span>
                            <h4 class="text-end"><?= $accountCount ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-dashboard-active-licenses-card-title')) ?>
                            </span>
                            <h4 class="text-end">0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-start">
                                <?= $this->e($this->translate('administration-dashboard-open-support-tickets-card-title')) ?>
                            </span>
                            <h4 class="text-end"><?= $supportTicketCount ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
