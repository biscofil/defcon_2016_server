<?php

abstract class OpenData {

    protected $url = null;
    protected $content = null;
    private $_id = null;

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

    public function __construct($url, $id) {
        $this->url = $url;
        $this->_id = $id;
    }

    public function run() {
        try {
            echo $this->databaseExist() ? "ESISTE DB" : "DB DA CREARE<br>";

            $this->download();
            return $this->custom_parse();
        } catch (Exception $exc) {
            throw new Exception("Errore: " . $exc->getMessage());
        }
    }

    public function databaseExist() {
        $CI = &get_instance();
        return $CI->db->table_exists(self::getTableName($this->_id));
    }

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
