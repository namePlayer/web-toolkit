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

                        <?= $this->insert('qrCodeGenerator/forms/textForm') ?>

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

                <div class="accordion" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?= $this->e($this->translate('qrcode-generator-creation-customize-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
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



                </div>
            </div>

        </div>

    </div>

</div>