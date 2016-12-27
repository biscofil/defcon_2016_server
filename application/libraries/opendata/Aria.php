<?php

class Aria extends JSONOpenData {

    public function __construct() {
        parent::__construct("http://89.96.234.233/aria-json/exported/aria/coords.json", 1);
    }

    private function _dati() {
        $stazioni = file_get_contents("http://89.96.234.233/aria-json/exported/aria/data.json");
        $stazioni = json_decode($stazioni);

        $array = $stazioni->stazioni;
        foreach ($array as $key => $value) {
            if (count($value->misurazioni) == 0) {
                unset($array[$key]);
            } else {
                foreach ($value->misurazioni as $key2 => $value2) {
                    if (isset($value2->pm10)) {
                        if (count($value2->pm10) > 1) {
                            $array[$key]->misurazioni[$key2]->pm10 = end($value2->pm10);
                        }
                    }
                    if (isset($value2->ozono)) {
                        if (count($value2->ozono) > 1) {
                            $array[$key]->misurazioni[$key2]->ozono = end($value2->ozono);
                        }
                    }
                }
            }
        }
        return $array;
    }

    public function _stazioni($file) {
        $out = array();
        foreach ($file->coordinate as $row) {
            //$row = $row[0];
            $out[$row->codseqst] = $row;
            unset($out[$row->codseqst]->codseqst);
        }
        return $out;
    }

    public function custom_parse() {
        $stazioni = $this->_stazioni($this->content);
        $dati = $this->_dati();

        $out = array();
        foreach ($dati as $misurazione) {

            $ozono = null;
            $data_ozono = null;
            $pm10 = null;
            $data_pm10 = null;

            if (is_array($misurazione->misurazioni)) {
                foreach ($misurazione->misurazioni as $m) {
                    if (isset($m->ozono)) {
                        $ozono = $m->ozono->mis;
                        $data_ozono = $m->ozono->data;
                    } elseif (isset($m->pm10)) {
                        $pm10 = $m->pm10->mis;
                        $data_pm10 = $m->pm10->data;
                    }
                }
            }

            if (!(is_null($ozono) && is_null($pm10))) {
                $out[] = array(
                    "id" => $misurazione->codseqst,
                    "lat" => $stazioni[$misurazione->codseqst]->lat,
                    "lng" => $stazioni[$misurazione->codseqst]->lon,
                    "ozono" => $ozono,
                    "data_ozono" => $data_ozono,
                    "pm10" => $pm10,
                    "data_pm10" => $data_pm10
                );
            }
        }

        return $out;
    }

}
