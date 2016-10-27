<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Ckhub_model extends CI_Model
{
  
     function get_templates($search)
    {
       $result=array();
         $this->db->select('ck.idtemplates,ck.name,ck.description,ck.document');
        $this->db->from('ck_templates ck');
          $this->db->where('status', 1);
           if($search !=''){
                       $this->db->like('ck.name', $search,false); 
		}
          $this->db->order_by('ck.idtemplates','desc');      
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->result();
         }
          return $result;  
    } 
       function get_links($search)
    {
        $result=array();
         $this->db->select('cl.idlinks,cl.name,cl.description,cl.link');
        $this->db->from('ck_links cl');
          $this->db->where('status', 1);
           if($search !=''){
                       $this->db->like('cl.name', $search,false); 
		}
         $this->db->order_by('cl.idlinks','desc');        
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->result();
         }
          return $result;
    } 
       function get_news($search)
    {
         $result=array();
         $this->db->select('cn.idnews,cn.title,cn.description');
        $this->db->from('ck_news cn');
          $this->db->where('status', 1);
           if($search !=''){
                       $this->db->like('cn.title', $search,false); 
		}
            $this->db->order_by('cn.idnews','desc'); 
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->result();
         }
          return $result;
    } 
}
?>
