function onclick_back_hndl(e)
{
    background = document.getElementsByClassName('login-background')[0];

    if (e.target !== background)
        return (0);

    background.removeEventListener('click', onclick_back_hndl);
    background.remove();
}

function add_market_meta(){

    let background = document.createElement("div");
    background.setAttribute("class", "login-background");
    background.innerHTML += "<form id='login' method='post' action='handler.php' name='Вход'>" +
        "<h1>Авторизация</h1>" +
        "<fieldset id='inputs'>" +
        "<input id='username' type='text' name='polis' placeholder='ПОЛИС ОМС'>" +
        "<input id='password' type='password' name='password' placeholder='Пароль'>" +
        "</fieldset>"+ "<fieldset id='actions'>" +
        "<input id='submit' type='submit' value='Войти'>" +
        "<p id='haveno_account'>У вас нет Аккаунта?<a href='#'>Зарегистрироваться</a></p>" +
        //Вот поле я добавил
        "<input type='hidden' name='form' value='Sing in'>" + "</fieldset>" +
        "</form>";

    document.getElementsByClassName("meta-div")[0].appendChild(background);


   background.addEventListener("click", onclick_back_hndl, true);
}
