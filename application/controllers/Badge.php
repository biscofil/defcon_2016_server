<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Badge extends CI_Controller {

    public function index($id = null) {
        $this->load->view('demo');
    }

    public function img($id = null) {
        if (!is_null($id)) {
            header("Content-Type: image/png");
            header('Cache-Control: max-age=86400');

            $struttura = $this->base_model->getStruttura(intval($id));

            $im = imagecreatefrompng("public/badge/back2.png");

            $text_color = imagecolorallocate($im, 0, 0, 0);
            imagestring($im, 30, 55, 15, $struttura['nome'], $text_color);
            $text_color = imagecolorallocate($im, 60, 60, 60);
            imagestring($im, 13, 200, 36, date("d.m"), $text_color);

            $col_ellipse = imagecolorallocate($im, 127, 45, 180);
            imagefilledrectangle($im, 220, 10, 240, 30, $col_ellipse);

            imagepng($im);
            imagedestroy($im);
        }
    }

    public function js() {
        //inutile
        header("Content-Type: application/x-javascript");
        header('Cache-Control: max-age=864000');

        echo 'if(window.jQuery){' . PHP_EOL;
        echo 'var key = $("#mydiv").data("key");' . PHP_EOL;
        echo '$("#mydiv").html("<a href=\"' . site_url('s/struttura/') . '" + key +  "\"><img src=\"' . site_url('badge/img/') . '" + key +  "\"></a>");';
        echo PHP_EOL . '}else{' . PHP_EOL . 'alert("MISSING JQUERY");' . PHP_EOL . '}';
    }

}
