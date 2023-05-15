<?php $this->layout('tooltemplate', ['tool' => $tool]); ?>

<div class="container">

    <div class="row mb-4 mt-4">
        <div class="col-4 d-flex align-items-center">
            <h3><?= $this->e($this->translate('forms-tool-main-pane-title')) ?></h3>
        </div>
        <div class="col-5 d-flex align-items-center">
        </div>
        <div class="col-3 d-flex align-items-center">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#formsToolCreateModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                <?= $this->e($this->translate('forms-tool-create-new-form-button')) ?>
            </button>
        </div>
    </div>

    <div class="row">

        <h4>Deine Formulare:</h4>

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="formsToolCreateModal" tabindex="-1" aria-labelledby="formsToolCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formsToolCreateModalLabel">
                        <?= $this->e($this->translate('forms-tool-create-new-modal-title')) ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formsToolCreateModalFormTitle" class="form-label">
                            <?= $this->e($this->translate('forms-tool-form-title-string')) ?>
                        </label>
                        <input type="text" class="form-control" id="formsToolCreateModalFormTitle" name="formsToolCreateModalFormTitle">
                    </div>
                    <div class="mb-3">
                        <label for="formsToolCreateModalFormTemplate" class="form-label">
                            <?= $this->e($this->translate('forms-tool-form-template-string')) ?>
                        </label>
                        <select class="form-select" id="formsToolCreateModalFormTemplate" name="formsToolCreateModalFormTemplate">
                            <option value="" selected><?= $this->e($this->translate('forms-tool-form-template-no-template')) ?></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->e($this->translate('create-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
