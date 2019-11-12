<?php
include_once "header.php";
?>
<section>
	 <div class="wrapper">
        <div class="content">
            <h1>Регистрация нового пользователя</h1>
            <form class="registration" action="">
            	<div class="block">
            	 <label for="">Имя</label>
            	  <input type="" placeholder="Введите ваше имя" required><br>
            	  </div>
            	  <div class="block">
            	 <label for="">Фамилия</label>
            	  <input required type="" placeholder="Введите вашу фамилию"><br>
            	  </div>
            	  <div class="block">
            	 <label for="">Пароль</label>
            	  <input required type="password" placeholder="Введите пароль"><br>
            	  </div>
            	  <div class="block">
            	  <label for="">Номер полиса ОМС</label>
            	  <input required type="tel" placeholder="Например, 5634 2646 6437 3462" minlength="16"
            	  maxlength="16"><br></div>
            	  <div class="block">
            	  <label for="">Email</label>
            	  <input required type="email" placeholder="Введите вашу почту"><br></div>
            	  <div class="block">
            	  <label class="type" for="">Тип профиля</label>
            	  <input  type="tel" placeholder="Клиент = 1, Врач = 2, Админ = 3" minlength="1"
            	  maxlength="1"><br></div>
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