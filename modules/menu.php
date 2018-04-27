<?php
//модуль меню
$menu_connector = new DbConnector($host, $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

//выбрать из таблицы books все записи и записать
//в переменную; в переменной хранится результирующий набор mysqli_result
$menu_result = $menu_connector->select("SELECT * from menu", false);
//объект полной статьи
$menu_block = new Menu("templates/$template/menu.html");
//распарсить шаблон меню и записать в переменную
$menu = $menu_block->readTemplate($menu_result);