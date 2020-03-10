<?php
//var_dump($_POST);
//var_dump($_COOKIE);
require_once("my_sql.php");
$host = $_POST['host'];//это ебаный гавнокод - связанный с обилием форм на странице, по другому не умею
$time =  $_POST['time'];
$date =  $_POST['date'];
//var_dump($_POST);
//var_dump($_COOKIE);
$time = "'$time:00'";
$date = "'$date'";
    $a = sql_create_sign($dbh, $_COOKIE['id'], $_POST['host'], $date, $time);
//    var_dump($a);
//die();
header("location:profile.php");