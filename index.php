<?php

require_once 'required files/required_files.php';//подключить файл включений (внимание!!! - это очень важный файл, и он должен быть подключен глобально)

$title = "Библиотека программиста - книги по программированию в высоком качестве";
$template = "simple";

//Подключение модуля статьи
require_once("modules/article.php");
//Подключение модуля меню
require_once ("modules/menu.php");
//Подключение файла шаблона
require_once("templates/$template/index.html");