<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xhr extends XhrController {

    public function xhr_strutture() {
        $res = $this->base_model->getStrutture();

        foreach ($res as $key => $struttura) {
            $k = $this->base_model->getLastPunteggio($struttura['id']);
            $res[$key]['last_value'] = $k['last_value'];
        }

        self::def_end($res, 'dati', $res);
    }

    public function xhr_struttura($id = null) {
        is_null($id) && self::_error('id missing');
        $res = $this->base_model->getStruttura($id);
        (!$res) && self::_error('wrong id');

        ///

        $res = get_update_indice($res);

        $res['storico'] = $this->base_model->getStoricoStruttura($id);

        self::def_end($res, 'dati', $res);
    }

    public function xhr_force_update_all() {
        $res = $this->base_model->getStrutture();
        foreach ($res as $struttura) {
            get_update_indice($struttura);
        }
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
        return helper_gps_to_value($lat, $lng, $raw);
    }

    /**
     *
     * @param type $lat
     * @param type $lng
     */
    public function xhr_details_calcolo($lat = null, $lng = null) {
        $_ozono = $this->base_model->raw_avg($lat, $lng, 'ozono');
        $_pm10 = $this->base_model->raw_avg($lat, $lng, 'pm10');
        $_azoto = $this->base_model->raw_avg($lat, $lng, 'azoto');

        $_si_ozono = sottoindice_ozono($this->base_model->raw_elab($_ozono));
        $_si_azoto = sottoindice_azoto($this->base_model->raw_elab($_azoto));
        $_si_pm10 = sottoindice_azoto($this->base_model->raw_elab($_pm10));

        $arr = array();

        if (is_array($_ozono) && count($_ozono)) {
            foreach ($_ozono as $key => $val) {
                $_ozono[$key]["tipo"] = "ozono";
            }
            $arr = array_merge($arr, $_ozono);
        }

        if (is_array($_pm10) && count($_pm10)) {
            foreach ($_pm10 as $key => $val) {
                $_pm10[$key]["tipo"] = "pm10";
            }
            $arr = array_merge($arr, $_pm10);
        }

        if (is_array($_azoto) && count($_azoto)) {
            foreach ($_azoto as $key => $val) {
                $_azoto[$key]["tipo"] = "azoto";
            }
            $arr = array_merge($arr, $_azoto);
        }

        $out = array(
            "indici" => array(
                'iqa' => calcolo_iqa($_si_azoto, $_si_ozono, $_si_pm10),
                'sottoindice_azoto' => $_si_azoto,
                'sottoindice_ozono' => $_si_ozono,
                'sottoindice_pm10' => $_si_pm10
            ),
            "raw" => $arr
        );

        self::def_end(true, 'dati', $out);
    }

}
