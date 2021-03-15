<?php
include_once "header.php";
session_start();
if ($_SESSION['seen'] != 1)
    $_SESSION['seen'] = 0;

//if ($_COOKIE['id'] == 1 || $_COOKIE['id'] == 14)
if(0 == 1)
{
    var_dump($_COOKIE);
    var_dump($_SESSION);
}

?>

<?php
$_SESSION['seen'] = 1;
//    var_dump($_SESSION);
//    echo "опять все не работает";
?>
<section>
    <div class="wrapper">
        <div class="content">
            <h1>Записаться на прием к врачу</h1>
            <div class="">
                <form class ="appointment" action="">
                    <label for="">Номер полиса ОМС</label>
                    <div class="oms">
                        <input type="tel" placeholder="Например, 2362 7543 2365 5486">
                        <form >
                            <button class="submit" formaction="hospital_s.php">
                                <span>Продолжить</span>
                            </button>
                        </form>
                    </div>
                </form>
                <div class="about_oms">
                    <a href="zaglushka.php">Как записаться?</a>
                    <a href="https://alfastrahoms.ru/about-oms/detail/">Что такое полис ОМС?</a>
                </div>
            </div>
            <div id="meta"></div>
        </div>
    </div>
</section>
<?php
include_once "footer.php";
?>
</body>
</html>
