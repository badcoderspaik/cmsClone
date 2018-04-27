<?php

$root = $_SERVER['DOCUMENT_ROOT'];//корень сайта
$template = 'default';//шаблон сайта
require_once $root . "/required files/required_files.php";
require_once $root."/classes/php/FileLoader.php";

if ($_POST['book_title']) $book_title = $_POST['book_title'];//name="book_title" из add_content_form.html
if ($_POST['autor']) $author = $_POST['autor'];//name="autor" из add_content_form.html
if ($_POST['year']) $year = $_POST['year'];//name="year" из add_content_form.html
if ($_POST['description']) $description = $_POST['description'];//name="description" из add_content_form.html
if ($_POST['categories']) $categories = $_POST['categories'];//name="categories" из add_content_form.html
if ($_POST['btn_add']) $btn_add = $_POST['btn_add'];//name="btn_add" из add_content_form.html

//массив $_FILES содержит информацию о загружаемом файле
//если в массиве $_FILES содержится элемент 'book_title' (то-есть файл загружен на сервер) - создать объект
//класса FileLoader
if ($_FILES['book_file']) $book_loader = new FileLoader('book_file');

//if ($_FILES['cover']) $cover = file_get_contents($_FILES['cover']['tmp_name']);
//если в массиве $_FILEs содержится элемент 'cover' (то-есть файл загружен на сервер) - создать объект
//класса FileLoader
if ($_FILES['cover']) {
    $cover_file = new FileLoader('cover');//объект FileLoader
    $tmp_name = $cover_file->getTmpName();//временное имя загруженного на сервер файла
    $cover = $cover_file->getContent($tmp_name);//непосредственно загруженный файл (файл изображения к статье)
}

$form_connector = new DbConnector($host, $login, $password, $db_name);//объект работы с базой данных
//выбрать все записи из таблицы меню
$form_connector_result = $form_connector->select("SELECT name, category_id FROM menu", false);
//объект формы добавления комментария
$add_content_form = new AddContentForm($root."/admin/templates/$template/add_content_form.html");

if(isset($btn_add)){//если нажата кнопка отправки контента
    /**
     * Если проинициализированы все переменные и $book_loader->getSize() > 0 ( размер загруженного файла
     * больше нуля - то-есть файл был загружен на сервер )
     */
    if($book_title && $author && $year && $description && $cover && $book_loader->getSize() > 0 && $categories) {
        //получить путь к директории на сервере, куда будут после обработки загружаться файлы книг
        $book_file_dir = $_SERVER['DOCUMENT_ROOT'].'/book_files/';
        //получить имя загружаемого файла книги
        $book_name = $form_connector->db->real_escape_string($book_loader->getFileName());
        //получить полное окончательное имя загружаемого файла ( полное имя содержит полный путь от корня
        //сайта вместе с именем файла, включая расширение файла
        $uploaded_filename = $book_file_dir.$book_loader->getFileName();
        //скопировать загружаемый файл книги из временного каталога в указанный
        $book_loader->copy($uploaded_filename);

        //название книги, которое будет записано в базу данных
        $book_title = $form_connector->db->real_escape_string($book_title);
        //год издания, который будет записан в базу данных
        $year = $form_connector->db->real_escape_string($year);
        //имя автора, которое будет записано в базу данных
        $author = $form_connector->db->real_escape_string($author);
        //файл изображения, которое как двоичный объект будет загружено в базу данных
        $cover = $form_connector->db->real_escape_string($cover);
        $description = $form_connector->db->real_escape_string($description);

        $form_connector->insert("INSERT INTO `books` (`title`, `author`, `year`, `text`, `image`, `category_id`, `book_file`) VALUES (\"$book_title\", \"$author\",\"$year\", \"$description\", \"$cover\", \"$categories\", \"$book_name\")");
        echo "Данные добавлены в базу данных";
    }
    else {
        echo "Не все поля заполнены";
    }
}


