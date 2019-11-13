<?php
    unset($_COOKIE);
    setcookie("name", NULL, -1);
    header("location:index.php");
    die();
?>