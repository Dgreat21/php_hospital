<?php
include_once("header.php");
require_once("my_sql.php");
if ($_COOKIE['polis'] == NULL)
    header("location:index.php");
$a = sql_get_doctors($dbh, $_POST['host']);
    echo "<br>";
foreach ($a as $key)
{   $id = $key['id'];
    $name = $key['name'];
    $surname = $key['surname'];
    $profession = strtoupper($key['profession']);
    echo "<div class='Sign_to_doc line'>
                        <p>$name $surname\t$profession</p>
                    
                    <form method='post' action='create_sign.php'>
                        <input type='hidden' name='host' value='$id'>
                        <input required type='date' name='date'>
                        <input required type='time' name='time'>
                        <input type='submit'  class='__r right __s html_architect' value='Записаться'>
                    </form>
                </div><br>";
}


include_once("footer.html");
?>

</body>
</html>