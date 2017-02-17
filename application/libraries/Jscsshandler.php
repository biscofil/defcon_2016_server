<?php

/**
 * Description of JsCssHandler
 *
 * @author filippo bisconcin
 */
class Jscsshandler {

    private static $properties = array();
    private static $js_files = array();
    private static $css_files = array();
    private static $known = null;

    public function __construct() {
        $p = base_url('public') . '/';
        $s = '';
        self::$known = array(
            'jquery' => array(
                '1.12.4' => array('js' => array($p . 'plugins/jquery/1.12.4/jquery.min.js')),
            ),
            'maps' => array(
                '0' => array('js' => 'http://maps.googleapis.com/maps/api/js?sensor=false')
            ),
            'gmaps_latlon_picker' => array(
                '1.2' => array(
                    'css' => array($p . 'plugins/gmaps_latlon_picker/1.2/css/jquery-gmaps-latlon-picker.css'),
                    'js' => array($p . 'plugins/gmaps_latlon_picker/1.2/js/jquery-gmaps-latlon-picker.js')
                )
            )
        );

        self::setJsProperty('site_url', site_url());
        self::setJsProperty('base_url', base_url());
        self::setJsProperty('public_url', $p);
    }

    public static function includeKnown($name, $version = null) {
        if (array_key_exists($name, self::$known)) {
            $item = null;
            if (is_null($version)) {
                $item = end(self::$known[$name]);
                if (!$item) {
                    DIE("CANNOT LOAD $name.");
                }
            } else {
                if (array_key_exists($version, self::$known[$name])) {
                    $item = & self::$known[$name][$version];
                } else {
                    DIE("CANNOT LOAD $name - $version.");
                }
            }

            if (array_key_exists('require', $item)) {
                foreach ($item['require'] as $file => $_version) {
                    self::includeKnown($file, $_version);
                }
            }

            if (array_key_exists('js', $item)) {
                foreach ($item['js'] as $file) {
                    self::addJsFile($file);
                }
            }

            if (array_key_exists('css', $item)) {
                foreach ($item['css'] as $file) {
                    self::addCssFile($file);
                }
            }
        } else {
            DIE("CANNOT LOAD $name.");
        }
    }

    public static function setJsProperty($name, $value) {
        self::$properties[$name] = $value;
    }

    public static function myformat($data) {
        if (is_array($data)) {
            $out = "[";
            foreach ($data as $key => $val) {
                $out .= self::myformat($val) . ",";
            }
            return $out . "]";
        } elseif (is_object($data)) {
            $out = "{";
            foreach ($data as $key => $val) {
                $out .= "'$key':" . self::myformat($val) . ",";
            }
            return $out . "}";
        } elseif (is_numeric($data)) {
            return $data;
//} elseif (is_string($data)) {
//    return "'$data'";
        } else {
            return "'$data'"; //boh
        }
    }

    public static function addJsFile($path, $params = null) {
        self::$js_files[] = array('url' => $path, 'params' => $params);
    }

    public static function addCssFile($path, $params = array('rel' => 'stylesheet')) {
        self::$css_files[] = array('url' => $path, 'params' => $params);
    }

    public static function out_js_properties() {
        echo '<script>';
        foreach (self::$properties as $key => $value) {
            echo 'var __' . $key . ' = ' . self::myformat($value) . '; ';
        }
        echo '</script>' . PHP_EOL;
    }

    public static function out_js_files() {
        foreach (self::$js_files as $file) {
            echo '<script src="' . $file['url'] . '"';
            if (!is_null($file['params'])) {
                foreach ($file['params'] as $key => $value) {
                    echo ' ' . $key . (!is_null($value) ? '="' . $value . '"' : '');
                }
            }
            echo '></script>' . PHP_EOL;
        }
    }

    public static function out_css_files() {
        foreach (self::$css_files as $file) {
            echo '<link href="' . $file['url'] . '"';
            if (!is_null($file['params'])) {
                foreach ($file['params'] as $key => $value) {
                    echo ' ' . $key . (!is_null($value) ? '="' . $value . '"' : '');
                }
            }
            echo '>' . PHP_EOL;
        }
    }

}
