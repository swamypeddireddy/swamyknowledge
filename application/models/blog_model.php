<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Blog_model extends CI_Model
{
 public function registerPost($TableData) {
        $Id = 0;
         //print_r($customerTableData); exit;
        $this->db->insert('ck_blog', $TableData);
		//echo $this->db->last_query(); exit;
        $InsertedRows = $this->db->affected_rows();
        if ($InsertedRows > 0) {
            $Id = $this->db->insert_id();
        }
        return $Id;
    }
      function get_comment($post_id)
    {
          $result=array();
        $this->db->select('cb.*,ur.firstname');
        $this->db->from('ck_blogcomments cb');
        $this->db->join('user_registrations ur','ur.id = cb.iduser');
        $this->db->where('cb.idblog',$post_id);
        $this->db->order_by('cb.createddate','asc');
        $res = $this->db->get();
        if ($res && $res->num_rows() > 0) {
       $result = $res->result();
        } 
       
        return $result;    
    }
    
     function get_post($post_id)
    {
       $result=array();
         $this->db->select('cb.*');
        $this->db->from('ck_blog cb');
        $this->db->where(array('cb.idblog'=>$post_id));
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->row();
         }
          return $result;  
    }
        function getPersonLikesPerPost($post_id,$iduser)
    {
       $result=array();
         $this->db->select('cbl.idbloglikes');
        $this->db->from('ck_bloglikes cbl');
        $this->db->where(array('cbl.idblog'=>$post_id,'cbl.iduser'=>$iduser));
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->row();
         }
          return $result;  
    }
      function totalLikesPerPost($post_id)
    {
       $result=array();
         $this->db->select('count(cbl.idbloglikes) as likes',false);
        $this->db->from('ck_bloglikes cbl');
        $this->db->where(array('cbl.idblog'=>$post_id));
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->row();
         }
          return $result;  
    }
     function add_comment($data)
    {
        $this->db->insert('ck_blogcomments',$data);
        return $this->db->insert_id();
    }
     function insert_like($post_id,$user_id) 
    {
         $Id=0;
        $ip_data = array('idblog'=>$post_id,'iduser' => $user_id);
            $this->db->insert('ck_bloglikes',$ip_data);
             $InsertedRows = $this->db->affected_rows();
        if ($InsertedRows > 0) {
            $Id = $this->db->insert_id();
        }
        return $Id;
      }
     function delete_like($post_id,$user_id) 
    {
         $ip_data = array('idblog'=>$post_id,'iduser' => $user_id);
            $this->db->delete('ck_bloglikes',$ip_data);
         return 1;
      }
}
?>
