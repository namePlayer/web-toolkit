<?php $this->layout('publictemplate', ['pageTitle' => $formInformation['name'] . ' | ' . $_ENV['SOFTWARE_TITLE'] . ' Forms']); ?>

<div class="container mt-3">

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <h2 class="mb-4"><?= $formInformation['name'] ?></ß0ß></h2>

                <?php foreach ($formFields as $formField): ?>

                    <?= $this->insert('forms/fields/' . $formField['template'], ['field' => $formField]) ?>

                <?php endforeach; ?>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100">Formular absenden</button>
                    </div>
                </div>
            </form>

            <div class="text-center mb-5 mt-5">
                <small>Geben Sie niemals Passwörter über Formulare weiter.</small>
                <p class="text-muted">
                    Dieses Formular wird Ihnen von <a href="#" class="text-decoration-none"><?= $_ENV['SOFTWARE_TITLE'] ?></a> bereitgestellt.
                </p>
                <?php if(!isset($formInformation['additionalData']['officialForm'])): ?>
                    <small class="text-muted">
                        Die Betreiber von <?= $_ENV['SOFTWARE_TITLE'] ?> sind für die Inhalte dieses Formulares nicht verantwortlich.
                    </small> <br>
                <?php endif; ?>
                <small>
                    <a href="#" class="text-decoration-none">Datenschutz</a> -
                    <a href="#" class="text-decoration-none">Nutzungsbedingungen</a> -
                    <a href="#" class="text-decoration-none">Weitere Informationen</a> </small>
            </div>

        </div>
        <div class="col-2"></div>
    </div>

</div>
