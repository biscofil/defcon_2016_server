<?php

/**
 * Description of base_model
 *
 * @author bisco
 */
class base_model extends CI_Model {

    static $TB_strutture = 'strutture';
    static $TB_storico = 'storico';

    //strutture

    public function nuova_struttura($s) {
        $this->db->insert(self::$TB_strutture, $s);
    }

    public function getStruttura($id) {
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from(self::$TB_strutture);
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
        $this->db->from(self::$TB_strutture);
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
        $this->db->from(self::$TB_strutture);
        $this->db->join('comuni', 'comuni.codice = strutture.comune', 'left');
        $this->db->join('province', 'province.id_provincia = comuni.provincia', 'left');
        $this->db->order_by('last_value', 'desc'); // MY_TODO prenderlo da altra tabella

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return false;
    }

    public function getSiteStrutture() {
        $this->db->select('strutture.*,comuni.nome as nome_comune');
        $this->db->from(self::$TB_strutture);
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
        $this->db->select('id,nome,lat,lng,last_value');
        $this->db->from(self::$TB_strutture);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

    //dati

    public function getListOpendata($id = null) {
        $this->db->select('id,class_name');
        $this->db->where('attivo', 1);

        if (!is_null($id)) {
            $this->db->where('id % 2  = ' . $id, NULL, FALSE);
        }

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

    /// punteggio
    public function raw_avg($lat, $lng, $tab, $radius_km = 30) {
        $tab = 'dati_' . $tab;

        $q = 'SELECT ' . $tab . '.valore as val,(111.1111 * DEGREES(ACOS(COS(RADIANS(' . $tab . '.lat)) * COS(RADIANS(' . $lat . '))'
                . ' * COS(RADIANS(' . $tab . '.lng - ' . $lng . ')) + SIN(RADIANS(' . $tab . '.lat))* SIN(RADIANS(' . $lat . '))))) as distanza '
                . ' FROM ' . $tab . ' WHERE  data = (SELECT MAX(data) FROM dati_pm10 as kk WHERE kk.id_opendata = id_opendata)'
                . ' HAVING distanza < ' . $radius_km;

        $query = $this->db->query($q)->result();

        if (count($query) == 0)
            return null;

        foreach ($query as $mis) {
            $peso = (1 - ($mis->distanza / 300));
            $out[] = array('val' => $mis->val, 'distanza' => $mis->distanza, 'peso' => $peso, 'out' => $mis->val * $peso);
        }

        return $out;
    }

    public function raw_elab($arr) {
        if (is_null($arr)) {
            return null;
        }

        $out = 0;
        foreach ($arr as $mis) {
            $out += $mis['out'];
        }
        $out /= count($arr);
        return $out;
    }

    public function avg($lat, $lng, $tab, $radius_km = 30) {
        $arr = $this->raw_avg($lat, $lng, $tab, $radius_km);
        return $this->raw_elab($arr);
    }

    public function getLastPunteggio($id) {
        $q = 'SELECT last_value_date,last_value FROM storico WHERE id IN (SELECT MAX(id) FROM storico WHERE id_struttura = ' . $id . ') LIMIT 1';
        $query = $this->db->query($q);
        if (count($query) == 0) {
            return null;
        }
        $q = $query->row_array();
        return $q;
    }

    public function updatePunteggioStruttura($id, $data, $punteggio) {
        /* $this->db->set('last_value_date', $data);
          $this->db->set('last_value', $punteggio);
          $this->db->where('id', $id);
          $this->db->update(self::$TB_strutture); */

        $d = array(
            'id_struttura' => $id,
            'last_value' => $punteggio,
            'last_value_date' => $data
        );

        $this->db->insert(self::$TB_storico, $d);
    }

    public function getStoricoStruttura($id) {
        $this->db->select('last_value_date,last_value');
        $this->db->from('storico');
        $this->db->where('id_struttura', $id);
        $this->db->order_by('last_value_date', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        return false;
    }

}
