<?php

class Aria extends JSONOpenData {

    public function __construct() {
        parent::__construct("http://89.96.234.233/aria-json/exported/aria/coords.json", 1);
    }

    public function _formato_to_timestamp($input) {
        //2017-02-05 19:10:01
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $input);
        return $input; //$date->format('U');
    }

    public function _stazioni($file) {
        $stazioni = array();
        foreach ($file->coordinate as $row) {
            //$row = $row[0];
            $stazioni[$row->codseqst] = $row;
            unset($stazioni[$row->codseqst]->codseqst);
        }
        return $stazioni;
    }

    public function custom_parse() {
        $stazioni = $this->_stazioni($this->content);

        $mis_staz = file_get_contents("http://89.96.234.233/aria-json/exported/aria/data.json");
        $mis_staz = json_decode($mis_staz);

        $_pm10 = array();
        $_ozono = array();

        foreach ($mis_staz->stazioni as $key => $value) {
            if (count($value->misurazioni) == 0) {
                unset($mis_staz->stazioni[$key]);
            } else {
                foreach ($value->misurazioni as $key2 => $value2) {

                    $common = array(
                        "id_stazione" => $value->codseqst,
                        "lat" => $stazioni[$value->codseqst]->lat,
                        "lng" => $stazioni[$value->codseqst]->lon,
                        "id_opendata" => $this->_id); //da db


                    if (isset($value2->pm10) && count($value2->pm10)) {

                        foreach ($value2->pm10 as $mis) {
                            $k = $_pm10[] = array_merge($common, array("data" => $this->_formato_to_timestamp($mis->data), "valore" => $mis->mis));
                        }
                    }
                    if (isset($value2->ozono) && count($value2->ozono)) {

                        foreach ($value2->ozono as $mis) {
                            $_ozono[] = array_merge($common, array("data" => $this->_formato_to_timestamp($mis->data), "valore" => $mis->mis));
                        }
                    }
                }
            }
        }

        unset($mis_staz);

        $out = array("pm10" => $_pm10, "ozono" => $_ozono, "azoto" => array());

        //echo "<pre>" . print_r($out, true) . "</pre>";

        return $out;
    }

}
