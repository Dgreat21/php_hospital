<?php
    require_once("my_sql.php");

    $sign_id = $_POST['sign_id'];
    sql_delete_sign($dbh, $sign_id);
    header("location:profile.php");
    die();