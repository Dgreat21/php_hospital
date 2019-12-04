<?php

include_once("header.php");
require_once ("my_sql.php");

$a = sql_get_signs($dbh, $_POST['doctor'], 2);
foreach ($a as $key){
    $name = $key['name'];
    $surname = $key['surname'];
    $diagnosis = strtoupper($key['diagnosis']);
    $date = $key['date'];
    $time = $key['time'];
    $sign_id = $key['id'];
    echo "
        <div class='Sign_to_doc line'>
        <h1>К вам записан пациент $name $surname <br>";
    if ($diagnosis)
        echo "с диагнозом $diagnosis";
    echo " на $date в $time</h1>
            <form method='post' action='remove_sign.php'>
                        <input type='hidden' name='sign_id' value='$sign_id'>
                        <input type='submit'  class='__r right __s html_architect' value='Удалить запись'>
                    </form>
        </div>";
}

echo "<form action='admin.php' method='post'><input class='__r right __s html_architect' type='submit' value='Вернуться'></form>";

include_once("footer.php");