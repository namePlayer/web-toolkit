<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        #wrapper {
            text-align: center;
            max-width: 650px;
            width: auto;
            margin: auto;
            -webkit-box-shadow: 0px 0px 13px -9px #000000;
            box-shadow: 0px 0px 13px -9px #000000;
            border-radius: 2px;
        }
    </style>
</head>
<body>

    <div id="wrapper">
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
    </div>

</body>
</html>
