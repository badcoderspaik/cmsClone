<?php
/**
 * Date: 27.04.2018
 * модуль меню в админ панели
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/required files/required_files.php';//подключить файл включений (внимание!!! - это очень важный файл, и он должен быть подключен глобально)
$menu_connector = new DbConnector($host, $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

//выбрать из таблицы admin_menu все записи и записать
//в переменную; в переменной хранится результирующий набор mysqli_result
$menu_result = $menu_connector->select("SELECT * from admin_menu", false);
//объект полной статьи
$menu_block = new Menu("templates/$template/right_menu.html");
//распарсить шаблон меню и записать в переменную
$menu = $menu_block->readTemplate($menu_result);