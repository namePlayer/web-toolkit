<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3 px-4 py-5">

    <?php if(!empty($domain)): ?>

        <div class="alert alert-success rounded-4" role="alert">
            <h4 class="alert-heading">
                <?= $this->e($this->translate('homepage-content-create-shortlink-created-notification-header')) ?>
            </h4>
            <p>
                <?= $this->e($this->translate('homepage-content-create-shortlink-created-notification-domain-link-text')) ?> <a href="<?= $domain ?>" class="alert-link"><?= $domain ?></a>
            </p>
            <hr>
            <p class="mb-0">
                <?= $this->e($this->translate('homepage-content-create-shortlink-created-notification-register-link-text')) ?>
                <a href="/authentication/register">
                    <?= $this->e($this->translate('homepage-content-create-shortlink-created-notification-register-url-content')) ?>
                </a>
            </p>
        </div>

    <?php endif; ?>

    <?php $this->insert('element/alert') ?>

   <form method="post">
       <div class="bg-dark text-secondary px-4 py-5 text-center">
           <div class="py-5">
               <h1 class="display-5 fw-bold text-white">
                   <?= $this->e($this->translate('homepage-content-create-shortlink-title')) ?>
               </h1>
               <div class="col-lg-8 mx-auto">
                   <input class="form-control form-control-lg mt-3 mb-2" type="text" name="indexPageShortlinkCreateDestination"
                          placeholder="http://google.com" id="indexPageShortlinkCreateDestination">
                   <p class="fs-5 mb-4">
                       <?= $this->e($this->translate('homepage-content-create-shortlink-description')) ?>
                   </p>
                   <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                       <a href="#" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold"><?= $this->e($this->translate('homepage-content-create-shortlink-explore-features-button')) ?></a>
                       <button type="submit" class="btn btn-outline-light btn-lg px-4"><?= $this->e($this->translate('homepage-content-create-shortlink-create-button')) ?></button>
                   </div>
               </div>
           </div>
       </div>
   </form>

</div>
