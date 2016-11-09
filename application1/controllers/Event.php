<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    function __construct() {

        //call parent constuctor
        parent::__construct();

        //call header
        $this->load->view('common/header');

        //get class name and function name
        //$strClassName = $this->router->fetch_class();
        //$strMethodName = $this->router->fetch_method();

        //load perticullar function
        /*switch ($strMethodName) {

            case 'index':
                $this->index();
                break;

            //default:
                //$this->pageNotFound();
        }*/
    }

    public function index() {
        
        $this->load->view('common/footer');
    }

}
