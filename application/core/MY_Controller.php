<?php

class XhrController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public static function _success($data_label = null, $data = null) {
        $v = array('result' => 1);
        if (!is_null($data_label)) {
            $v[$data_label] = $data;
        }
        die(json_encode($v));
    }

    public static function _error($err = "Errore non specificato", $data = null) {
        $v = array('result' => 0, 'error' => $err);
        if (!is_null($data)) {
            $v['data'] = $data;
        }
        die(json_encode($v));
    }

    public function _remap($method, $params = array()) {
        $out = null;
        if (method_exists($this, $method)) {
            try {
                $out = call_user_func_array(array($this, $method), $params);
            } catch (PDOException $Exception) {
                $parsed = get_string_between($Exception->getMessage(), 'ERROR:', 'CONTEXT:');
                self::_error($parsed, $Exception->getMessage());
            } catch (Exception $ex) {
                self::_error($ex->getMessage(), $ex->getTraceAsString());
            }
        } else {
            //header("HTTP/1.1 404 Not Found");
            $this->output->set_status_header('404');
        }
        return $out;
    }

    public function index() {
        die("NOT ALLOWED");
    }

    public static function post_fields_required($fields) {
        $out = true;
        $missing = array();
        if (is_array($fields)) {
            foreach ($fields as $field) {
                if (!isset($_POST[$field])) {
                    $out = false;
                    $missing[] = $field;
                }
            }
        } else {
            if (!isset($_POST[$fields])) {
                $out = false;
                $missing[] = $fields;
            }
        }
        if (!$out) {
            self::_error("Mancano i parametri " . implode(",", $missing));
        }
    }

    public static function def_end($res, $data_label = null, $data = null, $err = null) {
        if ($res) {
            self::_success($data_label, $data);
        } else {
            self::_error(is_null($err) ? serialize($res) : $err);
        }
    }

}