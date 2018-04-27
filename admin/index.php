<?php

session_start();

if ($_GET['do'] == 'logout') {
    unset($_SESSION['admin_login']);
    session_destroy();
}

if (!$_SESSION['admin_login']) {
    header('Location: modules/admin_login_form.php');
    exit;
}

$title = "Панель администратора";
$template = "default";

if ($_GET['page']) $page = $_GET['page'];
else $page = 'index';

if ($page == 'index') {
    require_once('modules/content.php');
    $content = content();
    require_once "modules/right_menu.php";
}

if ($page == 'add_content') {
    require_once('../admin/modules/add_content_form.php');
    $content = $add_content_form->readTemplate($form_connector_result);
}

require_once "templates/$template/index.html";