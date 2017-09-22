<?php
require_once ("db_connect.php");
require_once("classes/php/Article.php");//подключение класса статьи
require_once("classes/php/Full_Article.php");//подключение класса полной статьи
require_once("classes/php/DbConnector.php");// подключение класса работы с базой данных
//создать объект класса работы с базой данных
$connector = new DbConnector("localhost:3306", $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

//если передан get-запрос с параметром "full_article" присвоить значение параметра переменной
//в параметре get-запроса передается номер статьи; параметр переадется при нажатии кнопки "Подробнее"
if ($_GET["full_article"]) $full_article = $_GET["full_article"];

//если не передан запрос с идентификаторам статьи - отобразить список всех статей
if (!$full_article) {
    //выбрать из таблицы books все записи, отсортированные в обратном порядке, и поместить в переменную
    $result = $connector->select("SELECT * from books ORDER BY id DESC", false);
    //объект статьи
    $article = new Article("templates/default/article.html");
    //распарсить шаблон статьи и записать в переменную
    $content = $article->readTemplate($result);
}

//если же передан - вывести статью с переданным идентификатором
if ($full_article) {
    //выбрать из таблицы books запись с идентификатором равным "$full_article" и записать
    //в переменную; в переменной хранится результирующий набор mysqli_result
    $result = $connector->select("SELECT * from books WHERE id = '$full_article'", false);
    //объект полной статьи
    $article = new Full_Article("templates/default/full_article.html");
    //распарсить шаблон статьи и записать в переменную
    $content = $article->readTemplate($result);
}

if($_GET["category"]) $category_id = $_GET["category"];
if($category_id){
    //выбрать из таблицы books все записи с, в которых поле "category_id" равно переменной $category_id и записать
    //в переменную; в переменной хранится результирующий набор mysqli_result
    $result = $connector->select("SELECT * from books WHERE category_id = '$category_id' ORDER BY id DESC", false);
    //объект статьи
    //распарсить шаблон статьи и записать в переменную
    $content = $article->readTemplate($result);
}

