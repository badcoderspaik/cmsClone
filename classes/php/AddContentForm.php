<?php

class AddContentForm extends Article
{
    function __construct($template)
    {
        parent::__construct($template);
    }

    public function readTemplate($mysqli_object = '')
    {
        return $this->template;
    }
}