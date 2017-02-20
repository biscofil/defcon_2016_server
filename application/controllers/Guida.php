<?php

class Guida extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {

    }

    public function calcolo() {
        $this->load->view('guida/header');
        $this->load->view('guida/calcolo');
        $this->load->view('guida/footer');
    }

    public function guida() {
        $this->load->view('guida/header');
        $this->load->view('guida/guida');
        $this->load->view('guida/footer');
    }

}
