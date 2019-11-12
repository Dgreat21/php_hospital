<?php
    session_start();
if ($_SESSION['name'] == NULL) {
	$name = "Войти";
}
else
	$name = "Здравствуйте, " . $_SESSION['name'] . " " . $_SESSION['surname'];


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/hospitals.css">
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="icon" href="resources/favicon.ico" type="image/x-icon">
	<script type="text/javascript" src="js/registration.js"></script>
	<title>SIP</title>
</head>
<body>
<div class="meta-div"></div>
<header>
	<div class="wrapper">
		<div class="menu">
			<div class="menu_left">
				<nav>
					<ul class="navigation">
						<li><a href="index.php">Запись к врачу</a></li>
						<li><a href="hospitals.php">Учреждения</a></li>
						<li><a href="reference.php">Справки</a></li>
						<li><a href="insurance.php">Страховка</a></li>
						<li><a href="prevention.php">Профилактика</a></li>
					</ul>
				</nav>
			</div>
			<button class="login" onclick="add_market_meta()"><?=$name?></button>
		</div>
	</div>
</header>