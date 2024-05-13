<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-4">

    <h2>
        <?= $this->e($this->translate('products-content-header-title')) ?>
    </h2>

    <?php $this->insert('element/alert') ?>



</div>
