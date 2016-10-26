<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    function __construct() {

        parent::__construct();
       
    }
    
    public function createPost() {
        $this->load->model(array("blog_model"));
         $data['content']='blog/createpost';
         if ($this->input->post('post')){
              $this->load->library(array('form_validation'));
               $rules = array(
                "name" => array(
                    "field" => "name",
                    "label" => "Blog Name",
                    "rules" => "trim|required"
                ),);
              $this->form_validation->set_rules($rules);
            //Override The Error Message End
            if ($this->form_validation->run() == TRUE) {
                $name='';
                $description='';
                $iduser=$this->session->userdata('session_userId');
                 if ($this->input->post('name')) {
                    $name = $this->input->post('name');
                }
                if ($this->input->post('description')) {
                    $description = $this->input->post('description');
                }
                $values=array('title'=>$name,'post'=>$description,'iduser'=>$iduser);
                $postId=$this->blog_model->registerPost($values);
                if($postId>0){
                   // echo base_url().'Blog/createPost'; exit;
                     $this->session->set_flashdata('success', "Post Created Succcessfully!");
                    redirect(base_url().'Blog/createPost');
                }else{
                     $this->session->set_flashdata('fail', "Post Creation failed!");
                    redirect(base_url().'Blog/createPost');
                }
                
            }
         }
        $this->load->view('common/inner-template',$data);
    }
public function readPost() {
    $this->load->model(array("blog_model"));
     if ($this->uri->segment(3) && $this->uri->segment(3) != '' && $this->uri->segment(3)>0) {
         $id=$this->uri->segment(3);
         $iduser=$this->session->userdata('session_userId');
           
          $data['content'] = "blog/singlepost";
           $data['disc_comments'] = $this->blog_model->get_comment($id);
        $data['disc_post'] = $this->blog_model->get_post($id);
        
         $data['getPersonLikesPerPost'] = $this->blog_model->getPersonLikesPerPost($id,$iduser);
         $data['totalLikesPerPost'] = $this->blog_model->totalLikesPerPost($id,$iduser);
        //print_r($data); exit;
          $this->load->view('common/inner-template', $data);
        //$this->load->view($view, $data);
      
     }
}
  function add_comment($postID)
    {
        if(!$this->input->post())
        {
            redirect(base_url().'Blog/readPost'.$postID);
        }
        $id = $this->session->userdata('session_userId');
        if(!$id)
        {
            redirect(base_url());
        }
        
        $this->load->model('blog_model');
        $data = array(
            'post_id' => $postID,
            'user_id' => $this->session->userdata('id'),
            'comment' => $this->input->post('comment'),
        );
        $this->disc_comment->add_comment($data);
        $this->session->set_flashdata('msg', 'Blog Comment posted Successfully');
        //redirect(base_url().'blog/post/'.$postID);
        redirect(base_url().'dashboard/disc_post/'.$postID);
    }
}
