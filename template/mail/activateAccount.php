<?php $this->layout('mail/mailTemplate'); ?>
<h2>Web-Toolkit Account aktivieren</h2>
<span>Hallo <?= $name ?>,</span>
<br><br>
<span>mit dem nachfolgenden Link kannst du deinen Web-Toolkit Account aktivieren und dich in deinem Konto direkt anmelden.</span> <br>
<a href="https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/activate-account?token=<?= $token ?>">
    https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/activate-account?token=<?= $token ?>
</a> <br>
<span style="color: #95a5a6;">Hinweis: Dieser Aktivierungsschlüssel ist maximal nur eine Stunde gültig.</span>
<br><br>
<span>Viele Grüße,</span> <br>
<span>Web-Toolkit Team</span>