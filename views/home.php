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
        <script>window.student = {{ studentInfo }}</script>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../js/app.js"></script>
    </head>
    <body>
        <div class="container theme-showcase" role="main">
            <div class="container theme-showcase" role="main">
              <div class="jumbotron">
                <h1>Salut <span id="name"></span></h1>
                <p>On va voir ce que l'on peut faire pour les cadeaux...</p>
              </div>
                <div class="jumbotron">
                  <h2>Parle moi un peu de toi...</h2>
                  <form class="form-horizontal" method="post" action="/submit">
                    <fieldset>
                      <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Ta passion</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="inputEmail" placeholder="Les canards">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                          <button type="submit" class="btn btn-primary">Envoyer !</button>
                          <a href="/logout" class="btn btn-danger">Deconnexion</a>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
            </div>

        </div>
    </body>
</html>
EOD;
