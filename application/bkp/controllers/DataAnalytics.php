<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataAnalytics extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->view('common/header');
    }

    public function index() {

        $this->load->view('data analytics/data-analytic');
        $this->load->view('common/footer');
    }

}
