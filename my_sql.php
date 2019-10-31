<?php
/**
 * Created by PhpStorm.
 * User: denco
 * Date: 11.12.2018
 * Time: 21:00
 */
    //include 'err.php';
    $dsn = 'mysql:dbname=den_test;host=localhost';
    $user = 'den';
    $password = 'jDhIIhWLmBqX';
    try {
        $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4 collate utf8mb4_general_ci'));
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
function sql_q($sql, $dbh, $key, $var=NULL)
{
    $sth = $dbh->prepare($sql);
    if ($var!=NULL) {
        $sth->bindParam(':polis', $var, PDO::PARAM_STR);
    }
    $c=$sth->execute();

    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    switch ($key){
        case 'id':
            return $res[0]['id'];
            break;
        case 'info':
            return $res;
            break;
        case 'polis':
            $a=0;
            if ($res[0]['polis']!=NULL) {$a++;};

            return $a;
            break;
        default:
            return $c;
            break;
    }

}

    function sql_c($sql, $dbh, $name, $pass ,$email){
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':name', $name, PDO::PARAM_STR);
        $sth->bindParam(':pass', $pass, PDO::PARAM_STR);
        if($email!=NULL)    $sth->bindParam(':email',$email,PDO::PARAM_STR);
        $a = $sth->execute();
        return $a;
    }
    function sql_art_up($art,$dbh)

    {
        var_dump($art);
//        $date=$art['release'];
//        $art['release']="$date";
        $sql = " insert into `soonfilms` set `title`=?,`release`=?, `plot`=?,`creator_id`=?";//
//$sql = " insert into `soonfilms` set `title`='?',`release`='?', `genre`='?', `plot`='?',`creator_id`='?'";//
        $sth=$dbh->prepare($sql);
        $a=$sth->execute(array($art['title'],$art['release'],$art['plot'],$_SESSION['id']));
        return $a;
    }
    function sql_art_down($dbh,$id)
    {
        $sql = "Select * from soonfilms where creator_id=$id";
        //echo $sql;
        $res=sql_q($sql,$dbh,'info');
        return $res;
    }
    function sql_get_id($dbh,$id)//$id -art_id
    {
        $sql = "Select * from soonfilms where creator_id=".$_SESSION['id']." and id=$id";
        //echo $sql;
        $res=sql_q($sql,$dbh,'info');
        return $res[0];
    }
//    $dsn = 'mysql:dbname=den_test;host=localhost';
//    $user = 'den';
//    $password = 'jDhIIhWLmBqX';
//    try {
//        $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4 collate utf8mb4_general_ci'));
//    } catch (PDOException $e) {
//        echo 'Подключение не удалось: ' . $e->getMessage();
//    }


