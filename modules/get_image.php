<?php
//модуль, который отдает изображение скрипту

require_once $_SERVER['DOCUMENT_ROOT'] . '/required files/required_files.php';//подключить файл включений
$connector = new DbConnector($host, $login, $password, $db_name);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к базе данных";
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($id > 0) {
        $result = $connector->select("SELECT image from books WHERE id = '$id'", false);
        $image = $result->fetch_object();
        header("Content-type: image/*");
        echo "$image->image";
    }

}

//while($image = $result->fetch_object()){
//    //header("Content-type: image/*");
//    echo"<img src = $image->image>";
//    //echo "$image->image";
//}
