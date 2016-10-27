<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ckhub extends CI_Controller {

    function __construct() {

        parent::__construct();
    
    }

    public function index() {
 
             $title=$this->input->post('title');
                $this->load->model(array("ckhub_model"));
             $data['templates']=$this->ckhub_model->get_templates($title);
             //echo $this->db->last_query(); exit;
               $data['links']=$this->ckhub_model->get_links($title);
               $data['news']=$this->ckhub_model->get_news($title);
                $data['chubsearch']=$title;
                 $data['content']='ckhub/ckhublist';
                  $this->load->view('common/inner-template',$data);
        
        
        
    }

}
?>