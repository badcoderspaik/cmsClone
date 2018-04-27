<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 15.04.2018
 * Time: 21:06
 */

//модуль добавления комментария; этот модуль не подключается к страницам сайта, а реагирует на ajax запросы

$root = $_SERVER['DOCUMENT_ROOT'];
$template = 'default';
require_once $root . "/required files/required_files.php";
//require_once $js . "/classes/php/FileLoader.php";

if ($_POST['author']) $author = $_POST['author'];
if ($_POST['comment']) $comment = $_POST['comment'];
if ($_POST['full_article']) $comment_id = $_POST['full_article'];
if ($_POST['btn_add']) $btn_add_comment = $_POST['btn_add'];

$connector = new DbConnector($host, $login, $password, $db_name);

if (isset($btn_add_comment)) {
    if ($author && $comment && $comment_id) {
        $author = $connector->cleanData($author);
        $comment = $connector->cleanData($comment);
        $date_day = date("d");//Определяем день
        $date_month = date("m");//Определяем месяц
        $date_year = date("Y");//Определяем год
        $date_time = date("H:i");//Определяем часы и минуты
        $date_comment = $date_day . "/" . $date_month . "/" . $date_year . " " . $date_time;//Склеим все переменные в одну
        $connector->insert("INSERT INTO `comments` (`author`, `text`, `date`, `comment_id`) VALUES (\"$author\", \"$comment\", \"$date_comment\", \"$comment_id\")");
        //header("Location: " . $_SERVER["HTTP_REFERER"]);
        echo "Комментарий добавлен";
    } else {
        echo "Не все поля заполнены";
    }
}
