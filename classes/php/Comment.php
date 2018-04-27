<?php
/**
 * Класс вывода комментариев к статье, расширящюий класс Article
 */

class Comment extends Article
{
    function __construct($template)
    {
        parent::__construct($template);
    }
    /**
     * Читает и возвращает преобразованный файл шаблона комментария.
     * Функции передается предварительно полученный программой результирующий набор mysqli_result, полученный из запроса в базу данных
     * и идентификатор статьи, который нужен для определения - к какой статье необходимо вывести из базы этот комментарий
     * @param string $mysqli_object
     * @param string $comment_id
     * @return string
     */
    public function readTemplate($mysqli_object = '', $comment_id)
    {
        /**
         * Переменная, которая будет возвращена методом.
         * Будет содержать html-разметку с извлеченными из базы данных значениями, которые будут вставлены на место меток-заполнителей
         * @var string
         */
        $comment = "";

        /**
         * Объект - полученный из базы - результирующий набор
         */
        $db_object = $mysqli_object->fetch_object();
        /**
         * Объект коннектора к базе данных
         */
        $dbConnector = new DbConnector("localhost", 'clien_spaik', 'spaik87055091802', 'codersdream');
        /**
         * Прочитать количество записей из базы к данной статье
         */
        $count = $dbConnector->count("comments", "comment_id", $comment_id);
        //массив меток-заполнителей из html-шаблона формы комментариев, которые будут заменены на соответствующие значения из базы данных
        $needle_form = array("[article_id]", "[comment_count]");
        //массив прочитанных из базы значений, которыми будут заменены метки-заполнители из html-шаблона
        $needle_replace = array($comment_id, $count);
        //прочитать html-шаблон формы комментариев
        $full_comment = file_get_contents("templates/default/comment_form.html");
        //и заменить в нем метки-заполнители на значения из базы данных
        $full_comment = str_replace($needle_form, $needle_replace, $full_comment);
        /**
         * Массив меток-заполнителей в html-шаблоне комментариев к статье, которые будут заменены на результаты, полученные из базы данных
         * @var array
         */
        $needle = array("[text]", "[author]", "[comment_date]");
        if($db_object != ''){//если есть комментарии к статье
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
            $full_comment .= "$comment";
        } else {//если нет комментариев
            /*
             * вывести просто форму добавления комментария
             */
            $full_comment = str_replace($needle, $needle_replace, $full_comment);
        }
        return $full_comment;//вернуть распарсенный html шаблон
    }

}
