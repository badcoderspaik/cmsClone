<?php
/**
 * главная страница админки
 */
session_start();//стартуем сессию

if ($_GET['do'] == 'logout') {//если скрипту в строке запроса передан get-параметр do=logout
    unset($_SESSION['admin_login']);//удалить из сесси переменную admin_login
    session_destroy();//уничтожить все связанные с данной сессией данные, завершить текущую сессию
}

if (!$_SESSION['admin_login']) {//если сессия не содержит переменную admin_login
    header('Location: modules/admin_login_form.php');//переаправить пользователя на страницу с формой входа в админку
    exit;
}

$title = "Панель администратора";//title страницы
$template = "default";//используемый шаблон страницы ( часть пути к файлам с шаблоном сайта )

//если скрипту передан get параметр 'page' - объявить переменную $page и инициализировать её
//значением переданного параметра
if ($_GET['page']) $page = $_GET['page'];
//если же параметр не передан - объявить переменную $page и инициализировать её значением 'index'
else $page = 'index';

if ($page == 'index') {
    require_once('modules/content.php');//подключить модуль вывода меню, отвечающего за навигацию по админке, в блоке контента
    $content = content();//инициализировать переменную html разметкой модуля меню из блока контента
    require_once "modules/right_menu.php";//подключить модуль меню навигации
}

if ($page == 'add_content') {//если передана get параметр 'page = add_content'
    require_once('../admin/modules/add_content_form.php');//подключить модуль формы добавления контента
    //прочитать и возвратить в переменную преобразованный файл шаблона формы добавления контента
    $content = $add_content_form->readTemplate($form_connector_result);
}

//подключ шаблон главной страницы админки
require_once "templates/$template/index.html";