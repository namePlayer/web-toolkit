<div class="mb-3">

    <div class="card" id="<?= $field['uuid'] ?>"
         style="background: <?= $field['options']['fieldColor'] ?? 'reset' ?>;
             color: <?= $field['options']['fieldTextColor'] ?? 'reset' ?>;
             ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <label class="form-label mb-1 fs-5" for="<?= $field['uuid'] ?>">
                        <?= $this->e($field['title']) ?>
                        <?= isset($field['options']['required']) ? '<span class="text-danger ms-1">*</span>' : '' ?>
                    </label>
                    <p class="mb-2">
                        <?= $this->e($field['description']) ?>
                    </p>
                </div>
                <?php if(isset($editView)): ?>
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-primary float-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <textarea name="<?= $field['uuid'] ?>" id="<?= $field['uuid'] ?>" class="form-control"
                      <?= isset($editView) ? 'readonly' : '' ?>
                      placeholder="<?= $field['options']['placeholder'] ?? $this->translate('forms-textarea-field-default-placeholder') ?>"><?= $value ?? '' ?></textarea>
        </div>
    </div>

</div>
