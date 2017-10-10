<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$template = 'default';
require_once $root."/required/required.php";
require_once $root."/classes/php/FileLoader.php";

if ($_POST['book_title']) $book_title = $_POST['book_title'];
if ($_POST['autor']) $author = $_POST['autor'];
if ($_POST['year']) $year = $_POST['year'];
if ($_POST['description']) $description = $_POST['description'];
if ($_POST['categories']) $categories = $_POST['categories'];
if ($_FILES['book_file']) $book_loader = new FileLoader('book_file');
//if ($_FILES['cover']) $cover = file_get_contents($_FILES['cover']['tmp_name']);
if ($_FILES['cover']) {
    $cover_file = new FileLoader('cover');
    $tmp_name = $cover_file->getTmpName();
    $cover = $cover_file->getContent($tmp_name);
}
$form_connector = new DbConnector($host, $login, $password, $db_name);

$form_connector_result = $form_connector->select("SELECT name, category_id FROM menu", false);
$add_content_form = new AddContentForm($root."/admin/templates/$template/add_content_form.html");

    if($book_title && $author && $year && $description && $cover && $book_loader && $categories) {

        $book_file_dir = $_SERVER['DOCUMENT_ROOT'].'/book_files/';
        $book_name = $form_connector->db->real_escape_string($book_loader->getFileName());
        $uploaded_filename = $book_file_dir.$book_loader->getFileName();
//        copy($book['tmp_name'], $uploaded_filename);
        $book_loader->copy($uploaded_filename);

        $cover = $form_connector->db->real_escape_string($cover);
        $form_connector->insert("INSERT INTO `books` (`title`, `author`, `year`, `text`, `image`, `category_id`, `book_file`) VALUES (\"$book_title\", \"$author\",\"$year\", \"$description\", \"$cover\", \"$categories\", \"$book_name\")");
        echo "Данные добавлены в базу данных";
    }
    else {
        echo "Вы заполнили не все поля";
    }

