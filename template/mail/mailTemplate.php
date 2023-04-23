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
        body {
            font-family: Arial;
        }
        #wrapper {
            text-align: center;
            max-width: 650px;
            width: auto;
            margin: auto;
            border-radius: 2px;
        }
        .btn-link {
            border: 1px solid gray;
            text-decoration: none;
            color: gray;
            padding: 10px 25px 10px 25px;
            border-radius: 5px;
        }
        .green {
            color: #008000;
        }
        .red {
            color: #800000;
        }
    </style>
</head>
    <body>

        <div id="wrapper">

            <?= $this->section('content') ?>

        </div>

    </body>
</html>