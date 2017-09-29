<?php

require_once "../required/required.php";

if ($_POST['book_title']) $book_title = $_POST['book_title'];
if ($_POST['autor']) $author = $_POST['autor'];
if ($_POST['year']) $year = $_POST['year'];
if ($_POST['description']) $description = $_POST['description'];
if ($_FILES['book']) $book = $_FILES['book'];
if ($_FILES['cover']) $cover = file_get_contents($_FILES['cover']['tmp_name']);

if($_POST['btn_add_post']){
    if($book_title && $author && $year && $description && $cover && $book) {
        $connector = new DbConnector($host, $login, $password, $db_name);
        $cover = $connector->db->real_escape_string($cover);
        $connector->insert("INSERT INTO `books` (`title`, `author`, `year`, `text`, `image`, `category_id`) VALUES (\"$book_title\", \"$author\",\"$year\", \"$description\", \"$cover\", '1')");
        echo "Данные добавлены в базу данных";
    }
    else echo "Вы заполнили не все поля";
}

$add_content_form = new AddContentForm("../admin/templates/$template/add_content_form.html");