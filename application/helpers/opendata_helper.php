<?php

abstract class OpenData {

    protected $url = null;
    protected $content = null;
    protected $_id = null;
    private $CI;

    public function __construct($url, $id) {
        $this->url = $url;
        $this->_id = $id;
        $this->CI = &get_instance();
    }

    function delete_row(&$array, $offset) {
        return array_splice($array, $offset, 1);
    }

    function delete_col(&$array, $offset) {
        return array_walk($array, function (&$v) use ($offset) {
            array_splice($v, $offset, 1);
        });
    }

    function _combine_array(&$row, $key, $header) {
        $row = array_combine($header, $row);
    }

    public function run() {
        try {
            echo "interrogo  $this->url. ";
            $this->download();
            $this->_db_insert_data($this->custom_parse());
        } catch (Exception $exc) {
            throw new Exception("Errore: " . $exc->getMessage());
        }
    }

    //db

    public function _db_insert_data($data) {

        if (!is_array($data)) {
            throw new Exception("deve essere array");
        }

        if (!(array_key_exists("pm10", $data) && array_key_exists("azoto", $data) && array_key_exists("ozono", $data) )) {
            throw new Exception("deve contenere pm10,azoto e azono");
        }

        $this->_db_ignore_batch_insert("dati_pm10", $data["pm10"]);
        $this->_db_ignore_batch_insert("dati_ozono", $data["ozono"]);
        $this->_db_ignore_batch_insert("dati_azoto", $data["azoto"]);
    }

    private function _db_ignore_batch_insert($tb, $fields) {
        $this->CI->db->trans_start();
        foreach ($fields as $item) {
            $insert_query = $this->CI->db->insert_string($tb, $item);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->CI->db->query($insert_query);
        }
        $this->CI->db->trans_complete();
    }

    //abstract

    public abstract function download();

    public abstract function custom_parse();
}

abstract class CsvOpenData extends OpenData {

    public function download() {
        $this->content = explode("\n", file_get_contents($this->url));
    }

}

abstract class JSONOpenData extends OpenData {

    public function download() {
        $file = file_get_contents($this->url);
        $this->content = json_decode($file);
    }

}

function sottoindice_pm10($media) {
    if (is_null($media))
        return null;
    return ($media / 50.0 ) * 100.0;
}

function sottoindice_azoto($media) {
    if (is_null($media))
        return null;
    return ($media / 200.0 ) * 100.0;
}

function sottoindice_ozono($media) {
    if (is_null($media))
        return null;
    return ($media / 120.0 ) * 100.0;
}

function calcolo_iqa($pm10, $ozono, $azoto) {
    $list = array($pm10, $ozono, $azoto);

    $null_count = 0;
    foreach ($list as $a) {
        if (is_null($a)) {
            $null_count++;
        }
    }

    if ($null_count >= 2) {
        return null;
    }

    sort($list, SORT_NUMERIC);
    array_shift($list);
    return ($list[0] + $list[1] ) / 2.0;
}

function nostroindice($iqa) {
    if (is_null($iqa))
        return null;

    //versione A / lineare
    return 5 - round(($iqa / 200 ) * 5, 2);

    //versione B / scala
}

function get_update_indice($res) {
    $CI = &get_instance();

    $last_update = $CI->base_model->getLastPunteggio($res['id']);

    $aggiornato = true;

    if (!is_null($last_update)) {
        $val = floatval($last_update['last_value']);
        $datetime1 = new DateTime($last_update['last_value_date']);
        $datetime2 = new DateTime('now');
        $interval = $datetime2->diff($datetime1);
        $aggiornato = intval($interval->format('%h')) < 1; //mettere cambiare
    }

    $force = false;

    if ($force || (!$aggiornato) || is_null($last_update)) {
        //calcola valore
        $val_new = helper_gps_to_value($res['lat'], $res['lng'], false);
        $CI->base_model->updatePunteggioStruttura($res['id'], date('Y-m-d H:i:s'), $val_new);

        $res['last_value_date'] = date('Y-m-d H:i:s');
        $res['last_value'] = $val_new;

        //aggiorno db
    }
    return $res;
}

function helper_gps_to_value($lat = null, $lng = null, $raw = true) {
    $CI = &get_instance();
    $lat = floatval($lat);
    $lng = floatval($lng);
    $indice_pm10 = sottoindice_pm10($CI->base_model->avg($lat, $lng, 'pm10'));
    $indice_ozono = sottoindice_ozono($CI->base_model->avg($lat, $lng, 'ozono'));
    $indice_azoto = sottoindice_azoto($CI->base_model->avg($lat, $lng, 'azoto'));
    $val = calcolo_iqa($indice_pm10, $indice_azoto, $indice_ozono);
    $k = nostroindice($val);
    if (!$raw) {
        return $k;
    } else {
        echo json_encode(array('val' => $k, 'iqa' => $val, 'pm10' => $indice_pm10, 'ozono' => $indice_ozono, 'azoto' => $indice_azoto));
    }
}

function ColorHSLToRGB($h, $s, $l) {

    $r = $l;
    $g = $l;
    $b = $l;
    $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);
    if ($v > 0) {
        $m;
        $sv;
        $sextant;
        $fract;
        $vsf;
        $mid1;
        $mid2;

        $m = $l + $l - $v;
        $sv = ($v - $m ) / $v;
        $h *= 6.0;
        $sextant = floor($h);
        $fract = $h - $sextant;
        $vsf = $v * $sv * $fract;
        $mid1 = $m + $vsf;
        $mid2 = $v - $vsf;

        switch ($sextant) {
            case 0:
                $r = $v;
                $g = $mid1;
                $b = $m;
                break;
            case 1:
                $r = $mid2;
                $g = $v;
                $b = $m;
                break;
            case 2:
                $r = $m;
                $g = $v;
                $b = $mid1;
                break;
            case 3:
                $r = $m;
                $g = $mid2;
                $b = $v;
                break;
            case 4:
                $r = $mid1;
                $g = $m;
                $b = $v;
                break;
            case 5:
                $r = $v;
                $g = $m;
                $b = $mid2;
                break;
        }
    }
    return array('r' => intval($r * 255.0), 'g' => intval($g * 255.0), 'b' => intval($b * 255.0));
}

function val2col($hue) {
    if (!(0 <= $hue && $hue <= 5)) {
        die("0 < hue < 5");
    }

    $hue = ( $hue / 5 ) * (255 / 3);

    $sat = 75;
    $lum = 60;

    $hue /= 360;
    $sat /= 100;
    $lum /= 100;

    return ColorHSLToRGB($hue, $sat, $lum);
}
