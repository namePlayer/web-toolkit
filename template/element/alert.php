<?php foreach (MESSAGES->getAll() as $alert): ?>

    <div class="alert alert-<?= $this->e($alert['type']) ?>">
        <?= $this->e($this->translate($alert['message'])) ?> <?= $alert['additionalData'] ?>
    </div>

<?php endforeach; ?>
