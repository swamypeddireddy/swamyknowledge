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
       //    echo "<pre>"; print_r($data['disc_comments']); exit;
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
          $iduser=$this->session->userdata('session_userId');
        if(!$iduser)
        {
            redirect(base_url());
        }
        
        $this->load->model('blog_model');
        $data = array(
            'idblog' => $postID,
            'iduser' => $iduser,
            'comment' => $this->input->post('comment'),
        );
        $this->blog_model->add_comment($data);
        $this->session->set_flashdata('msg', 'Blog Comment posted Successfully');
         
        //redirect(base_url().'blog/post/'.$postID);
        redirect(base_url().'Blog/readPost/'.$postID);
    }
    function disc_like() {//single post page

 $this->load->model('blog_model');
            $post_id = $this->input->post('postId');
        $user_id =  $this->session->userdata('session_userId');
        
      
       // $data = array('user_id' => $user_id);
        $likes = $this->blog_model->insert_like($post_id, $user_id);

        echo $likes;
        exit;
    }

    function disc_unlike() {//single post page
$this->load->model('blog_model');
          $post_id = $this->input->post('postId');
        $user_id =  $this->session->userdata('session_userId');
         $likes = $this->blog_model->delete_like($post_id, $user_id);

        echo $likes;
        exit;
    }
}
