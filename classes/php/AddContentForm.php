<?php

/**
 * Class AddContentForm
 * Класс вывода html-формы добавления контента в базу данных в админ-панели сайта
 */
class AddContentForm extends Article
{
    /**
     * AddContentForm constructor.
     * @param string $template Путь к файлу шаблона
     */
    function __construct($template)
    {
        /**
         * Вызов конструктора суперкласса
         */
        parent::__construct($template);
    }

    /**
     * Читает и возвращает преобразованный файл шаблона статьи.
     * Функции передается предварительно полученный из базы данных результирущий набор mysqli_result
     * @param string $mysqli_object
     * @return mixed|string
     */
    public function readTemplate($mysqli_object = '')
    {
        /**Переменная, которая будет возвращена методом.
         *
         * Будет содержать html-разметку с извлеченными из базы данных значениями, которые будут вставлены на место
         * меток-заполнителей
         * @var string
         */
        $content = '';
        /**
         * Массив меток-заполнителей в html-шаблоне, которые будут заменены на результаты, полученные из базы данных
         * @var array
         */
        $needle = array('[item]', '[category_id]');
        /**
         * Объект - полученный из базы результирующий набор
         */
        $db_object = $mysqli_object->fetch_object();

        preg_match("/\[while\](.*?)\[while\]/s", $this->template, $items);

        if($db_object != ""){
            $mysqli_object->data_seek(0);
            while ($db_object = $mysqli_object->fetch_object()){
                $temp_template = $items[1];
                $replace = array($db_object->name, $db_object->category_id);
                $temp_template = str_replace($needle, $replace, $temp_template);
                $content .= "$temp_template";
            }
            $content = preg_replace("/\[while\](.*?)\[while\]/s", $content, $this->template);;
        }
        else $content = '';
        return $content;
    }
}