<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Strutture extends DataClass {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['strutture'] = $this->base_model->getSiteStrutture();

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/strutture', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    function s($id = null) {
        if (!is_null($id)) {
            $this->data['struttura'] = $this->base_model->getSiteStruttura(intval($id));
        }

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/struttura', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    function rank() {
        $this->data['strutture'] = $this->base_model->getSiteStruttureRank();

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/rank', $this->data);
        $this->load->view('common/footer', $this->data);
    }

}
