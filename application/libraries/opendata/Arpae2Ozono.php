<?php

class Arpae2Ozono extends JSONOpenData {

    public function __construct() {
        parent::__construct("http://www.arpa.emr.it/qualita-aria/bollettino-ozono/json", 4);
    }

    public function custom_parse() {

        $_pm10 = array();
        $_ozono = array();
        $_azoto = array();



        echo "<pre>";
        print_r($this->content);
        echo "</pre>";

        $out = array("pm10" => $_pm10, "ozono" => $_ozono, "azoto" => $_azoto);
        return $out;
    }

}
