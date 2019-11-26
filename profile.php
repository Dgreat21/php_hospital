<?php
	include_once("header.php");
    require_once("my_sql.php");
$a = sql_get_signs($dbh, $_COOKIE['id']);

echo "<br><form action='kill.php' style='align = right'>
                <input type='submit'  class='__r right __s html_architect' value='Выйти'>
            </form>";
foreach ($a as $key){
    $name = $key['name'];
    $surname = $key['surname'];
    $profession = strtoupper($key['profession']);
    $date = $key['date'];
    $time = $key['time'];
    echo "
        <div class='Sign_to_doc line'>
            <h1>Вы записаны на прием к Врачу $name $surname <br> по специальности $profession на $date в $time</h1>
        </div>";
}

    include_once("footer.html");;
