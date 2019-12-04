<?php
var_dump($_POST);
//die();

require_once ("my_sql.php");

$id = $_POST['doctor'];

switch ($_POST['action']){
    case "rename":
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $profession = $_POST['profession'];

        sql_rename_doc($dbh, $id, $name, $surname, $profession);
        break;
    case "transfer":
        $new_host = $_POST['host'];
        sql_transfer_doc($dbh, $id, $new_host);
        break;
    case "vacation":
        sql_vacation_doc($dbh, $id, 0);
        break;
    case "return":
        sql_vacation_doc($dbh, $id, 1);
        break;
//    case "fired":
//        sql_rm_doc($dbh, $id);
//        break;
    case "new_doc":
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $profession = $_POST['profession'];
        $host = $_POST['host'];

        sql_add_doc($dbh, $name, $surname, $profession, $host);
        break;
    default:
        break;
}
//die();
header("location:admin.php");
die();