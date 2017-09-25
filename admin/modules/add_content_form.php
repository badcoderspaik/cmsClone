<?php

if ($_POST['book_title']) $book_title = $_POST['book_title'];
if ($_POST['autor']) $autor = $_POST['autor'];
if ($_POST['year']) $year = $_POST['year'];
if ($_POST['description']) $description = $_POST['description'];
if ($_FILES['cover']) $cover = $_FILES['cover'];
if ($_FILES['book']) $book = $_FILES['book'];

if($_POST['btn_add_post']){
    if($book_title && $autor && $year && $description && $cover && $book) {
        echo "Все поля заполнены";
    }
    else echo "Вы заполнили не все поля";
}

function addContentForm(){
    global $template;
    $form = file_get_contents("templates/$template/add_content_form.html");
    return $form;
}