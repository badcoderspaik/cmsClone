<?php

class AddContentForm extends Article
{
    function __construct($template)
    {
        parent::__construct($template);
    }

    public function readTemplate($mysqli_object = '')
    {
        $content = '';
        $needle = '[item]';
        $db_object = $mysqli_object->fetch_object();
        preg_match("/\[while\](.*?)\[while\]/s", $this->template, $items);

        if($db_object != ""){
            $mysqli_object->data_seek(0);
            while ($db_object = $mysqli_object->fetch_object()){
                $temp_template = $items[1];
                $replace = $db_object->name;
                $temp_template = str_replace($needle, $replace, $temp_template);
                $content .= "$temp_template";
            }
            $content = preg_replace("/\[while\](.*?)\[while\]/s", $content, $this->template);;
        }
        else $content = '';
        return $content;
    }
}