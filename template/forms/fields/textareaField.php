<div class="mb-3">

    <div class="<?= isset($editView) ? 'card' : '' ?>">
        <div class="<?= isset($editView) ? 'card-body' : '' ?>">
            <div class="row">
                <div class="col-10">
                    <label class="form-label mb-1" for="textInput"><h5>Feldname<?= isset($required) ? '<span class="text-danger ms-1">*</span>' : '' ?></h5></label>
                    <p class="text-muted">Feldbeschreibung</p>
                </div>
                <div class="col-2">
                    <?= isset($editView)
                        ? '<button type="button" class="btn btn-primary float-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </button>'
                        : '' ?>
                </div>
            </div>
            <input type="text" name="" id="textInput" class="form-control" placeholder="A Short Text..." readonly>
        </div>
    </div>

</div>