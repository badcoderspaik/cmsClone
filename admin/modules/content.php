<?php

function content(){
    global $template;
    $content = file_get_contents("templates/$template/menu.html");
    return $content;
}