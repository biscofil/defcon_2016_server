<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base_model
 *
 * @author bisco
 */
class base_model extends CI_Model {

    public function getStruttura($id) {
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from('strutture');
        $this->db->join('comuni', 'comuni.codice = strutture.comune', 'left');
        $this->db->join('province', 'province.id_provincia = comuni.provincia', 'left');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
        return false;
    }

    public function getSiteStruttura($id) {
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from('strutture');
        $this->db->join('comuni', 'comuni.codice = strutture.comune', 'left');
        $this->db->join('province', 'province.id_provincia = comuni.provincia', 'left');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
        return false;
    }

    public function getSiteStruttureRank() {
        //MY_TODO
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from('strutture');
        $this->db->join('comuni', 'comuni.codice = strutture.comune', 'left');
        $this->db->join('province', 'province.id_provincia = comuni.provincia', 'left');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return false;
    }

    public function getSiteStrutture() {
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from('strutture');
        $this->db->join('comuni', 'comuni.codice = strutture.comune', 'left');
        $this->db->join('province', 'province.id_provincia = comuni.provincia', 'left');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return false;
    }

    public function getStrutture() {
        $this->db->select('id,nome,lat,lng');
        $this->db->from('strutture');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

    public function getListOpendata() {
        $this->db->select('id,class_name');
        $this->db->where('attivo', 1);
        $this->db->from('lista_opendata');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

    public function getAllOpendata() {
        $this->db->select('id,licenza,link_licenza,descrizione');
        $this->db->where('attivo', 1);
        $this->db->from('lista_opendata');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

    ///

    public function getOpenData1() {
        $this->db->select('lat,lng,1 as weight', NULL, FALSE);
        $this->db->from('opendata_1');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

    ///

    public function calcValue($lat, $lng) {
        $q = "SELECT *, 111.1111 * DEGREES(ACOS(COS(RADIANS(lat)) * COS(RADIANS($lat)) * COS(RADIANS(lng - $lng)) "
                . "+ SIN(RADIANS(lat))* SIN(RADIANS($lat)))) AS distance_in_km FROM strutture";
        $query = $this->db->query($q)->result();
        print_r($query);
        return 1;
    }

    public function avg_pm10($lat, $lng, $radius_km = 60) {
        $q = 'SELECT AVG(opendata_1.pm10) as avg_pm10 FROM opendata_1 '
                . 'WHERE (111.1111 * DEGREES(ACOS(COS(RADIANS(opendata_1.lat)) * COS(RADIANS(' . $lat . ')) '
                . '* COS(RADIANS(opendata_1.lng - ' . $lng . ')) + SIN(RADIANS(opendata_1.lat))* SIN(RADIANS(' . $lat . '))))) < ' . $radius_km;
        $query = $this->db->query($q)->row();
        return $query->avg_pm10;
    }

}
