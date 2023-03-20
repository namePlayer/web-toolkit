<?php $this->layout('basetemplate') ?>

<div class="container mt-5">
    <?php foreach (MESSAGES->getAll() as $alert): ?>

        <?php $this->insert('element/alert', $alert) ?>

    <?php endforeach; ?>

    <?php if(isset($passwordRequired) && $passwordRequired === TRUE): ?>
        <form method="post">
            <div class="row">
                <div class="col-8 mb-3">
                    <label for="urlShortenerLinkPassword">Passwort</label>
                    <input type="password" name="urlShortenerLinkPassword" id="urlShortenerLinkPassword" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary h-100">Passwort bestätigen</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
