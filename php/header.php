<?php
if ($_COOKIE['name'] == NULL) {
	$name = "Войти";
    setcookie("name", NULL, -1);
    setcookie("id", NULL, -1);
    setcookie("surname", NULL, -1);
    setcookie("polis", NULL, -1);
    setcookie("wr pass", NULL, -1);
    setcookie("user !exist", NULL, -1);
    unset($_COOKIE);
}
else
	{

	    $name = "Здравствуйте, " . $_COOKIE['name'] . " " . $_COOKIE['surname'];
        $kill = "<form action='kill.php'>
                <input type='submit'  class='login_inp' value='Выйти'>
            </form>";

	}

//var_dump($_COOKIE);
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
	<link rel="stylesheet" type="text/css" href="css/insurance.css">
	<link rel="stylesheet" type="text/css" href="css/prevention.css">
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
<!--						<li><a href="reference.php">Справки</a></li>-->
						<li><a href="insurance.php">Страховка</a></li>
						<li><a href="prevention.php">Профилактика</a></li>
					</ul>
				</nav>
			</div>
			<div class="menu_right">
            <?php
            if ($name != "Войти") {
			    echo "<form action='profile.php'><input type='submit' class='login' value='$name'</a></input></form>";
			    echo "$kill"."";
                if ($_COOKIE['id'] == 1 || $_COOKIE['id'] == 14 || $_COOKIE['id'] == 10){
                    echo "<form action='admin.php'>
                            <input type='submit'  class='login_inp' value='Админка'></form>";
                }
			}
            else {
			    echo "<button class='login' onclick='add_market_meta()'>$name</button>";
            }
            ?>
        </div>
		</div>
	</div>
</header>