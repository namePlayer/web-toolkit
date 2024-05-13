<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/loginHeader', ['pageTitle' => 'account-licenses-manage-title']); ?>

    <div class="row mt-3">

        <?php $this->insert('element/accountSettingNavigation') ?>

        <div class="col">

            <div class="row mb-3">

                <div class="col-2"></div>
                <div class="col-8">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="100%" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                                    </svg>
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-5 align-middle">
                                    <h3><b><?= $this->translate($this->getLevelBadge()['label']) ?></b></h3>
                                    <p><?= $this->e($this->translate('account-licenses-current-page')) ?></p>
                                </div>
                                <div class="col-4 align-middle d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-primary w-100">
                                        <?= $this->e($this->translate('account-licenses-change-package-button')) ?>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-2"></div>

            </div>

        </div>

    </div>

</div>
