<?php
	include_once("header.php");
    require_once("my_sql.php");
    ?>
    <section>
        <div class="wrapper">
        <?php
$a = sql_get_signs($dbh, $_COOKIE['id']);
$sql = "SELECT * FROM patient where polis=:polis";
$b = sql_quarry($sql, $dbh, 'info', $_COOKIE['polis']);
//var_dump($b);
$d = $b[0]['diagnosis'];
//var_dump($d);
if ($d)
{echo "
    <div class='Sign_to_doc line'>  Наши врачи поставили вам Диагоноз: $d
    </div>
";}

//echo "<br><form action='kill.php'>
//                <input type='submit'  class='__r right __s html_architect' value='Выйти'>
//            </form>";
foreach ($a as $key){
    $name = $key['name'];
    $surname = $key['surname'];
    $profession = strtoupper($key['profession']);
    $date = $key['date'];
    $time = $key['time'];
    $sign_id = $key['id'];
    echo "
        <div class='Sign_to_doc line'>
            <h1>Вы записаны на прием к Врачу $name $surname <br> по специальности $profession на $date в $time</h1>
            <form method='post' action='remove_sign.php'>
                        <input type='hidden' name='sign_id' value='$sign_id'>
                        <input type='submit'  class='__r right __s html_architect' value='Удалить запись'>
                    </form>
        </div>";
}
?>
</div>
</section>
<?php
    include_once("footer.php");
?>