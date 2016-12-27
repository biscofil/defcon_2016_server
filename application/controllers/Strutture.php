<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Strutture extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

    }

    function s($id = null) {
        if (!is_null($id)) {
            $struttura = $this->base_model->getStruttura(intval($id));
            echo "<pre>";
            print_r($struttura);
            echo "</pre>";
        }
    }

}
