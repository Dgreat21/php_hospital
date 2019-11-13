<?php
	/**
	 * Created by PhpStorm.
	 * User: denco
	 * Date: 06.12.2018
	 * Time: 18:48
	 */

	session_start();
	include_once 'my_sql.php';
	//    if ($_SESSION['name']!=NULL){
	//        header('Location:profile.php');
	//        die();
	//    }
	$status_err = [
		'wr conf' => false,//пароли не совпадают
		'user exist' => false,// пользователь с данным именем уже существует
		'user !exist' => false,//пользователь с данным именем не существует
		'wr pass' => false,//неправильный пароль
		'check' => false,
		'no'=>[
			'name'=>false,
			'surname' => false,
			'pass'=>false,
			'polis_reg'=>false,
			'pass+'=>false,
			'pass-'=>false,
			'email'=>false,
		],
	];
var_dump($_POST);
$reg_polis = $_POST['polis_reg'];
$passconf1 = $_POST['password'];
$passconf2 = $_POST['password_confirm'];
$email = $_POST['soap'];
$name = $_POST['name'];
$surname = $_POST['surname'];


function check_p($reg_auth) {
	//var_dump($reg_auth);
	if (!$reg_auth) {//0--sign up
		if ($_POST['polis_reg'] == '')
			$status_err['no']['polis_reg'] = true; else    $status_err['no']['polis_reg'] = false;//
		if ($_POST['soap'] == '')
			$status_err['no']['email'] = true; else    $status_err['no']['email'] = false;//
		if ($_POST['password'] == '')
			$status_err['no']['pass-'] = true; else    $status_err['no']['pass-'] = false;//
		if ($_POST['password_confirm'] == '')
			$status_err['no']['pass+'] = true; else    $status_err['no']['pass+'] = false;
		if ($_POST['password_confirm'] == '')
			$status_err['no']['name'] = true; else    $status_err['no']['name'] = false;
		if ($_POST['password_confirm'] == '')
			$status_err['no']['surname'] = true; else    $status_err['no']['surname'] = false;//
		$status_err['check'] = ($status_err['no']['polis_reg'] && $status_err['no']['email'] && $status_err['no']['pass-'] && $status_err['no']['pass+'] && $status_err['no']['name'] && $status_err['no']['surname']);

		return $status_err;
	} else if ($reg_auth) {
		if ($_POST['polis'] == '')
			$status_err['no']['name'] = true; else $status_err['no']['name'] = false;
		if ($_POST['pass'] == '')
			$status_err['pass'] = true; else $status_err['no']['pass'] = false;
		var_dump($_POST);
		$status_err['no']['name'] = ($_POST['polis'] == '') ? (false) : (true);
		$status_err['no']['pass'] = ($_POST['password'] == '') ? (false) : (true);
		$status_err['check'] = ($status_err['no']['name'] && $status_err['no']['pass']);

		return $status_err;
		//        }
		//        else{
		//            return NULL;
		//        }
	}
}
	$status_err['wr pass'] = false;
	$status_err['user !exist'] = false;
	$status_err['user exist']=false;
	$status_err['wr conf']=false;
	$options = [
		'cost' => 13,
	];

	if (($_POST['Sign'] != NULL)) {

		if ($_POST['action'] == 'Sign up') {
			//форма регистрации
			$status_err['no'] = check_p(0);
			//var_dump($status_err);
			if ($status_err['no']['check']) {
				$reg_polis = $_POST['polis_reg'];
				$passconf1 = $_POST['password'];
				$passconf2 = $_POST['password_confirm'];
				$email = $_POST['soap'];
				$name = $_POST['name'];
				$surname = $_POST['surname'];


				$sql = "SELECT * FROM patient where polis=:polis";
				$a = sql_quarry($sql, $dbh,'polis',$reg_polis);

				//проверка правильности подвержения пароля
				if (($passconf1 == $passconf2) && ($a == 0)) {
					$passconf1 = password_hash($passconf1,PASSWORD_BCRYPT, $options);
					$status_err['conf wr'] = false;
					$data =[
						'name'      => $name,
						'surname'   => $surname,
						'polis'     => $reg_polis,
						'soap'		=> $email,
						'hash'      => $passconf1,
					];
					$sql = 'Insert into patient(name, surname, polis, email, pass) values(:name, :surname, :polis, :email, :pass);';
					$a = sql_c($sql, $dbh, $data);
					if ($a) {
						//                        $_SESSION['name'] = $name;
						setcookie('name', $name);
						setcookie('surname', $surname);
	//				$sql = "SELECT * FROM user_db where name=:name";
						//                        $idf = sql_q($sql, $dbh, 'id', $reg_polis);//получение id пользователя
						//                        //                    //var_dump($idf);
						//                        $_SESSION['id'] = $idf;
						//                    die(//var_dump($_SESSION['id']));
						//                        $_SESSION['ed'] = 0;
						setcookie('who', 'patient');
//						var_dump($_COOKIE);
						header('Location:index.php');//переход на страницу профиля TODO: profile page

						die();
					} else {
						echo 'обнаружен баг, напишите разработчику, e-mail:denis.mazohin@ya.ru';
						die();
					}
				} else {
					if ($passconf1 != $passconf2)
						$status_err['wr conf'] = true;
					if ($a != 0)
						$status_err['user exist'] = true;
				}
			}
		}
		else if($_POST['action'] == 'Sign in'){//sign
	//die('!');
	//форма входа
			$polis = $_POST['polis'];
			$pass = $_POST['password'];
			$status_err = check_p(1);
	//var_dump($status_err);
	//var_dump($status_err);
			echo "stat test";
			if ($status_err['check']) {
				echo "test 1";
				$sql = "SELECT * FROM patient where polis=:polis";
				$a = sql_quarry($sql,$dbh,'polis',$polis);

				if ($a != 0) {
					$res = sql_quarry($sql, $dbh, 'info', $polis);
					if ($res == NULL) {
						echo 'обнаружен баг, напишите разработчику, e-mail:denis.mazohin@ya.ru';
						die();
					}
					echo "test";
					var_dump($res[0]['pass']);
					var_dump($pass);

					if (password_verify($pass,$res[0]['pass'])) {
						$_SESSION['id'] = $res[0]['id'];// выдается id
						$_SESSION['name'] = $res[0]['name'];//сессии передаётся имя пользователя для вывода его на экране
						$_SESSION['surname'] = $res[0]['surname'];//сессии передаётся имя пользователя для вывода его на экране

	//                        $_SESSION['ed'] = $res[0]['red'];
						// //var_dump($_SESSION['ed']);
						header('Location:index.php');
						die();
					} else
						$status_err['wr pass'] = true;
				} else {
					$status_err['user !exist'] = true;
				}
			}
		}
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
	//todo: