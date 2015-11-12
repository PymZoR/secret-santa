<?php

$content = <<<EOD
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>UTT Secret Santa</title>
        <link rel="stylesheet" href="bower_components/bootswatch-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="app.js"></script>
    </head>
    <body>
        <div class="fullscreen-bg">
            <video loop muted autoplay class="fullscreen-bg__video">
                <source src="background.webm" type="video/webm">
            </video>
        </div>
        <div id="connect" class="col-lg-4">
            <form class="form-horizontal">
              <fieldset>
                <legend>Connexion</legend>
                <div class="form-group">
                  <a href="/oauth/authorize" id="inscription" class="btn btn-lg btn-danger">Je veux offrir <i class="icon fa fa-gift fa-fw"></i></a>
                </div>
            </fieldset>
            </form>
        </div>

    </body>
</html>
EOD;
