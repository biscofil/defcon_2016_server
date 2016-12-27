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

}
