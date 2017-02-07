<?php

abstract class OpenData {

    protected $url = null;
    protected $content = null;
    protected $_id = null;
    private $CI;

    public function __construct($url, $id) {
        $this->url = $url;
        $this->_id = $id;
        $this->CI = &get_instance();
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

    public function _db_insert_data($data) {

        if (!is_array($data)) {
            throw new Exception("deve essere array");
        }

        if (!(array_key_exists("pm10", $data) && array_key_exists("azoto", $data) && array_key_exists("ozono", $data) )) {
            throw new Exception("deve contenere pm10,azoto e azono");
        }

        $this->_db_ignore_batch_insert("dati_pm10", $data["pm10"]);
        $this->_db_ignore_batch_insert("dati_ozono", $data["ozono"]);
        $this->_db_ignore_batch_insert("dati_azoto", $data["azoto"]);
    }

    private function _db_ignore_batch_insert($tb, $fields) {
        $this->CI->db->trans_start();
        foreach ($fields as $item) {
            $insert_query = $this->CI->db->insert_string($tb, $item);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->CI->db->query($insert_query);
        }
        $this->CI->db->trans_complete();
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
