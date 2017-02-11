<?php

/**
 * Description of Admin
 *
 * @author bisco
 */
class Admin extends CI_Controller {

    public function update($id = null) {
        $lista = $this->base_model->getListOpendata($id);
        if ($lista) {
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
        } else {
            die("NOTHING TO DO");
        }
    }

}
