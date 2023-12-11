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

                        <?= $this->insert('qrCodeGenerator/forms/'.$module.'Form', ['object' => $object]) ?>

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

            <div class="card mb-3">
                <div class="card-body">

                    <?php if(!empty($qrCode)): ?>

                        <img class="w-100" src="<?= $qrCode ?>">

                        <hr>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <a href="#" class="btn btn-primary w-100" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                    Download (PNG)
                                </a>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

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