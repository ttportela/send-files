<?php 
include_once 'func.php'; 
include_once 'classes.php';

if (isGET('clear')) {
  clear();
  header("Location: index.php");
  die();
}

$user = getProfil();
$mail_to = getMailTo();

?>
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Provas</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/favicon.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Provas</span>
          <div class="mdl-layout-spacer"></div>
          <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div-->
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item" id="show-about">Sobre</li>
            <li><a class="mdl-menu__item" href="http://tarlis.com.br" target="_blank">Contato</a></li>
          </ul>
        </div>
      </header>
      
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <form id="basic-data" action="#" method="POST">
            <div class="mdl-grid mdl-cell--12-col">
              <!--div class="mdl-cell mdl-cell--12-col"-->
                <div class="mdl-cell mdl-cell--9-col">
                  <span>Enviar arquivos de prova.</span>
                </div>
              <!--/div-->

              <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="student_name" value="<?php echo $user->name; ?>" onchange="formsubmit()">
                  <label class="mdl-textfield__label" for="student_name">Nome do Aluno</label>
                  <span class="mdl-textfield__error">Por favor informe seu nome.</span>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="email" id="student_mail" value="<?php echo $user->mail; ?>" onchange="formsubmit()" >
                  <label class="mdl-textfield__label" for="student_mail">Email de Contato</label>
                  <span class="mdl-textfield__error">Por favor informe um email válido.</span>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="email" id="prof_mail" value="<?php echo $mail_to; ?>" onchange="formsubmit()">
                  <label class="mdl-textfield__label" for="prof_mail">Email do Professor</label>
                  <span class="mdl-textfield__error">Por favor informe um email válido.</span>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--2-col">
                <a href="index.php?clear=1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-400">Limpar</a>
              </div>
              <div class="mdl-cell mdl-cell--2-col">
                <a target="_blank" href="print.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--secondary">Conferir</a>
              </div>
              <!--div class="mdl-layout-spacer"></div-->
              <div class="mdl-cell mdl-cell--2-col">
                <a target="_blank" href="print.php?redirect=1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Enviar</a>
                <!--button id="submit" onclick="formsubmit()" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">Enviar</button-->
              </div>
            </div>
            </form>
          </div>
          <?php include 'files_list.php'; ?>
          <?php include 'upload_card.php'; ?>
        </div>
      </main>
    </div>
    <?php include 'pop_add_file.php'; ?>
    <?php include 'pop_about.php'; ?>
      
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="drag_upload.js"></script>
  </body>
</html>
