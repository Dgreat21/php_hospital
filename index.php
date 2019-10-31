<?php
include_once "header.php";
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
                        <button class="submit">
                            <span>Продолжить</span>
                        </button>
                    </div>
                </form>
                <div class="about_oms">
                    <a href="#">Как записаться?</a>
                    <a href="#">Что такое полис ОМС?</a>
                </div>
            </div>
            <div id="meta"></div>
        </div>
    </div>
</section>
<?php
include_once "footer.html";
?>
</body>
</html>