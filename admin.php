<?php
include_once("header.php");
require_once ("my_sql.php");
?>
<!--<script>-->
<!--    let isAdmin = confirm("Это страница для администратора, вы попали на нее случайно?");-->
<!--    if (isAdmin) {-->
<!--        document.location.replace("http://www.site.ru");-->
<!--    }-->
<!--    else () {-->
<!---->
<!--    }-->
<!--</script>-->
<?php
    if (!$_COOKIE['master']){
        header("location:index.php");
        die();
    }

    $hospitals = [
            2, 49, 94, 133
    ];
    $docs = sql_get_all_docs($dbh);
//    var_dump($docs);
//    var_dump($docs);
    foreach ($docs as $key)
    {   $id = $key['id'];
        $name = $key['name'];
        $surname = $key['surname'];
        $profession = strtoupper($key['profession']);
        $hospital = $key['hospital_id'];
        echo "<div class='Sign_to_doc line'>
                        <form method='post' action='hand_admin.php'>
                            <input type='hidden' name='doctor' value='$id'>
                            <input type='hidden' name='action' value='rename'>
                            <input type='text' name='name' value='$name'>
                            <input type='text' name='surname' value='$surname'>
                            <input type='text' name='profession' value='$profession'>
                            <input type='submit'  class='__r right __s html_architect' value='Изменить'>
                        </form>
                        <form method='post' action='hand_admin.php'>
                        <h4>Номер учреждения</h4>
                            <input type='hidden' name='doctor' value='$id'>
                            <input type='hidden' name='action' value='transfer'>
                            <select name='host'>";
                                echo "<option selected>$hospital</option>";
                                foreach ($hospitals as $i)
                                {
                                    if ($i == $hospital)
                                        continue;
                                    else
                                        echo "<option>$i</option>";
                                }
                        echo "</select><input type='submit'  class='__r right __s html_architect' value='Перевести'>
                        </form>";
                        if ($key['active']) {
                            echo "<form method='post' action='hand_admin.php'>
                                <input type='hidden' name='doctor' value='$id'>
                                <input type='hidden' name='action' value='vacation'>
                                <input type='submit'  class='__r right __s html_architect' value='Больничный'>
                            </form>";}
                        else {
                            echo "<form method='post' action='hand_admin.php'>
                                <input type='hidden' name='doctor' value='$id'>
                                <input type='hidden' name='action' value='return'>
                                <input type='submit'  class='__r right __s html_architect' value='Выход с Больничного'>
                            </form>";
                        }
                        echo "<form method='post' action='hand_admin.php'>
                            <input type='hidden' name='doctor' value='$id'>
                            <input type='hidden' name='action' value='fired'>
                            <input type='submit'  class='__r right __s html_architect' value='Удалить'>
                        </form>
                        <form method='post' action='doc_auth.php'>
                            <input type='hidden' name='doctor' value='$id'>
                            <input type='hidden' name='action' value='Lookup'>
                            <input type='submit'  class='__r right __s html_architect' value='Просмотреть записи'>
                        </form>
                    </div><br>";
    }
                    echo "<div class='Sign_to_doc line'>
                                            <h3>Добавление нового врача</h3>
                                            <form method='post' action='hand_admin.php'>
                                                <input type='hidden' name='action' value='new_doc'>
                                                <input type='text' name='name' placeholder='Введите имя'>
                                                <input type='text' name='surname' placeholder='Введите фамилию'>
                                                <input type='text' name='profession' placeholder='Введите специальность'>
                                                <h4>Номер учреждения</h4>
                                                <select name='host'>";
                                                foreach ($hospitals as $i)
                                                {
                                                    echo "<option>$i</option>";
                                                }
                                        echo "</select>";
                    echo "<form method='post' action='hand_admin.php'>
                                                <input type='submit'  class='__r right __s html_architect' value='Добавить'>
                                        </div><br>";
    include_once("footer.php");
//	if($_COOKIE['id'] != 'god')
//		header('location:https://www.google.com/search?q=%D0%BF%D0%BE%D1%87%D0%B5%D0%BC%D1%83+%D1%8F+%D0%B3%D0%B5%D0%B9+%D0%B8+%D0%B4%D0%BE%D0%BB%D0%B1%D0%B0%D0%B5%D0%B1+%D0%BB%D0%B5%D0%B7%D1%83+%D0%BA%D1%83%D0%B4%D0%B0+%D0%BD%D0%B5+%D0%BD%D0%B0%D0%B4%D0%BE%3F&oq=%D0%BF%D0%BE%D1%87%D0%B5%D0%BC%D1%83+%D1%8F+%D0%B3%D0%B5%D0%B9+%D0%B8+%D0%B4%D0%BE%D0%BB%D0%B1%D0%B0%D0%B5%D0%B1+%D0%BB%D0%B5%D0%B7%D1%83+%D0%BA%D1%83%D0%B4%D0%B0+%D0%BD%D0%B5+%D0%BD%D0%B0%D0%B4%D0%BE%3F&aqs=chrome..69i57.814j0j0&sourceid=chrome&ie=UTF-8');
