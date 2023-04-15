<?php $this->layout('mail/mailTemplate'); ?>
<h2>Web-Toolkit Passwort zurücksetzen</h2>
<span>Bei uns ist eine Anfrage zum zurücksetzen deines Passwortes eingangen. Mit nachfolgendem Link kannst du dies in die Wege leiten.</span>
<br>
<a href="https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?>">
    https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?></a>
<br>
<br>
<span>Solltest du diese Anfrage nicht gestellt haben, so beachte diese E-Mail als Wertlos.</span> <br><br>
<?php if(isset($requestedByAdmin)): ?>
    <span>Diese Anfrage wurde durch einen Administrator ausgelöst.</span>
<?php endif; ?>
