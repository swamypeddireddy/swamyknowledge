<?php

class Social_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertTwitterData($data) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('uid', $data['uid']);
        $result = $this->db->get()->row();
        if (!empty($result)) {
            $this->db->where('uid', $data['uid']);
            $this->db->update('users', $data);
            echo "logged in success to dashboard";
            die;
        } else {
            $this->db->insert('users', $data);
            echo "logged in success to dashboard";
            die;
        }
    }

}
