<?php

class UserModel extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    function verifyEmailAddress($verificationcode) {

        $sql = "update user_registrations set email_active_status='1' WHERE email_verification_code=?";
        $this->db->query($sql, array($verificationcode));
        return $this->db->affected_rows();
    }

}
