<?php

/**
 * Description of Calcolo
 *
 * @author bisco
 */
class Calcolo extends DataClass {

    public function index() {
        $this->load->view('common/header', $this->data);
        $this->load->view('calcolo', $this->data);
        $this->load->view('common/footer', $this->data);
    }

}
