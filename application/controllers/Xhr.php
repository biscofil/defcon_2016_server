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
        is_null($id) && self::_error('id missing');
        $res = $this->base_model->getStruttura($id);
        (!$res) && self::_error('wrong id');

        ///
        $val = floatval($res['last_value']);

        $datetime1 = new DateTime($res['last_value_date']);
        $datetime2 = new DateTime("now");
        $interval = $datetime2->diff($datetime1);
        $aggiornato = intval($interval->format('%h')) < 1; //mettere cambiare

        if ((!$aggiornato) || is_null($res['last_value'])) {
            //calcola valore
            $val_new = $this->gps_to_value($res['lat'], $res['lng'], false);
            $this->base_model->updatePunteggioStruttura($id, date('Y-m-d H:i:s'), $val_new);

            $res['last_value_date'] = date('Y-m-d H:i:s');
            $res['last_value'] = $val_new;

            //aggiorno db
        }

        ///

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
    public function gps_to_value($lat = null, $lng = null, $raw = true) {
        $lat = floatval($lat);
        $lng = floatval($lng);
        $indice_pm10 = sottoindice_pm10($this->base_model->avg($lat, $lng, 'pm10'));
        $indice_ozono = sottoindice_ozono($this->base_model->avg($lat, $lng, 'ozono'));
        $indice_azoto = 0; //sottoindice_azoto($this->base_model->avg($lat, $lng, 'azoto'));
        $val = calcolo_iqa($indice_pm10, $indice_azoto, $indice_ozono);
        $k = nostroindice($val);
        if (!$raw) {
            return $k;
        } else {
            echo json_encode(array('val' => $k, 'iqa' => $val, 'pm10' => $indice_pm10, 'ozono' => $indice_ozono, 'azoto' => $indice_ozono));
        }
    }

}
