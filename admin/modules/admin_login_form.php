<?php
/**
 * модуль формы входа в админ панель
 */

//стартуем сессию
session_start();

//url вида http://sitename.domain/ либо https://sitename.domain/ - в зависимости от того по какому протоколу пришел запрос
$url = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';

//если в сесси присутствует перемення admin_login, то сделать перенаправление пользователя
//на главную страницу админ панели, так как пользователь уже авторизован
if($_SESSION['admin_login']){
    header("Location: $url" . "admin/");
    exit;
}

$template = 'default';//шаблн страницы
$title = 'Админ панель';//заголовок страницы

require_once $_SERVER['DOCUMENT_ROOT'] . '/required files/required_files.php';//подключить файл включений (внимание!!! - это очень важный файл, и он должен быть подключен глобально)

//объект подключения к базе данных
$menu_connector = new DbConnector($host, $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

//прочитать логин админа из базы данных
$admin_login = $menu_connector->selectField('admin_login', 'login');
//прочитать пароль админа из базы данных
$admin_password = $menu_connector->selectField('admin_login', 'password');

//подключить шаблон формы входа в админ панель
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/templates/$template/admin_login_form.html";

if ($_POST['btn_admin_login']) {//если нажата кнопка отправки формы
    //если введенные в форму логин и пароль совпадают с логином и паролем из базы данных
    if ($_POST['admin_login'] == $admin_login && $_POST['admin_password'] == $admin_password) {
        //создать сессионную переменную
        $_SESSION['admin_login'] = $admin_login;
        //и перенаправить пользователя на главную страницу админки
        header("Location: $url/admin");
        exit;
    } else {//если введенны логин и пароль не совпадают
        echo "<script>alert('Проваливай, братка!')</script>";
    }
}
