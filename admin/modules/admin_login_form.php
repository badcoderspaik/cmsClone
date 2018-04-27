<?php
session_start();
$url = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';

if($_SESSION['admin_login']){
    header("Location: $url" . "admin/");
    exit;
}

$template = 'default';
$title = 'Админ панель';
$admin_login = 'encrypticus';
$admin_password = "spaik87055091802";

require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/templates/$template/admin_login_form.html";

if ($_POST['btn_admin_login']) {
    if ($_POST['admin_login'] == $admin_login && $_POST['admin_password'] == $admin_password) {
        $_SESSION['admin_login'] = $admin_login;
        header("Location: $url/admin");
        exit;
    } else {
        echo "<script>alert('Проваливай, братка!')</script>";
    }
}
