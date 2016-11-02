<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        if (NULL == $_POST) {

            if (true == $this->session->userdata('session_userId') || true == $this->session->userdata('social_login_status')) {

                //redirect to profile page
                $MSG['Info'] = 'You are logged into ConnectKarma. Below is a Dashboard of ConnectKarma.';

                $this->load->view('common/header');
                $this->load->view('user/user', $MSG);
                $this->load->view('common/footer');
            } else {

                $this->load->view('common/header');
                $this->load->view('home/index');
                $this->load->view('common/footer');
            }
        } elseif (NULL != $_POST) {
            //echo'<pre>';print_r($_POST);echo'</pre>';
            //if loggedin through social media
            if (isset($_POST['socialMediaLogin']) && (true == $_POST['socialMediaLogin']) && ('connected' == $_POST['status'])) {

                //fetch social media types
                $socialMediaTypes = $this->db->select('*')->from('social_medias')->get();
                $socialMediaTypesData = $socialMediaTypes->result();

                foreach ($socialMediaTypesData as $socialMediaTypeData) {

                    //if social media match
                    if ($socialMediaTypeData->social_media_name == $_POST['socialMediaLoginName']) {

                        //check if user already registerd through social media
                        $arrayWhere = array('social_media_type_id' => $socialMediaTypeData->id, 'social_media_user_id' => $_POST['id']);
                        $queryCheckUserRecord = $this->db->select('*')->from('social_media_logins')->where($arrayWhere)->get()->num_rows();

                        //create session
                        if ('connected' == $_POST['status']) {
                            $arraySessionData = array(
                                'social_login_status' => 1,
                                'session_userId' => '',
                                'session_userName' => $_POST['socialMediaLoginName'],
                                'session_userDocument' => '',
                                'social_media_type_id' => $socialMediaTypeData->id,
                                'social_media_user_id' => $_POST['id']
                            );
                            $this->session->sess_expiration = '900';
                            $this->session->set_userdata($arraySessionData);
                        }
                        //echo'session_created';exit;
                        //if not registered in social_media_logins
                        if (false == $queryCheckUserRecord) {

                            //echo'usr not registered, registering user';
                            //register in social_media_logins
                            $queryInsertSocialMediaLogin = array(
                                'social_media_type_id' => $socialMediaTypeData->id,
                                'social_media_user_id' => $_POST['id'],
                                'social_media_username' => $_POST['socialMediaLoginName'],
                                'access_token' => $_POST['accessToken'],
                                'status' => $_POST['status'],
                                'created_by' => '1',
                                'created_on' => 'now()',
                                'updated_by' => '1',
                            );

                            $this->db->insert('social_media_logins', $queryInsertSocialMediaLogin);
                        } elseif (true == $queryCheckUserRecord) {
                            //if registered in social_media_logins
//                            //fetch user details for registration by social media
//                            $fb = new Facebook\Facebook([
//                                'app_id' => '1740937489503955',
//                                'app_secret' => '846d9c53d7587ebe128de576b8090396',
//                                'default_graph_version' => 'v2.5',
//                            ]);
//
//                            $request    = new FacebookRequest (
//                                $session,
//                                'GET',
//                                $_POST['id']
//                            );
//
//                            $response       = $request->execute();
//                            $graphObject    = $response->getGraphObject();
//                            
//                            echo'</pre>';print_r($graphObject);echo'</pre>';exit;
                        }

                        //$this->index();

                        $reponceData = array(
                            'Success' => 'Login Successful using Facebook. Welcome to ConnectKarma!',
                            'baseURL' => base_url() . 'index.php/',
                            'controller' => 'user',
                            'action' => 'facebookLogin'
                        );
                        echo json_encode($reponceData);
                        exit;

                        //$MSG['Success'] = 'Login Successful using Facebook. Welcome to ConnectKarma!';
                        //$this->load->view('user/user', $MSG);
                        //$this->load->view('common/footer');
                    }
                }

                //check for social media login
                /* socialMediaLogin: true,
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

                  $queryInsertSocialMediaLogin    = ; */
            } else {

                //echo'login form';
                $arrayWhere = array('email' => $_POST['email_id'], 'password' => md5($_POST['password']));
                //echo'<pre>';print_r($arrayWhere);echo'</pre>';
                $queryResult = $this->db->select('*')->from('user_registrations')->where($arrayWhere)->get();
                $queryNumRows = $queryResult->num_rows();
                $queryRowArray = $queryResult->row_array();

                //echo'<pre>';print_r($queryResult);echo'</pre>';
                //echo'<pre>';print_r($queryNumRows);echo'</pre>';
                //echo'<pre>';print_r($queryRowArray);echo'</pre>';
                //set session data
                if ($queryNumRows === 1) {

                    $arraySessionData = array(
                        'social_login_status' => '',
                        'session_userId' => $queryRowArray['id'],
                        'session_userName' => $queryRowArray['firstname'],
                        'session_userDocument' => $queryRowArray['documents']
                    );
                    $this->session->sess_expiration = '900';
                    $this->session->set_userdata($arraySessionData);

                    $MSG['Success'] = '<br>Login Successful. Welcome to ConnectKarma!';

                    $this->load->view('common/header');
                    $this->load->view('user/user', $MSG);
                    $this->load->view('common/footer');
                }
            }
        }
    }

    public function checkEmailAddressExists() {

        $arrWhere = array('email' => $_POST['email']);
        $queryResult = $this->db->select('*')->from('user_registrations')->where($arrWhere)->get()->num_rows();
        echo json_encode($queryResult);
        exit;
    }

    public function register($data = null) {

        if (NULL == $_POST) {

            $arrCategories['groups'] = $this->db->select('id, category_name')->from('business_categories')->get()->result_array();
            $this->load->view('common/header');
            $this->load->view('home/register', $arrCategories);
            $this->load->view('common/footer');
        } elseif (NULL != $_POST && $_POST['submit'] == 'submit') {

            //echo'<pre>';print_r($_POST);echo'</pre>';exit;
            $data = array(
                'firstname' => $_POST['firstname'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'categories' => $_POST['categories'],
                'created_on' => 'NOW()'
            );

            if (true == $this->db->insert('user_registrations', $data)) {
                $userId = $this->db->insert_id();
            }
//            if (true == $userId && false != $_FILES['userfile']) {
//
//                $target_dir = getcwd() . '/uploads/' . $userId;
//                if (false == is_dir($target_dir)) {
//
//                    shell_exec('mkdir ' . $target_dir);
//                    shell_exec('chmod 777 ' . $target_dir);
//                }
//                if (true == is_dir($target_dir)) {
//
//                    $target_file = $target_dir . '/' . basename($_FILES['userfile']['name']);
//                    if (true == move_uploaded_file($_FILES['userfile']["tmp_name"], $target_file)) {
//
//                        $data = array(
//                            'documents' => $target_dir . '/' . $_FILES['userfile']['name']
//                        );
//                        $this->db->where('id', $userId);
//                        if (true == $this->db->update('user_registrations', $data)) {
            //redirect to login page
            //$MSG['Success']    = 'Registration Successful. Please Login';
            //$this->load->view('home/index', $MSG);
            //$this->load->view('common/footer');
            //set session data

            $data = array(
                'created_by' => $userId,
                'updated_by' => $userId
            );
            $this->db->where('id', $userId);
            $this->db->update('user_registrations', $data);

            $arraySessionData = array(
                'social_login_status' => '',
                'session_userId' => $userId,
                'session_userName' => $_POST['firstname']
                    //'session_userDocument' => $target_dir . '/' . $_FILES['userfile']['name']
            );
            //$this->session->sess_expiration = '900';
            $this->session->set_userdata($arraySessionData);

            //redirect to profile page
            $MSG['Success'] = 'Your Registration is Successful. Welcome to ConnectKarma!';

            $this->load->view('common/header');
            $this->load->view('user/user', $MSG);
            $this->load->view('common/footer');
        } else {
            if (true == $this->session->userdata('session_userId') || true == $this->session->userdata('social_login_status')) {

                //redirect to profile page
                $MSG['Info'] = 'You are logged into ConnectKarma. Below is a Dashboard of ConnectKarma.';

                $this->load->view('common/header');
                $this->load->view('user/user', $MSG);
                $this->load->view('common/footer');
            }
        }
//                        else {
//
//                            $MSG['Error'] = 'Registration Failed';
//                            $this->load->view('home/register', $MSG);
//                            $this->load->view('common/footer');
//                        }
        //}
        //}
        //}
//            else {
//
//                $MSG['Error'] = 'Please select a file to upload';
//                $this->load->view('home/register', $MSG);
//                $this->load->view('common/footer');
//            }
//        }
    }

    public function Logout() {

        $arraySessionData = array(
            'social_login_status' => '',
            'session_userId' => '',
            'session_userName' => '',
            'session_userDocument' => ''
        );
        $this->session->set_userdata($arraySessionData);

        $this->load->view('common/header');
        $this->load->view('home/index');
        $this->load->view('common/footer');
    }

    public function userDetails() {

        $this->load->view('common/header');
        $this->load->view('user/user');
        $this->load->view('common/footer');
    }

    public function dashboard() {

        $this->load->view('common/header');
        $this->load->view('user/profile');
        $this->load->view('common/footer');
    }

    public function emails() {

        $this->load->view('common/header');
        $this->load->view('home/emails');
        $this->load->view('common/footer');
    }

    public function feedback() {

        $this->load->view('common/header');
        $this->load->view('home/feedback');
        $this->load->view('common/footer');
    }

    public function knowledgeHub() {

        $this->load->view('common/header');
        $this->load->view('home/knowledge_hub');
        $this->load->view('common/footer');
    }

    public function facebookLogin() {

        $MSG['Success'] = 'Login Successful using Facebook. Welcome to ConnectKarma!';

        $this->load->view('common/header');
        $this->load->view('user/user', $MSG);
        $this->load->view('common/footer');
    }

    public function twitterLogin() {

        //echo'logged in twitter';exit;
//        $CONSUMER_KEY='PkzEK1tvOWCATgyk4R3uvEaWs';
//        $CONSUMER_SECRET='xqnOCsTLKITYCORsDIQOThjNh9ROXdf4hxekWzd3sJlaxLDBKr';
//        $OAUTH_CALLBACK='http://172.16.4.126/ckfirst/index.php/User/index';
//
//        $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
//        $request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token
//        $MSG['Success'] = 'Login Successful using Facebook. Welcome to ConnectKarma!';
        $reponceData = 1;
//                array(
//            
//            'Success' => 'Login Successful using Facebook. Welcome to ConnectKarma!',
//            'baseURL' => base_url() . 'index.php/',
//            'controller' => 'user',
//            'action' => 'facebookLogin'
//        );
        echo json_encode($reponceData);
        exit;

        $this->load->view('common/header');
        $this->load->view('user/user', $MSG);
        $this->load->view('common/footer');
    }

}
