<?php $this->layout('mail/mailTemplate'); ?>
<h2>Ein Zweiter Faktor wurde hinterlegt.</h2> <br>
<span>Hallo<?= ' '.$accountName ?? ''?>,</span> <br>
<span>Dies ist eine E-Mail, um dich darüber zu informieren, dass deinem Konto ein neuer zweiter Faktor hinzugefügt worden ist.</span>
<br>
<span>Solltest du dies nicht veranlasst haben, trete bitte sofort mit unserem Support in Kontakt.</span>
<br><br>
<span>Solltest du das gewesen sein, kannst du diese E-Mail jedoch ignorieren.</span>
<br><br>
<span>Viele Grüße,</span> <br>
<span>Web-Toolkit Team</span>