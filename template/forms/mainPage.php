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

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">
                    <?= $this->translate('forms-tool-form-list-title-heading') ?>
                </th>
                <th scope="col">
                    <?= $this->translate('forms-tool-form-list-created-heading') ?>
                </th>
                <th scope="col">
                    <?= $this->translate('forms-tool-form-list-edited-heading') ?>
                </th>
                <th scope="col">
                    <?= $this->translate('forms-tool-form-list-visibility-heading') ?>
                </th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Bestellung eines T-Shirts</th>
                    <td>01.05.2023 12:34</td>
                    <td>16.05.2023 21:30</td>
                    <td>Privat</td>
                    <td>
                        <a href="#" class="text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil me-1" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                            Bearbeiten
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

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
