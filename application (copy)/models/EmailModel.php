<?php

class EmailModel extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    function sendVerificatinEmail($email, $verificationText) {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            'smtp_port' => 25,
            'smtp_user' => 'vivekausekar@gmail.com', // change it to yours
            'smtp_pass' => 'Soulmate@1', // change it to yours
            //'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
        );
        
//        $config = Array(		
//            'protocol' => 'smtp',
//            //'smtp_host' => 'ssl://smtp.googlemail.com',
//            'smtp_host' => '172.16.4.126',
//            //'smtp_port' => 465,
//            'smtp_port' => 25,
//            'smtp_user' => 'vivekausekar@gmail.com',
//            'smtp_pass' => 'Soulmate@1',
//            'smtp_timeout' => '30',
//            'mailtype'  => 'html', 
//            'charset'   => 'iso-8859-1'
//        );

//        $config['protocol']='smtp';
//        $config['smtp_host']='localhost';
//        $config['smtp_port']=25;
//        $config['smtp_timeout']=30;
//        $config['smtp_user']='vivekausekar@gmail.com';
//        $config['smtp_pass']='Soulmate@1';
//        $config['charset']='utf-8';  
//        $config['newline']="\r\n";

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('vivekausekar@gmail.com', "Admin Team");
        $this->email->to($email);
        $this->email->subject("Email Verification");
        $this->email->message("Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://172.16.4.126/ckfirst/verify/" . $verificationText . "\n" . "\n\nThanks\nAdmin Team");
        
        //try{
            
            if($this->email->send()) {
                
                echo 'Message has been sent.';
            } else {
                
                echo'Problem in sending verification email<br>Error:';
                echo $this->email->print_debugger();exit;
            }
        //} catch(Exception $e) {
            
            
        //}
    }
}
