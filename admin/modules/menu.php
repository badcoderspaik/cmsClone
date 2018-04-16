<?php

function menu(){
    global $template;
    $menu = file_get_contents("templates/$template/menu.html");
    return $menu;
}