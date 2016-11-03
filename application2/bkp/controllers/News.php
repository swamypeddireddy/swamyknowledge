<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->view('common/header');
    }
    
    /*function __construct() {
        parent::__construct();
        if(empty($this->session->userdata("login_session_user")))
        redirect(site_url(),'refresh');
    }*/

    public function index() {

        $this->load->view('common/footer');
    }

}
