<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Ck_model extends CI_Model
{
  
     public function registerAsk($TableData) {
        $Id = 0;
         //print_r($customerTableData); exit;
        $this->db->insert('ck_businessask', $TableData);
		//echo $this->db->last_query(); exit;
        $InsertedRows = $this->db->affected_rows();
        if ($InsertedRows > 0) {
            $Id = $this->db->insert_id();
        }
        return $Id;
    }
     public function registerGive($TableData) {
        $Id = 0;
         //print_r($customerTableData); exit;
        $this->db->insert('ck_businessgive', $TableData);
		//echo $this->db->last_query(); exit;
        $InsertedRows = $this->db->affected_rows();
        if ($InsertedRows > 0) {
            $Id = $this->db->insert_id();
        }
        return $Id;
    }
         function get_userAllGroups()
    {
       $result=array();
         $this->db->select('group_name,id');
        $this->db->from('user_groups');
         $this->db->order_by('group_name','asc');      
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->result();
         }
          return $result;  
    }
            function get_userAllAsk($id)
    {
       $result=array();
         $this->db->select('ur.firstname,cba.title,cba.createddate');
        $this->db->from('ck_businessask cba');
         $this->db->join('user_registrations ur','ur.id = cba.createdby');
         $this->db->where('cba.createdby',$id);
         $this->db->where('cba.public',1);
         $this->db->order_by('cba.idbusinessask','desc');      
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $result=$res->result();
         }
          return $result;  
    }
}
?>