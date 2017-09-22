<?php
//модуль меню
require_once("classes/php/Menu.php");//подключить класс меню
require_once("classes/php/DbConnector.php");//подключить класс работы с базой данных
$menu_connector = new DbConnector("localhost", "u996357382_learn", "spaik87055091802", "u996357382_learn");
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

//выбрать из таблицы books все записи и записать
//в переменную; в переменной хранится результирующий набор mysqli_result
$menu_result = $menu_connector->select("SELECT * from menu", false);
//объект полной статьи
$menu_block = new Menu("templates/default/menu.html");
//распарсить шаблон меню и записать в переменную
$menu = $menu_block->readTemplate($menu_result);