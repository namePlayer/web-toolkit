<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <h1>Webtookit</h1>

    Version: <?= \App\Software::VERSION ?> <br>
    Build: <?= \App\Software::BUILD ?>
</div>
