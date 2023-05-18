<?php $this->layout('tooltemplate', ['tool' => $tool, 'hideToolHeader' => true]); ?>

<div class="container">

    <div class="row mb-4 mt-4">
        <div class="col-6 d-flex align-items-center">
            <h3>
                <a href="<?= \App\Tool\FormsTool::TOOL_URL ?>"  style="text-decoration: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </a>
                <?= $form['name'] ?>
            </h3>
        </div>
        <div class="col-2 d-flex align-items-center">
        </div>
        <div class="col-3 d-flex align-items-center">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#formsToolAddNewFieldModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                <?= $this->e($this->translate('forms-tool-add-form-element-button')) ?>
            </button>
        </div>
        <div class="col-1 d-flex align-items-center">
            <button type="button" class="btn btn-secondary me-1" data-bs-toggle="modal" data-bs-target="#formsToolAddNewFieldModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                </svg>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#formsToolEditSettingsModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="row">

    </div>

</div>

<form action="" method="post">
    <div class="modal fade" id="formsToolAddNewFieldModal" tabindex="-1" aria-labelledby="formsToolAddNewFieldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formsToolAddNewFieldModalLabel">
                        <?= $this->translate('forms-tool-add-form-element-modal-title') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formsToolAddNewFieldTitle" class="form-label">
                            <?= $this->translate('forms-tool-form-element-title') ?>
                        </label>
                        <input type="text" class="form-control" id="formsToolAddNewFieldTitle">
                    </div>
                    <div class="mb-3">
                        <label for="formsToolAddNewFieldDescription" class="form-label">
                            <?= $this->translate('forms-tool-form-element-description') ?>
                        </label>
                        <input type="text" class="form-control" id="formsToolAddNewFieldDescription">
                    </div>
                    <div class="mb-3">
                        <label for="formsToolAddNewFieldType" class="form-label">
                            <?= $this->translate('forms-tool-form-element-type') ?>
                        </label>
                        <select class="form-select" aria-label="Default select example" id="formsToolAddNewFieldType">
                            <option selected></option>
                            <option value="text">Kurz-Text</option>
                            <option value="textarea">Lang-Text</option>
                            <option value="email">E-Mail</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= $this->e($this->translate('abort-button')) ?>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <?= $this->e($this->translate('add-button')) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
