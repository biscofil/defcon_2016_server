<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author bisco
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("OpenData");
    }

    public function update() {
        //set_time_limit(0);
        $lista = $this->base_model->getListOpendata();
        foreach ($lista as $key => $opendata) {
            $id = $opendata['id'];
            $class_name = $opendata['class_name'];
            $name = "opendata_$id";
            try {
                echo "<h1>$name</h1><br>";
                $this->load->library('opendata/' . $class_name, NULL, $name);

                $this->{$name}->run();

                unset($this->{$name});
            } catch (Exception $exc) {
                echo "Errore in $opendata > $name<br>";
            }
        }
    }

}
