<?php $this->layout('tooltemplate', ['tool' => $tool]); ?>

<div class="container">

    <div class="row mb-4 mt-4">
        <div class="col-4 d-flex align-items-center">
            <h3><?= $this->e($this->translate('qrcode-generator-creation-pane-title')) ?></h3>
        </div>
        <div class="col-8 d-flex align-items-center">
            <?= $this->insert('qrCodeGenerator/presetSelection', ['tool' => $tool]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">

            <form action="" method="post">
                <div class="card mb-3">

                    <div class="card-body">

                        <?= $this->insert('qrCodeGenerator/forms/'.$module.'Form') ?>

                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <?= $this->e($this->translate('qrcode-generator-creation-create-button')) ?>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="accordion" id="customizeQrCodeAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#customizeQrCodeAccordion-body" aria-expanded="false" aria-controls="customizeQrCodeAccordion-body">
                                <?= $this->e($this->translate('qrcode-generator-creation-customize-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="customizeQrCodeAccordion-body" class="accordion-collapse collapse" data-bs-parent="#customizeQrCodeAccordion">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-body">

                    <?php if(!empty($qrCode)): ?>

                        <img class="w-100" src="<?= $qrCode ?>">

                    <?php else: ?>

                        <h4 class="text-center m-5">
                            <?= $this->e($this->translate('qrcode-generator-no-qr-display-text')) ?>
                        </h4>

                    <?php endif; ?>

                </div>
            </div>

            <?php if(!empty($data)): ?>

                <div class="accordion" id="rawQrCodeDataAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rawQrCodeDataAccordion-body" aria-expanded="false" aria-controls="rawQrCodeDataAccordion-body">
                                <?= $this->e($this->translate('qrcode-generator-raw-data-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="rawQrCodeDataAccordion-body" class="accordion-collapse collapse" data-bs-parent="#rawQrCodeDataAccordion">
                            <div class="accordion-body" style="white-space: pre-wrap; ">

                                <code>
                                    <?= trim($data) ?>
                                </code>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>