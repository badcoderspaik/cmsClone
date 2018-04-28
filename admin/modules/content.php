<?php
//модуль вывода меню, отвечающего за навигацию по админке, в блоке контента

/**
 * читает и возвращает html разметку из указанного шаблона
 * @return bool|string возвращаемое значение - html-разметка
 */
function content(){
    global $template;//директория шаблона
    //прочитать html разметку шаблону и записать в переменную
    $content = file_get_contents("templates/$template/menu.html");
    //вернуть html разметку
    return $content;
}