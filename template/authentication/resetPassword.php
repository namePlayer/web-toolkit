<?php $this->layout('basetemplate'); ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">

    <?php $this->insert('element/alert') ?>

    <div class="row mt-5 mb-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="mb-4 text-center">
                <h3 class="mb-3"><?= $this->e($this->translate('reset-password-title')) ?></h3>
                <span><?= $this->e($this->translate('reset-password-header-text')) ?></span>
            </div>

            <form action="" method="post">
                <div class="mb-4">
                    <h6><label for="resetPasswordPassword" class="form-text"><?= $this->e($this->translate('password')) ?></label></h6>
                    <input type="password" class="form-control form-control-md" name="resetPasswordPassword" id="resetPasswordPassword" required>
                </div>
                <div class="mb-4">
                    <h6><label for="resetPasswordPasswordAgain" class="form-text"><?= $this->e($this->translate('password-again')) ?></label></h6>
                    <input type="password" class="form-control form-control-md" name="resetPasswordPasswordAgain" id="resetPasswordPasswordAgain" required>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col-6 d-flex align-items-center">

                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary w-100"><?= $this->e($this->translate('reset-password-button-text')) ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>
