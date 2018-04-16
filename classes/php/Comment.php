<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 14.04.2018
 * Time: 0:08
 */

class Comment extends Article
{
    function __construct($template)
    {
        parent::__construct($template);
    }

    public function readTemplate($mysqli_object = '', $comment_id)
    {
        /**Переменная, которая будет возвращена методом.
         *
         * Будет содержать html-разметку с извлеченными из базы данных значениями, которые будут вставлены на место
         * меток-заполнителей
         * @var string
         */
        $comment = "";

        /**
         * Объект - полученный из базы - результирующий набор
         */
        $db_object = $mysqli_object->fetch_object();
        $dbConnector = new DbConnector("localhost", 'clien_spaik', 'spaik87055091802', 'codersdream');
        $count = $dbConnector->count("comments", "comment_id", $comment_id);
        $full_comment = file_get_contents("templates/default/comment_form.html");
        $full_comment = str_replace("[article_id]", $comment_id, $full_comment);
        /**
         * Массив меток-заполнителей в html-шаблоне, которые будут заменены на результаты, полученные из базы данных
         * @var array
         */
        $needle = array("[text]", "[author]", "[comment_date]");
        if($db_object != ''){
            $mysqli_object->data_seek(0);
            /**
             * Запускать цикл, пока присутсвует очередная строка результата
             */
            while ($db_object = $mysqli_object->fetch_object()){
                /**
                 * Присвоить переменной ссылку на файл шаблона, т.к. непосредственное обращение к $this->template в цикле
                 * в каждом проходе цикла осуществляет новое чтение файла шаблона, что сказывается на быстродействии
                 * @var string
                 */
                $cont = $this->template;
                /**
                 * Обновляющийся при каждом проходе цикла массив значений из базы данных, значения которого будут заменять
                 * метки-заполнители (массив $needle) полученного файла html-шаблона
                 * @var array
                 */
                $replace = array($db_object->text, $db_object->author, $db_object->date);
                /**
                 * Заменить массив меток-заполнителей на массив значений базы данных в файле шаблона
                 * @var string
                 */
                $cont = str_replace($needle, $replace, $cont);
                /**
                 * Результаты распарсенного с замененными значениями шаблона на каждом проходе цикла конкатенируются в этой переменной
                 * @var string
                 */
                $comment .= "$cont";
            }
            $full_comment .= "<h3 class='brown comment-header'>Комментарии ( $count )</h3>";
            $full_comment .= "$comment";
        } else {
            /*
             * если $db_object пуст
             */
            $full_comment .= "<h3 class='brown comment-header'>Комментарии ( $count )</h3>";
        }
        return $full_comment;
    }

}
