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
                        <input class="ns" required type="" name="name" placeholder="Например, Иван" pattern="^[А-ЯЁ]{1}[а-яё]+$"><br>
                    </div>
                    <div class="block">
                        <label for="">Фамилия</label>
                        <input class="ns" required type="" name="surname" placeholder="Например, Иванов" pattern="^[А-ЯЁ]{1}[а-яё]+$"><br>
                    </div>
                    <div class="block">
                        <label for="">Пароль</label>
                        <input required type="password" name="pass+" placeholder="Верхний, нижний регистры, цифры" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$"><br>
                    </div>
                    <div class="block">
                        <label for="">Подтверждение пароля</label>
                        <input required type="password" name="pass-" placeholder="Подтвердите пароль" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$"><br>
                    </div>
                    <div class="block">
                        <label for="">Номер полиса ОМС</label>
                        <input required type="tel" name="polis" placeholder="Например, 5634264664373462" minlength="16"
                               maxlength="16" pattern="[0-9]{16}"><br></div>
                    <div class="block">
                        <label for="">Email</label>
                        <input required type="email" name="email" placeholder="Введите вашу почту"><br></div>
<!--                    <div class="block">-->
<!--                        <label class="type" for="">Тип профиля</label>-->
<!--                        <input  type="tel" placeholder="Клиент = 1, Врач = 2" minlength="1"-->
<!--                                maxlength="1"><br></div>-->
                    <input type="hidden" name="Sign" value="Sign up">
                    <button class="submit">
                        <span>Зарегистрироваться</span>
                    </button>
                </form>
            </div>
        </div>
    </section>


<?php
include_once "footer.php";



