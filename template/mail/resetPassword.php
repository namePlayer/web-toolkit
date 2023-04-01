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
        <h2>Web-Toolkit Passwort zurücksetzen</h2>
        <span>Bei uns ist eine Anfrage zum zurücksetzen deines Passwortes eingangen. Mit nachfolgendem Link kannst du dies in die Wege leiten.</span> <br>
        <a href="https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?>">
            https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?>
        </a>
        <br><br>
        <span>Solltest du diese Anfrage nicht gestellt haben, so beachte diese E-Mail als Wertlos.</span>
    </div>

</body>
</html>
