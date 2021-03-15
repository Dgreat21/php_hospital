<?php
function kill(){
    setcookie("name", NULL, -1);
    setcookie("id", NULL, -1);
    setcookie("surname", NULL, -1);
    setcookie("polis", NULL, -1);
    setcookie("wr pass", NULL, -1);
    setcookie("user !exist", NULL, -1);
    unset($_COOKIE);
}
    kill();
    header("location:index.php");
    die();
?>