<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 15.04.2018
 * Time: 21:06
 */

$root = $_SERVER['DOCUMENT_ROOT'];
$template = 'default';
require_once $root . "/required/required.php";
require_once $root . "/classes/php/FileLoader.php";

if ($_POST['author']) $author = $_POST['author'];
if ($_POST['comment']) $comment = $_POST['comment'];
if ($_POST['comment_id']) $comment_id = $_POST['comment_id'];

$connector = new DbConnector($host, $login, $password, $db_name);

if ($author && $comment && $comment_id) {
    $author = $connector->cleanData($author);
    $comment = $connector->cleanData($comment);
    $date_day = date("d");//Определяем день
    $date_month = date("m");//Определяем месяц
    $date_year = date("Y");//Определяем год
    $date_time = date("H:i");//Определяем часы и минуты
    $date_comment = $date_day."/".$date_month."/".$date_year." ".$date_time;//Склеим все переменные в одну
    $connector->insert("INSERT INTO `comments` (`author`, `text`, `date`, `comment_id`) VALUES (\"$author\", \"$comment\", \"$date_comment\", \"$comment_id\")");
    echo "Комментарий добавлен";
} else {
    echo "Не все поля заполнены";
}