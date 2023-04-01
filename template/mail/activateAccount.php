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
    </div>

</body>
</html>
