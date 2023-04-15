<?php $this->layout('mail/mailTemplate'); ?>
<h2>Neue Anmeldung in deinem Web-Toolkit Account erkannt</h2> <br>
<span>Hallo <?= $accountName ?? ''?>,</span> <br>
<span>Unser System hat eine neue Anmeldung in deinem Konto feststellen können.</span>
<br>
<br>
<span><b>Browser: <?= $browser ?></b> </span> <br>
<span><b>Land: <?= $country ?></b> </span> <br>
<span><b>IP-Adresse: <?= $ip ?></b> </span> <br>
<br><br>
<span>Solltest du das gewesen sein, kannst du diese E-Mail ignorieren. Ansonsten ändere bitte sofort dein Passwort und wende dich an unseren Support.</span>
<br><br>
<span>Viele Grüße,</span> <br>
<span>Web-Toolkit Team</span>