<?php

class C0201050concinquinpm10 extends CsvOpenData {

    public function __construct() {
        parent::__construct("http://dati.veneto.it/dataset/64fcb822-2ca1-4e41-bea2-21437f445573/resource/3c54cd61-a537-456d-925f-ad385049d16d/download/c0201050concinquinpm10.csv", 2);
    }

    public function custom_parse() {
        /* $file = $this->content;

          $header_1 = array_shift($file);
          $header_2 = array_shift($file);


          $CI = &get_instance();

          $array = array();
          foreach ($file as $row) {
          $d = str_getcsv($row, ";");
          if (array_key_exists(1, $d) && array_key_exists(30, $d) && intval($d[30])) {
          try {
          $array[] = array($d[1], intval($d[30]));
          } catch (Exception $ex) {

          }
          }
          }
         *
         * */

        /*
          $colonne = count($array[0]);
          $colonne_inizio = 2;
          $colonne_fine = 2;

          for ($a = $colonne_inizio + 1; $a <= ($colonne - $colonne_fine); $a++) {
          $this->delete_col($array, $colonne_inizio);
          }

          foreach ($array as $key => $riga) {
          if ((!isset($riga[2])) || (!isset($riga[3])) || $riga[2] == "-" || $riga[3] == "-") {
          unset($array[$key]);
          }
          } */



        return array();
    }

}
