<?php

//модуль отдает файл книги скрипту

require_once $_SERVER['DOCUMENT_ROOT'] . '/required files/required_files.php';//подключить файл включений
$connector = new DbConnector($host, $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    if($id < 0){

    }
}

header("Content-Transfer-Encoding: binary");
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=book.zip");
readfile('jq.zip');