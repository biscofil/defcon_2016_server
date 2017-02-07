<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mappa extends CI_Controller {

    public function index() {
        $this->data['strutture'] = $this->base_model->getSiteStruttureRank();

        $this->load->view('common/header', $this->data);
        $this->load->view('pages/map', $this->data);
        $this->load->view('common/footer', $this->data);
    }

}
