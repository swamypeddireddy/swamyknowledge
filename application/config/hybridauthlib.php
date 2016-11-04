<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* !
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config = array(
            // set on "base_url" the relative url that point to HybridAuth Endpoint
            'base_url' => '/hauth/endpoint',
            "providers" => array(
                // openid providers
                "OpenID" => array(
                    "enabled" => false
                ),
                "Yahoo" => array(
                    "enabled" => false,
                    "keys" => array("id" => "", "secret" => ""),
                ),
                "AOL" => array(
                    "enabled" => false
                ),
                "Google" => array(
                    "enabled" => true,
                    "keys" => array("id" => "124110517731-lf0ilncd3g1vdfpjb6f1jcacol31a0h9.apps.googleusercontent.com", "secret" => "gzrBJJFo31Ctiuyz5oqLwJE0"),
                ),
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array("id" => "1740937489503955", "secret" => "846d9c53d7587ebe128de576b8090396"),
                ),
                "Twitter" => array(
                    "enabled" => true,
                    "keys" => array("key" => "PkzEK1tvOWCATgyk4R3uvEaWs", "secret" => "xqnOCsTLKITYCORsDIQOThjNh9ROXdf4hxekWzd3sJlaxLDBKr")
                ),
                // windows live
                "Live" => array(
                    "enabled" => false,
                    "keys" => array("id" => "", "secret" => "")
                ),
                "MySpace" => array(
                    "enabled" => false,
                    "keys" => array("key" => "", "secret" => "")
                ),
                "LinkedIn" => array(
                    "enabled" => true,
                    "keys" => array("key" => "81uc8r94gifjtg", "secret" => "Cr3LLILdekZVXWl1")
                ),
                "Foursquare" => array(
                    "enabled" => false,
                    "keys" => array("id" => "", "secret" => "")
                ),
            ),
            // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
            "debug_mode" => (ENVIRONMENT == 'development'),
            "debug_file" => APPPATH . 'logs/hybridauth.log',
);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */