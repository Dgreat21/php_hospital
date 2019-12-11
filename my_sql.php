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

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}

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


        define('PATIENT', 1);
        define('DOCTOR', 2);
        define('ADMIN', 3);

    function sql_get_signs($dbh,  $id, $who = PATIENT)//$who,
    {
//        var_dump($id);
//        var_dump(DOCTOR);
//        var_dump($who);
//        var_dump($who == DOCTOR);
        if ($who == PATIENT)
            $sql = "SELECT `sign`.id, `doctor`.profession, `doctor`.name, `doctor`.surname,  `sign`.time, `sign`.date FROM `sign`  INNER JOIN  `doctor` ON `doctor`.id = `sign`.doctor_id WHERE patient_id='$id'";
        else if ($who == DOCTOR)
            {
//                echo "test";
//                var_dump($id);
//                var_dump($who);
                $sql = "SELECT `sign`.id, `patient`.diagnosis, `patient`.name, `patient`.surname,  `sign`.time, `sign`.date FROM `sign`  INNER JOIN  `patient` ON `patient`.id = `sign`.patient_id WHERE doctor_id='$id'";
            }

        $sth = $dbh->prepare($sql);
        $a = $sth->execute();

        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($res);

        return $res;
    }

    function sql_get_all_docs($dbh)
    {
        $sql = "SELECT `doctor`.id, `doctor`.name, `doctor`.surname, `doctor`.profession, `doctor`.active, `doctorsToHospital`.hospital_id FROM `doctor` INNER JOIN `doctorsToHospital` ON `doctorsToHospital`.doctor_id=`doctor`.id";
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();

        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($res);
    }

    function sql_create_sign($dbh, $patient_id, $doc_id, $date, $time)
    {
        echo "что блять происходит";
        $sql = "INSERT INTO `den_test2`.`sign` (`patient_id`, `doctor_id`, `date`, `time`) VALUES ($patient_id, $doc_id, $date, $time)";

//        var_dump($sql);
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
        return ($a);

    }

    function sql_delete_sign($dbh, $sign_id)
    {
        $sql = "DELETE FROM `den_test2`.`sign` WHERE id ='$sign_id'";
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
    }

    function sql_rename_doc($dbh, $id, $name, $surname, $profession)
    {
        $sql = "UPDATE `doctor` SET `name`=:name, `surname`=:surname, `profession`=:profession WHERE id=$id";
        $sth = $dbh->prepare($sql);

        $sth->bindParam(':name',        $name,           PDO::PARAM_STR);
        $sth->bindParam(':surname',     $surname,        PDO::PARAM_STR);
        $sth->bindParam(':profession',  $profession,     PDO::PARAM_STR);
//        var_dump($sql);
        $a = $sth->execute();
//        var_dump($a);
    }

    function sql_transfer_doc($dbh, $id, $new_host)
    {
        $sql = "UPDATE `doctorsToHospital` SET `hospital_id`=$new_host WHERE `doctor_id`=$id";
        var_dump($sql);
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
    }

    function sql_vacation_doc($dbh, $id, $flag = 1){
        $sql = "UPDATE `doctor` SET `active`=$flag WHERE `id`=$id";
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
    }

    function sql_add_doc($dbh, $name, $surname, $profession, $host){
        $sql = "INSERT INTO `doctor` SET `name`=:name, `surname`=:surname, `profession`=:profession, `active`='1';";
        $sth = $dbh->prepare($sql);

        $sth->bindParam(':name',        $name,           PDO::PARAM_STR);
        $sth->bindParam(':surname',     $surname,        PDO::PARAM_STR);
        $sth->bindParam(':profession',  $profession,     PDO::PARAM_STR);
//        var_dump($sql);
        $a = $sth->execute();
        $sql = "SELECT `doctor`.id FROM doctor WHERE `name`=:name and `surname`=:surname and `profession`=:profession";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':name',        $name,           PDO::PARAM_STR);
        $sth->bindParam(':surname',     $surname,        PDO::PARAM_STR);
        $sth->bindParam(':profession',  $profession,     PDO::PARAM_STR);
        $a = $sth->execute();
        var_dump($a);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        $id = $res[0]['id'];
        $sql = "INSERT INTO `doctorsToHospital` SET `doctor_id`=$id, `hospital_id`=$host";
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
    }

    function sql_rm_doc($dbh, $id){
        $sql = "DELETE `doctor`, `doctorsToHospital` FROM `doctor`, `doctorsToHospital` WHERE `doctor`.id=$id AND doctor_id=$id";
        $sth = $dbh->prepare($sql);
        $a = $sth->execute();
    }
