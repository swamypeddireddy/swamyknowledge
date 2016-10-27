<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->view('common/header');
    }

    public function index() {

        if (NULL == $_POST) {

            if (true == $this->session->userdata('session_userId')) {
                     $this->load->model(array("ck_model"));
                //redirect to profile page
                $MSG['Info'] = 'You are logged into ConnectKarma. Below is a Dashboard of ConnectKarma.';
                $MSG['groups'] = $this->ck_model->get_userAllGroups();
                $this->load->view('user/user', $MSG);
                $this->load->view('common/footer');
            } else {

                $this->load->view('home/index');
                $this->load->view('common/footer');
            }
        } elseif (NULL != $_POST) {

            //if loggedin through social media
            if( isset($_POST['socialMediaLogin']) && (true == $_POST['socialMediaLogin']) && ('connected'    == $_POST['status'])) {

                //fetch social media types
                $socialMediaTypes       = $this->db->select('*')->from('social_medias')->get();
                $socialMediaTypesData   = $socialMediaTypes->result();

                foreach($socialMediaTypesData as $socialMediaTypeData) {

                    //if social media match
                    if($socialMediaTypeData->social_media_name  == $_POST['socialMediaLoginName']) {

                        //check if user already registerd through social media
                        $arrayWhere = array('social_media_type_id'=> $socialMediaTypeData->id, 'social_media_user_id'=> $_POST['id']);
                        $queryCheckUserRecord   = $this->db->select('*')->from('social_media_logins')->where($arrayWhere)->get()->num_rows();

                        //create session
                        if('connected'  == $_POST['status']) {

                            $arraySessionData = array (

                                'login_status'          => 1,
                                'session_userId'        => '',
                                'session_userName'      => $_POST['socialMediaLoginName'],
                                'session_userDocument'  => '',
                                'social_media_type_id'  => $socialMediaTypeData->id,
                                'social_media_user_id'  => $_POST['id']
                            );
                            $this->session->sess_expiration = '900';
                            $this->session->set_userdata($arraySessionData);
                        }
                        //echo'session_created';exit;
                        
                        //if not registered in social_media_logins
                        if(false    == $queryCheckUserRecord) {

                            //echo'usr not registered, registering user';

                            //register in social_media_logins
                            $queryInsertSocialMediaLogin = array (

                                'social_media_type_id'  => $socialMediaTypeData->id,
                                'social_media_user_id'  => $_POST['id'],
                                'social_media_username' => $_POST['socialMediaLoginName'],
                                'access_token'          => $_POST['accessToken'],
                                'status'                => $_POST['status'],
                                'created_by'            => '1',
                                'created_on'            => 'now()',
                                'updated_by'            => '1',
                            );

                            $this->db->insert('social_media_logins', $queryInsertSocialMediaLogin);
                        } elseif(true   == $queryCheckUserRecord) {
                            //if registered in social_media_logins

                            //fetch user details for registration by social media
                            $fb = new Facebook\Facebook([
                                'app_id' => '1740937489503955',
                                'app_secret' => '846d9c53d7587ebe128de576b8090396',
                                'default_graph_version' => 'v2.5',
                            ]);

                            $request    = new FacebookRequest (
                                $session,
                                'GET',
                                $_POST['id']
                            );

                            $response       = $request->execute();
                            $graphObject    = $response->getGraphObject();
                            
                            echo'</pre>';print_r($graphObject);echo'</pre>';exit;
                        }

                        $reponceData    = array (

                            'Success'       => 'Login Successful using Facebook. Welcome to ConnectKarma!',
                            'controller'    => 'user',
                            'action'        => 'user'
                        );
                        echo json_encode($reponceData);

                        //$MSG['Success'] = 'Login Successful using Facebook. Welcome to ConnectKarma!';
                        //$this->load->view('user/user', $MSG);
                        //$this->load->view('common/footer');
                    }
                }

                //check for social media login
                /*socialMediaLogin: true,
                        socialMediaLoginName: 'facebook',
                        id: response.id,
                        name: response.name,
                        accessToken: accessToken,
                        status: status

                $queryInsertSocialMediaLogin = array(
                    ''  => $_POST['socialMediaLogin'],
                    ''  => $_POST['socialMediaLoginName'],
                    ''  => $_POST['id'],
                    'social_media_username'  => $_POST['name'],
                    'access_token'  => $_POST['accessToken'],
                    'status'    => $_POST['status'],
                );
                            $this->db->insert('mytable', $data);

                $queryInsertSocialMediaLogin    = ;*/
            } else {

                $arrayWhere     = array('firstname' => $_POST['firstname'], 'password' => md5($_POST['password']));
                $queryResult    = $this->db->select('*')->from('user_registrations')->where($arrayWhere)->get();
                $queryNumRows   = $queryResult->num_rows();
                $queryRowArray  = $queryResult->row_array();

                //echo'<pre>';print_r($queryResult);echo'</pre>';
                //echo'<pre>';print_r($queryNumRows);echo'</pre>';
                //echo'<pre>';print_r($queryRowArray);echo'</pre>';
                //set session data
                if ($queryNumRows === 1) {

                    $arraySessionData = array (

                        'login_status'          => 1,
                        'session_userId'        => $queryRowArray['id'],
                        'session_userName'      => $queryRowArray['firstname'],
                        'session_userDocument'  => $queryRowArray['documents']
                    );
                    $this->session->sess_expiration = '900';
                    $this->session->set_userdata($arraySessionData);

                    $MSG['Success'] = 'Login Successful. Welcome to ConnectKarma!';
                    $this->load->view('user/user', $MSG);
                    $this->load->view('common/footer');
                }
            }
        }
    }

    public function register($data = null) {

        if (NULL == $_POST) {

            $this->load->view('home/register');
            $this->load->view('common/footer');
        } elseif (NULL != $_POST) {

            $data = array(
                'firstname' => $_POST['firstname'],
                'email'     => $_POST['email'],
                'password'  => base64_encode(base64_encode($_POST['password']))
            );

            if (true == $this->db->insert('user_registration', $data)) {
                $userId = $this->db->insert_id();
            }

            if (true == $userId && false != $_FILES['userfile']) {
                $target_dir = getcwd() . '/uploads/' . $userId;
                if (false == is_dir($target_dir)) {

                    shell_exec('mkdir ' . $target_dir);
                    shell_exec('chmod 777 ' . $target_dir);
                }
                if (true == is_dir($target_dir)) {

                    $target_file = $target_dir . '/' . basename($_FILES['userfile']['name']);
                    if (true == move_uploaded_file($_FILES['userfile']["tmp_name"], $target_file)) {

                        $data = array(
                            'documents' => $target_dir . '/' . $_FILES['userfile']['name']
                        );
                        $this->db->where('id', $userId);
                        if (true == $this->db->update('user_registration', $data)) {

                            //redirect to login page
                            //$MSG['Success']    = 'Registration Successful. Please Login';
                            //$this->load->view('home/index', $MSG);
                            //$this->load->view('common/footer');
                            //set session data
                            $arraySessionData = array (
                                
                                'login_status'          => 1,
                                'session_userId'        => $userId,
                                'session_userName'      => $_POST['firstname'],
                                'session_userDocument'  => $target_dir . '/' . $_FILES['userfile']['name']
                            );
                            //$this->session->sess_expiration = '900';
                            $this->session->set_userdata($arraySessionData);

                            //redirect to profile page
                            $MSG['Success'] = 'Your Registration is Successful. Welcome to ConnectKarma!';
                            $this->load->view('user/user', $MSG);
                            $this->load->view('common/footer');
                        } else {

                            $MSG['Error'] = 'Registration Failed';
                            $this->load->view('home/register', $MSG);
                            $this->load->view('common/footer');
                        }
                    }
                }
            } else {

                $MSG['Error'] = 'Please select a file to upload';
                $this->load->view('home/register', $MSG);
                $this->load->view('common/footer');
            }
        }
    }

    public function Logout() {

        $arraySessionData = array (
            
            'login_status'          => 1,
            'session_userId'        => '',
            'session_userName'      => '',
            'session_userDocument'  => ''
        );
        $this->session->set_userdata($arraySessionData);
        $this->index();
    }

    public function userDetails() {

        $this->load->view('user/user');
        $this->load->view('common/footer');
    }

    public function dashboard() {

        $this->load->view('user/profile');
        $this->load->view('common/footer');
    }

    public function emails() {

        $this->load->view('home/emails');
        $this->load->view('common/footer');
    }

    public function feedback() {

        $this->load->view('home/feedback');
        $this->load->view('common/footer');
    }

    public function knowledgeHub() {

        $this->load->view('home/knowledge_hub');
        $this->load->view('common/footer');
    }
 public function ask() {
      if ($this->input->post('ask')){
              $this->load->model(array("ck_model"));
                $asktext='';
                $busntype=0;
                 $group=0;
                $iduser=$this->session->userdata('session_userId');
                 if ($this->input->post('asktext')) {
                    $asktext = $this->input->post('asktext');
                }
                if ($this->input->post('busnasktype')) {
                    $busntype = $this->input->post('busnasktype');
                }
                  if ($this->input->post('askgroup') && ($busntype==2)) {
                    $group = $this->input->post('askgroup');
                }
                $values=array('title'=>$asktext,'public'=>$busntype,'idgroup'=>$group,'createdby'=>$iduser);
                $postId=$this->ck_model->registerAsk($values);
                if($postId>0){
                   // echo base_url().'Blog/createPost'; exit;
                     $this->session->set_flashdata('success', "Ask Created Succcessfully!");
                    redirect(base_url().'User/');
                }else{
                     $this->session->set_flashdata('fail', "Ask Creation failed!");
                    redirect(base_url().'User/');
                }
          }
 }
 public function give() {
      if ($this->input->post('give')){
              $this->load->model(array("ck_model"));
                $asktext='';
                $busntype=0;
                 $group=0;
                $iduser=$this->session->userdata('session_userId');
                 if ($this->input->post('asktext')) {
                    $asktext = $this->input->post('asktext');
                }
                if ($this->input->post('busngivetype')) {
                    $busntype = $this->input->post('busngivetype');
                }
                  if ($this->input->post('givegroup') && ($busntype==2)) {
                    $group = $this->input->post('givegroup');
                }
                $values=array('title'=>$asktext,'public'=>$busntype,'idgroup'=>$group,'createdby'=>$iduser);
                $postId=$this->ck_model->registerGive($values);
                if($postId>0){
                   // echo base_url().'Blog/createPost'; exit;
                     $this->session->set_flashdata('success', "Give Created Succcessfully!");
                    redirect(base_url().'User/');
                }else{
                     $this->session->set_flashdata('fail', "Give Creation failed!");
                    redirect(base_url().'User/');
                }
          }
 }
  public function askList() {
       $this->load->model(array("ck_model"));
        $iduser=$this->session->userdata('session_userId');
       $this->ck_model->get_userAllAsk($iduser);
  }
}
