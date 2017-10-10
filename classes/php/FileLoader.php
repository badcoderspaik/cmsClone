<?php

class FileLoader
{
    private $file;
    private $file_name;
    private $type;
    private $size;
    private $tmp_name;
    private $error;

    function __construct($file = '')
    {
        $this->file = $file;
        $this->file_name = $_FILES[$this->file]['name'];
        $this->type = $_FILES[$this->file]['type'];
        $this->size = $_FILES[$this->file]['size'];
        $this->tmp_name = $_FILES[$this->file]['tmp_name'];
        $this->error = $_FILES[$this->file]['error'];
    }

    public function copy($path){
        copy($this->tmp_name, $path);
    }

    public function getFileName(){
        return $this->file_name;
    }

    public  function getType(){
        return $this->type;
    }

    public function getSize(){
        return $this->size;
    }

    public function getTmpName(){
        return $this->tmp_name;
    }

    public function getContent($content = 'default'){
        return file_get_contents($content);
    }
}