<?php $this->layout('publictemplate', [
    'pageTitle' => $formInformation['name'] . ' | ' . $_ENV['SOFTWARE_TITLE'] . ' Forms',
    'background' => $formInformation['additionalData']['color'] ?? 'reset',
    'displayNavigation' => true,
    'isLoggedIn' => $this->getAccountInformation() !== FALSE
]); ?>

    <div class="container mt-3">

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">

            <div class="card">

                <div class="card-body">
                    <h3>Ihr Formular wurde abgesendet.</h3>
                </div>

            </div>

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
