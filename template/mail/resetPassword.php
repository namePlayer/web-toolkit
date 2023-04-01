<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <h2>Web-Toolkit Passwort zurücksetzen</h2>
    <a href="https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?>">
        https://<?= $_ENV['SOFTWARE_DEFAULT_HOST'] ?>/authentication/reset-password?token=<?= $token ?>
    </a>

</body>
</html>
