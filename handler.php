<?php
/**
 * Created by PhpStorm.
 * User: denco
 * Date: 06.12.2018
 * Time: 18:48
 */

    session_start();
include_once 'my_sql.php';

    if ($_SESSION['name']!=NULL){
        header('Location:profile.php');
        die();
    }
    $status_err = [
        'wr conf' => false,//пароли не совпадают
        'user exist' => false,// пользователь с данным именем уже существует
        'user !exist' => false,//пользователь с данным именем не существует
        'wr pass' => false,//неправильный пароль
        'no'=>[
            'name'=>false,
            'pass'=>false,
            'name_reg'=>false,
            'pass+'=>false,
            'pass-'=>false,
            'email'=>false,
            'check'=>false,
        ],
    ];

    function check_p($reg_auth){
        //var_dump($reg_auth);
//        if (!$reg_auth){//0--sign up
//            if ($_POST['polis_reg']=='') $status_err['name_reg'] = true;
//            else    $status_err['name_reg'] = false;//
//            if ($_POST['soap']=='') $status_err['email'] = true;
//            else    $status_err['email'] = false;//
//            if ($_POST['pass-']=='') $status_err['pass-'] = true;
//            else    $status_err['pass-'] = false;//
//            if ($_POST['pass+']=='') $status_err['pass+']=true;
//            else    $status_err['pass+'] = false;//
//            $status_err['check'] = !($status_err['name_reg'] || $status_err['email'] || $status_err['pass-'] || $status_err['pass+']);
//
//            return $status_err;
//        }
//        else if ($reg_auth){
//            if ($_POST['polis']=='') $status_err['name'] = true;
//            else $status_err['name'] = false;
//        if ($_POST['pass']=='') $status_err['pass']=true;
//        else $status_err['pass'] = false;
            $status_err['name'] = ($_POST['polis']=='') ? (true) : (false);
            $status_err['pass'] = ($_POST['pass']=='') ? (true) : (false);
            $status_err['check'] = !($status_err['name'] || $status_err['pass']);

            return $status_err;
//        }
//        else{
//            return NULL;
//        }
    }

    $status_err['wr pass'] = false;
    $status_err['user !exist'] = false;
    $status_err['user exist']=false;
    $status_err['wr conf']=false;
    $options = [
        'cost' => 13,
    ];

//    if (($_POST['action']!=NULL)) {
//
//        if ($_POST['action'] == 'Регистрация') {
//            //форма регистрации
//            $status_err['no'] = check_p(0);
//            //var_dump($status_err);
//            if ($status_err['no']['check']) {
//                $reg_polis = $_POST['polis_reg'];
//                $passconf1 = $_POST['pass-'];
//                $passconf2 = $_POST['pass+'];
//                $email = $_POST['soap'];
//                $name = $_POST['name'];
//                $surname = $_POST['surname'];
//
//                $sql = "SELECT * FROM user_db where name=:name";
//                $a = sql_q($sql, $dbh, 'name', $reg_polis);
//
//                //проверка правильности подвержения пароля
//                if (($passconf1 == $passconf2) && ($a == 0)) {
//                    $passconf1=password_hash($passconf1,PASSWORD_BCRYPT, $options);
//                    $status_err['conf wr'] = false;
//                    $sql = 'Insert into user_db(name,pass,email) values(:name,:pass,:email);';
//                    $a = sql_c($sql, $dbh, $reg_name, $passconf1, $email);
//
//                    if ($a) {
//                        $_SESSION['name'] = $reg_name;
//                        $sql = "SELECT * FROM user_db where name=:name";
//                        $idf = sql_q($sql, $dbh, 'id', $reg_name);//получение id пользователя
//                        //                    //var_dump($idf);
//                        $_SESSION['id'] = $idf;
//                        //                    die(//var_dump($_SESSION['id']));
//                        $_SESSION['ed'] = 0;
//                        header('Location:index.php');//переход на страницу профиля
//
//                        die();
//                    } else {
//                        echo 'обнаружен баг, напишите разработчику, e-mail:denis.mazohin@ya.ru';
//                        die();
//                    }
//                } else {
//                    if ($passconf1 != $passconf2)
//                        $status_err['wr conf'] = true;
//                    if ($a != 0)
//                        $status_err['user exist'] = true;
//                }
//            }
//        }
//        else {//sign
            //die('!');


            //форма входа
            $polis = $_POST['polis'];
            $pass = $_POST['pass'];
            $status_err['no'] = check_p(1);
            //var_dump($status_err);
            if ($status_err['no']['check']) {

                $sql = "SELECT * FROM patient where polis=:polis";
                $a=sql_q($sql,$dbh,'polis',$polis);
                //var_dump($a);

                if ($a != 0) {
                    $res = sql_q($sql, $dbh, 'info', $polis);
                    if ($res == NULL) {
                        echo 'обнаружен баг, напишите разработчику, e-mail:denis.mazohin@ya.ru';
                        die();
                    }
                    if (password_verify($pass,$res[0]['pass'])) {
                        $_SESSION['id'] = $res[0]['id'];// выдается id
                        $_SESSION['name'] = $res[0]['name'];//сессии передаётся имя пользователя для вывода его на экране

//                        $_SESSION['ed'] = $res[0]['red'];
                        // //var_dump($_SESSION['ed']);
                        header('Location:index.php');
                        die();
                    } else
                        $status_err['wr pass'] = true;
                } else {
                    $status_err['user !exist'] = true;
                }
//            }
//        }
    }
