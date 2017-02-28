<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Strutture extends DataClass {

    function index() {
        $this->data['strutture'] = $this->base_model->getSiteStrutture();

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/strutture', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    function s($id = null) {

        Jscsshandler::addJsFile('http://defcon2016.altervista.org/public/badge/badge.min.js');

        if (!is_null($id)) {
            $this->data['struttura'] = $this->base_model->getSiteStruttura(intval($id));
            if (!$this->data['struttura']) {
                redirect('strutture');
            }
        } else {
            redirect('strutture');
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

    function nuova() {

        $struttura = array(
            'id' => NULL,
            'descrizione' => 'INSERITO DA PHP',
            'id_utente' => '1',
            'nome' => 'B&B Altino',
            'sito_web' => 'http://www.unive.it/',
            'comune' => '66001',
            'lat' => '45.63113349012639',
            'lng' => '12.216110229492188',
            'last_value' => NULL,
            'last_value_date' => NULL,
            'url_img' => 'http://studio-demitri.it/it/sites/default/files/archivio/BedandBreakfast.jpg'
        );

        //$res = $this->base_model->nuova_struttura($struttura);
        //Jscsshandler::includeKnown('gmaps_latlon_picker');

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/nuova_struttura', $this->data);
        $this->load->view('common/footer', $this->data);
    }

}
