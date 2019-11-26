<?php
/**
 * Created by PhpStorm.
 * User: denco
 * Date: 11.12.2018
 * Time: 21:00
 */
    //include 'err.php';
    $dsn = 'mysql:dbname=den_test2;host=localhost';
    $user = 'den';
    $password = 'jDhIIhWLmBqX';

    try {
        $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4 collate utf8mb4_general_ci'));
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
function sql_quarry($sql, $dbh, $key, $var=NULL)
{
    $sth = $dbh->prepare($sql);
    if ($var!=NULL) {
        $sth->bindParam(':polis', $var, PDO::PARAM_STR);
    }
    $c=$sth->execute();

    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($res);
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

    function    sql_get_doctors($dbh, $id){

        $sql = "SELECT
                    `doctor`.*
                FROM `doctor`
                         INNER JOIN `doctorsToHospital`
                                    ON `doctor`.id = `doctorsToHospital`.doctor_id
                WHERE `doctorsToHospital`.hospital_id = $id";

        $sth = $dbh->prepare($sql);
//        $id = (int)$id;
//        $sth->bindParam(":doc",          $id,                PDO::PARAM_INT);
        $a = $sth->execute();

        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    function sql_c($sql, $dbh, $data){
        $sth = $dbh->prepare($sql);

        $sth->bindParam(':name',     $data['name'],     PDO::PARAM_STR);
        $sth->bindParam(':surname',  $data['surname'],  PDO::PARAM_STR);
        $sth->bindParam(':polis',    $data['polis'],    PDO::PARAM_STR);
        $sth->bindParam(':email',    $data['soap'],     PDO::PARAM_STR);
        $sth->bindParam(':pass',     $data['hash'],     PDO::PARAM_STR);

        $a = $sth->execute();
        return $a;
    }

    function sql_get_signs($dbh,  $id)//$who,
    {
        $sql = "SELECT `doctor`.profession, `doctor`.name, `doctor`.surname,  `sign`.time, `sign`.date FROM `sign`  INNER JOIN  `doctor` ON `doctor`.id = `sign`.doctor_id WHERE patient_id = $id";

        $sth = $dbh->prepare($sql);
        $a = $sth->execute();

        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    function sql_create_sign($dbh, $patient_id, $doc_id, $date, $time)
    {
        $sql = "INSERT INTO `den_test2`.`sign` (`patient_id`, `doctor_id`, `date`, `time`) VALUES ($patient_id, $doc_id, $date, $time)";

        var_dump($sql);
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();

    }

//    function sql_delete_sign($dbh, $patient_id, $doc_id, $date, $time)
//    {
//        $sql = "DELETE FROM `den_test2`.`sign` WHERE `patient_id` = :pat_id AND `doc_id` = :doc_id";
//    }



