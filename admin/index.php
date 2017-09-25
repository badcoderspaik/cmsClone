<?php

$title = "Панель администратора";
$template = "default";

if($_GET['page']) $page = $_GET['page'];
else $page = 'index';

if($page == 'index'){
    require_once ('modules/menu.php');
    $content = menu();
}

if($page == 'add_content'){
    require_once ('modules/add_content_form.php');
    $content = addContentForm();
}

require_once "templates/$template/index.html";