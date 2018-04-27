<?php

/**
 * Class FileLoader Класс для работы с загружаемыми на сервер файлами
 */
class FileLoader
{
    private $file;
    private $file_name;//имя загружаемого на сервер файла до его отправки на сервер
    private $type;//MIME-тип загруженного файла
    private $size;//размер загруженного файла в байтах
    private $tmp_name;//имя файла во временном каталоге на сервере
    private $error;//код ошибки, которая может возникнуть при загрузке файла

    /**
     * FileLoader constructor.
     * @param string $file имя загружаемого на сервер файла; строка, значение которой берется из
     * атрибута name тега input (поле выбора файла) из файла add_content_form.html
     */
    function __construct($file = '')
    {
        $this->file = $file;
        $this->file_name = $_FILES[$this->file]['name'];//имя загружаемого на сервер файла до его отправки на сервер
        $this->type = $_FILES[$this->file]['type'];//MIME-тип загруженного файла
        $this->size = $_FILES[$this->file]['size'];//размер загруженного файла в байтах
        $this->tmp_name = $_FILES[$this->file]['tmp_name'];//имя файла во временном каталоге на сервере
        $this->error = $_FILES[$this->file]['error'];//код ошибки, которая может возникнуть при загрузке файла
    }

    /**
     * Кладет загружаемый файл по пути $path
     * @param $path директория ( полный путь - название директории + имя файла ), в которую будет окончательно
     * положен из временного каталога загружаемый файл
     */
    public function copy($path){
        copy($this->tmp_name, $path);
    }

    /**
     * Возвращает имя загружаемого на сервер файла
     * @return string имя файла до его отправки на сервер
     */
    public function getFileName(){
        return $this->file_name;
    }

    /**
     * Возвращает MIME-тип загружаемого на сервер файла
     * @return string MIME-тип загружаемого на сервер файла
     */
    public  function getType(){
        return $this->type;
    }

    /**
     * Возвращает размер загружаемого на сервер файла
     * @return string размер загружаемого на сервер файла
     */
    public function getSize(){
        return $this->size;
    }

    /**
     * Возвращает имя загруженного файла во временном каталоге на сервере
     * @return string имя загруженного файла во временном каталоге на сервере
     */
    public function getTmpName(){
        return $this->tmp_name;
    }

    /**
     * Читает содержимое файла
     * @param string $content путь к файлу, который следует прочитать
     * @return bool|string возвращает прочтенные данные, или false в случае возникновения ошибки при чтении файла
     */
    public function getContent($content = 'default'){
        return file_get_contents($content);
    }
}