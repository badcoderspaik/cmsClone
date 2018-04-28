<?
//Класс соединения и работы с базой данных
class DbConnector
{
    //Объект соединения с базой данных
    public $db;
    /**
     * DbConnector constructor.
     * @param $host имя хоста базы данных
     * @param $username пользователь базы данных
     * @param $password пароль к базе данных
     * @param $dbname имя базы данных
     */
    function __construct($host, $username, $password, $dbname)
    {
        $this->db = new mysqli($host, $username, $password, $dbname);
    }
    /**
     * sql-инструкция SELECT
     * @param $query строка запроса
     * @param bool $show логическая переменная - если передано true, то результаты запроса выводятся на экран
     * если false, то нет; параметр нужен для отладки
     * @return bool|mysqli_result в случае неудачи возвращает false, в случае успешного выполнения
     * возвращает объект mysqli_result
     */
    public function select($query, $show = true)
    {
        //Объект mysqli_result
        $result = $this->db->query($query);
        if ($show) {//если передан аргумент $show - записать результат полученного запроса в таблицу и отобразить
            while ($row = $result->fetch_row()) {
                foreach ($row as $column) {
                    echo "$column,";
                }
            }
        }
        return $this->db->query($query);
    }

    /**
     * @param $table имя таблицы
     * @param $field имя поля в искомой таблице, значение которого необходимо получить
     * @return mixed значение искомого поля
     */
    public function selectField($table, $field) {
        $result = $this->db->query("SELECT $field FROM $table");
        $db_object = $result->fetch_object();
        $result_field = $db_object->$field;
        return $result_field;
    }

    /**
     * sql инструкция INSERT
     * @param $query строка запроса
     * @return bool|mysqli_result возвращаемое значение - false случае неудачи, true в случае успеха
     */
    public function insert($query)
    {
        $result = $this->db->query($query);
        return $result;
    }
    /**
     * sql инструкция DELETE
     * @param $query строка запроса
     * @return bool|mysqli_result возвращаемое значение - false в случае неудачи, true в случае успеха
     */
    public function delete($query)
    {
        $result = $this->db->query($query);
        return $result;
    }
    /**
     * sql-инструкция UPDATE
     * @param $query строка запроса
     * @return bool|mysqli_result возвращаемое значение - true в случае успеха, false в случае неудачи
     */
    public function update($query)
    {
        $result = $this->db->query($query);
        return $result;
    }
    /**
     * Очищает данные от спецсимволов и html тегов перед записью их в базу данных
     * @param $data данные, которые необходимо очистить
     * @return string возвращает строку
     */
    public function cleanData(&$data){
        $data = strip_tags($data);//убрать html теги
        $data = htmlspecialchars($data);//преобразовать спецсимволы в html сущности
        $data = $this->db->real_escape_string($data);//экранировать спецсимволы, принимая во внимание кодировку соединения с базой данных
        return $data;
    }

    /**
     * Читает и возвращает число записей, удовлетворяющих заданному условию
     * @param $table_name имя таблицы
     * @param $column_name имя столбца
     * @param $value значение искомого столбца
     * @return int возвращаемый результат
     */
    public function count($table_name, $column_name, $value){
        $result = $this->select("SELECT * FROM $table_name WHERE $column_name = $value", false);
        $field_count = $result->num_rows;
        return $field_count;
    }

}