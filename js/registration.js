function onclick_back_hndl(e)
{
    background = document.getElementsByClassName('login-background')[0];

    if (e.target !== background)
        return (0);

    background.removeEventListener('click', onclick_back_hndl);
    background.remove();
}

function add_market_meta(){
    let meta_block = document.getElementById('meta'), select, form, h1, input_l, input_p, subm;
    let field1, field2, p_h, a_h;
    // fragment = document.createDocumentFragment();

    // var body_block = document.getElementsByName('body');

    let background = document.createElement("div");
    background.setAttribute("class", "login-background");
    /*форма*/
    form = document.createElement("form");
    form.setAttribute('id', 'login');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'handler.php');
    form.setAttribute('name', 'Вход');
    /*Заголовок*/
    h1 = document.createElement("h1");
    h1.textContent = "Авторизация";
    /*Поле fieldset1*/
    field1 = document.createElement("fieldset");
    field1.setAttribute('id', 'inputs');
    /*Поле логина*/
    input_l = document.createElement("input");
    input_l.setAttribute('id', 'username');
    input_l.setAttribute('type', 'text');
    input_l.setAttribute('name', 'polis');
    input_l.setAttribute('placeholder', 'Полис ОМС');
    /*Поле пароля*/
    input_p = document.createElement("input");
    input_p.setAttribute('id', 'password');
    input_p.setAttribute('type', 'password');
    input_p.setAttribute('name', 'password');
    input_p.setAttribute('placeholder', 'Пароль');
    //поле типа пользователя
    // select.innerHTML(  "<select name='type'>" +
    //                 "<option selected>Пациент</option>" +
    //                 "<option>Врач</option>" +
    //             "</select>"
    // );

    /*Поле fieldset2*/
    field2 = document.createElement("fieldset");
    field2.setAttribute('id', 'actions');
    /*Кнопка вход*/
    subm = document.createElement("input");
    subm.id = "submit";
    subm.type = "submit";
    subm.value= "Войти";
    /*нет аккича*/
    p_h = document.createElement("p");
    p_h.setAttribute('id', 'haveno_account');
    p_h.textContent = "У вас нет аккаунта?";
    a_h = document.createElement("a");
    a_h.textContent = "Зарегистрироваться";
    a_h.setAttribute('href', 're');
    a_h.setAttribute('onclick', 'registration()');

    /*
    div ->
        form ->
            h1;
            fieldset1 ->
                input(user);
                input(pass);
            fieldset2 ->
                input(sub);
                p ->
                    a;
     */
    field1.appendChild(input_l);
    field1.appendChild(input_p);
    // field1.appendChild(select);
    field2.appendChild(subm);
    p_h.appendChild(a_h);
    field2.appendChild(p_h);
    form.appendChild(h1);
    form.appendChild(field1);
    form.appendChild(field2);
    // fragment.appendChild(div_n);
    background.appendChild(form);
    document.getElementsByClassName("meta-div")[0].appendChild(background);
    // while(meta_block.firstChild){
    //     meta_block.removeChild(meta_block.firstChild);
    // }
    // meta_block.appendChild(fragment);

   background.addEventListener("click", onclick_back_hndl, true);
};
