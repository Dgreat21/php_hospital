<?php
include_once "header.php";
?>
<section>
    <div class="wrapper">
        <div class="content">
            <h1>Регистрация нового пользователя</h1>
            <form class="registration" action="handler.php" method="post">
                <div class="block">
                    <label for="">Имя</label>
                    <input required type="" name="name" placeholder="Введите ваше имя" ><br>
                </div>
                <div class="block">
                    <label for="">Фамилия</label>
                    <input required type="" name="surname"placeholder="Введите вашу фамилию"><br>
                </div>
                <div class="block">
                    <label for="">Пароль</label>
                    <input required type="password" name="pass+" placeholder="Введите пароль"><br>
                </div>
                <div class="block">
                    <label for="">Подтвердите пароль</label>
                    <input required type="password" name="pass-" placeholder="Подтвердите пароль"><br>
                </div>
                <div class="block">
                    <label for="">Номер полиса ОМС</label>
                    <input required type="tel" name="polis_reg" placeholder="Например, 5634 2646 6437 3462" minlength="16"
                           maxlength="16"><br></div>
                <div class="block">
                    <label for="">Email</label>
                    <input required type="email" name="email" placeholder="Введите вашу почту"><br></div>
                <div class="block">
                    <label class="type" for="">Тип профиля</label>
                    <input  type="tel" placeholder="Клиент = 1, Врач = 2" minlength="1"
                            maxlength="1"><br></div>
                <input  type="hidden" name="Sign" value="Sign up">
                <button class="submit">
                    <span>Зарегистрироваться</span>
                </button>
            </form>
        </div>
    </div>
</section>


<?php
include_once "footer.html";
?>
