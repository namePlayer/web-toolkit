<div class="alert alert-danger">

    <?= $this->translate('organisation-settings-invite-no-organisation-member') ?>

</div>

<form action="" method="post">

    <div class="row">

        <div class="col-2"></div>
        <div class="col-md-6">
            <label for="organisationJoinInviteCode" class="form-label">
                <?= $this->translate('organisation-settings-invite-code-label') ?>
            </label>
            <input type="text" class="form-control" id="organisationJoinInviteCode" name="organisationJoinInviteCode">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                <?= $this->translate('organisation-settings-invite-join-label') ?>
            </button>
        </div>
        <div class="col-2"></div>

    </div>

</form>