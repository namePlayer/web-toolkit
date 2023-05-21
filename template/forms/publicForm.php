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
            <form action="/form/<?= $formInformation['uuid'] ?>/submit" method="post">
                <h2 class="mb-4">
                    <?= ($this->getAccountInformation() !== FALSE && $this->getAccountInformation()['id'] === $formInformation['account'])
                        ? '<a href="'.\App\Tool\FormsTool::TOOL_URL.'/edit/'.$formInformation['uuid'].'" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        </a>'
                        : ''
                    ?>
                    <?= $formInformation['name'] ?>
                </h2>

                <?php foreach ($formFields as $formField): ?>
                    <?= $this->insert('forms/fields/' . $formField['template'],
                        ['field' => $formField]) ?>
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
