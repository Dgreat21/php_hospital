<?php
include_once "header.php";
?>
<section>
	 <div class="wrapper">
        <div class="content">
            <h1>Регистрация нового пользователя</h1>
            <form class="registration" action="handler.php">
                <div class="block">
                    <label for="">Имя</label>
            	    <input type="" placeholder="Введите ваше имя" required><br>

            	    <label for="">Фамилия</label>
            	    <input required type="" placeholder="Введите вашу фамилию"><br>

            	    <label for="">Пароль</label>
            	    <input required type="password" placeholder="Введите пароль"><br>

            	    <label for="">Номер полиса ОМС</label>
            	    <input required type="tel" placeholder="Например, 5634 2646 6437 3462" minlength="16"
            	    maxlength="16"><br>

                    <label for="">Email</label>
                    <input required type="email" placeholder="Введите вашу почту"><br>

                    <label class="type" for="">Тип профиля</label>
                    <input  type="tel" placeholder="Клиент = 1, Врач = 2" minlength="1" maxlength="1"><br>
                    <input  type="hidden" name="Sign" value="Sign up">
                </div>
                   <button class="submit" type="submit">
                            <span>Зарегистрироваться</span>
                        </button>
            </form>
        </div>
    </div>
</section>


<?php
include_once "footer.html";
?>