<?php

abstract class OpenData {

    protected $url = null;
    protected $content = null;
    private $_id = null;
    private $CI;

    public function __construct($url, $id) {
        $this->url = $url;
        $this->_id = $id;
        $this->CI = &get_instance();
    }

    private static function getTableName($id) {
        return "opendata_$id";
    }

    function delete_row(&$array, $offset) {
        return array_splice($array, $offset, 1);
    }

    function delete_col(&$array, $offset) {
        return array_walk($array, function (&$v) use ($offset) {
            array_splice($v, $offset, 1);
        });
    }

    function _combine_array(&$row, $key, $header) {
        $row = array_combine($header, $row);
    }

    public function run() {
        try {
            $this->download();
            $this->_db_insert_data($this->custom_parse());
        } catch (Exception $exc) {
            throw new Exception("Errore: " . $exc->getMessage());
        }
    }

    //db

    public function _db_table_exist() {
        return $this->CI->db->table_exists(self::getTableName($this->_id));
    }

    public function _db_insert_data($data) {
        if ($this->_db_table_exist()) {
            $this->_db_clear_data();
        } else {
            $this->_db_create_table();
        }
        $this->CI->db->insert_batch(self::getTableName($this->_id), $data);
    }

    public function _db_clear_data() {
        $this->CI->db->where("1", "1");
        $this->CI->db->delete(self::getTableName($this->_id));
    }

    public function _db_create_table() {
        $_tn = self::getTableName($this->_id);
        //SQL DDL
        $this->CI->db->query("CREATE TABLE IF NOT EXISTS $_tn ("
                . 'id int(11) NOT NULL,'
                . 'lat decimal(12,8) NOT NULL,'
                . 'lng decimal(12,8) NOT NULL,'
                . 'ozono varchar(20) DEFAULT NULL,'
                . 'pm10 varchar(20) DEFAULT NULL,'
                . 'data_ozono varchar(20) DEFAULT NULL,'
                . 'data_pm10 varchar(20) DEFAULT NULL,'
                . 'weight decimal(10,5) NOT NULL DEFAULT \'1.00000\','
                . 'PRIMARY KEY (id)'
                . ') ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    }

    //abstract

    public abstract function download();

    public abstract function custom_parse();
}

abstract class CsvOpenData extends OpenData {

    public function download() {
        $this->content = explode("\n", file_get_contents($this->url));
    }

}

abstract class JSONOpenData extends OpenData {

    public function download() {
        $file = file_get_contents($this->url);
        $this->content = json_decode($file);
    }

}
