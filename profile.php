<?php
	include_once("header.php");
    require_once("my_sql.php");
$a = sql_get_signs($dbh, $_COOKIE);
foreach ($a as $key){

    $name = $key['name'];
    $surname = $key['surname'];
    $profession = strtoupper($key['profession']);
    $date = $key['date'];
    $time = $key['time'];
    echo "<div class='Sign_to_doc line'>
                        <p>Вы записаны на прием к Врачу $name $surname <br> по специальности $profession на $date в $time</p>
                    
                    <form action='kill.php'>
                        
                        <input type='submit'  class='__r right __s html_architect' value='Выйти'>
                </div><br>";
}
?>
<div class="exit">
    <input type="submit" name="exit_but" class="submit">
        <span>Выйти</span>
</div>
<?php
    if ($_POST['exit_but'])
        include_once(kill.php);
    include_once("footer.html");;
?>