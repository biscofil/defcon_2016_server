<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xhr extends XhrController {

    public function xhr_data() {
        //self::post_fields_required(array('id'));
        //$id = filter_input(INPUT_POST, 'id');
        $res = $this->base_model->getOpenData1();
        self::def_end($res, 'dati', $res);
    }

    public function xhr_strutture() {
        $res = $this->base_model->getStrutture();
        self::def_end($res, 'dati', $res);
    }

    public function xhr_struttura($id = null) {
        $res = $this->base_model->getStruttura($id);
        self::def_end($res, 'dati', $res);
    }

    public function xhr_licenze() {
        $res = $this->base_model->getAllOpendata();
        self::def_end($res, 'dati', $res);
    }

    /**
     * Data una coppia (lat,lng) restituisce un valore
     * @param type $lat
     * @param type $lng
     */
    public function gps_to_value($lat = null, $lng = null, $raw = false) {

        //calcola

        $lat = floatval($lat);
        $lng = floatval($lng);

        $val = $this->base_model->avg_pm10($lat, $lng);
        (!$val) && self::_error('calculation error');

        if ($raw) {
            return $val;
        } else {
            echo json_encode(array('val' => $val));
        }
    }

    /**
     * Dato un ID di una struttura restituisce il suo valore
     * Richiamare questo da front end
     * @param type $id
     */
    public function struttura_to_value($id = null, $raw = false) {
        is_null($id) && self::_error('id missing');
        $id = intval($id);
        $struttura = $this->base_model->getStruttura($id);
        (!$struttura) && self::_error('wrong id');

        //aggiornato = date_diff(now(), struttura.last_value_date) < 24h
        $val = floatval($struttura['last_value']);

        $datetime1 = new DateTime($struttura['last_value_date']);
        $datetime2 = new DateTime("now");
        $interval = $datetime2->diff($datetime1);
        $aggiornato = intval($interval->format('%h')) < 24;

        $aggiornato = false; //togliere
        if ($aggiornato) {
            if ($raw) {
                return $val;
            } else {
                echo json_encode(array('val' => $val));
            }
        } else {
            //calcola valore
            return $this->gps_to_value($struttura['lat'], $struttura['lng'], $raw);
            //aggiorno db
        }
    }

}
