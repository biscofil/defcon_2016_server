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

}
