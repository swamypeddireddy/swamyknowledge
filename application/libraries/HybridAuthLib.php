<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//echo APPPATH . 'third_party/hybridauth/Hybrid/Auth.php';
require APPPATH . 'third_party/hybridauth/Hybrid/Auth.php';

class HybridAuthLib extends Hybrid_Auth {

    function __construct($config = array()) {
        
        $ci = & get_instance();
        $ci->load->helper('url_helper');
        $config['base_url'] = site_url((config_item('index_page') == '' ? SELF : '') . $config['base_url']);

//        echo'<pre>';print_r($ci);echo'</pre>';
//echo'<pre>';print_r($config);echo'</pre>';exit;
        parent::__construct($config);
        echo 'in construct';//exit;
        log_message('debug', 'HybridAuthLib Class Initalized');
    }

    /**
     * @deprecated
     */
    public static function serviceEnabled($service) {
        return self::providerEnabled($service);
    }

    public static function providerEnabled($provider) {
        return isset(parent::$config['providers'][$provider]) && parent::$config['providers'][$provider]['enabled'];
    }

}

/* End of file HybridAuthLib.php */
/* Location: ./application/libraries/HybridAuthLib.php */