//		header('Location:reference.php');
//    include 'toolbar.php';
//    //var_dump($status_err);
//    require_once  ("area_gen.php");
//    $inp_login=new area_gen(1);
//    $inp_pass=new area_gen(1);
//    $inp_soap=new area_gen(1);
//    $inp_sub=new area_gen();
//
//    $inp_pass->set_p('type','password');
//    $inp_soap->set_p('type','email');
//    $inp_sub->set_p('type','submit');
//    ////var_dump($status_err['no']);
//    echo '<div id="au"';
//        echo '<ul>';
//            echo '<li>';
//                echo '<form method="post">';
//                    if (($_POST['action'] == 'Вход')&&!($status_err['no']['check'])) echo '<p class="wr">Заполните все поля</p>';
//                    echo '<h2>Вход</h2>';
//
//                    if ($status_err['no']['name']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    elseif($status_err['user !exist']==true) echo '<p class="wr"><b>Данного пользователя не существует</b></p>';
//                    echo '<p> Имя пользователя(от 5 до 20 символов, только буквы латинского алфавита)</p>';
//                    $inp_login->make_input_echo('polis','Введите логин','[a-zA-Z0-9]{5,20}');
//
//
//                    if ($status_err['no']['pass']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    elseif($status_err['wr pass']==true) echo '<p class="wr">Неверный пароль</p>';
//                    echo '<p>Пароль</p>';
//                    $inp_pass->make_input_echo('pass','Введите пароль','{8,20}');
//                    echo '<br><br>';
//
//                    $inp_sub->make_input_echo('action',NULL,NULL,'Вход');
//
//                echo '</form>';
//            echo '</li>';
//            echo '<li>';
//                echo '<form  method="post">';
//
//                    if (($_POST['action'] == 'Регистрация')&&!($status_err['no']['check'])) echo '<p class="wr">Заполните все поля</p>';
//                    elseif($status_err['user exist']==true) echo '<p class="wr"><b>Пользователь с данным именем уже существует</p>';
//                    echo '<h2>Регистрация</h2>';
//
//                    if ($status_err['no']['name_reg']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    echo '<p> Имя пользователя(от 5 до 20 символов, только буквы латинского алфавита)</p>';
//                    $inp_login->make_input_echo('polis_reg','Придумайте логин','[a-zA-Z0-9]{5,20}');
//
//                    if ($status_err['no']['soap']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    echo '<p>Введите адресс e-mail</p>';
//                    $inp_soap->make_input_echo('soap','Введите e-mail');
//
//
//                    if ($status_err['no']['pass-']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    elseif($status_err['wr conf']==true) echo '<p class="wr"><b>Пароли не совпадают</b></p>';
//                    echo '<p>Пароль</p>';
//                    $inp_pass->make_input_echo('pass-','Придумайте пароль','{8,20}');
//
//                    if ($status_err['no']['pass+']==true)  echo '<p class="wr"><b>заполните это поле</b></p>';
//                    echo '<p>Подтвердите пароль</p>';
//                    $inp_pass->make_input_echo('pass+','Подтвердите пароль','{8,20}');
//                    echo   '<br><br>';
//
//                    $inp_sub->make_input_echo('action',NULL,NULL,'Регистрация');
//
//                echo '</form>';
//           echo '</li>';
//        echo '</ul>';
//    echo '</div>';
//echo '</body>';


        //TODO: вывод пароли не совпадают и пользователь существует одновременно done!
        //вывод пароли не совпадают done
        //исправление class wr на class --done
        //добавить class cor
        //TODO: pattern password