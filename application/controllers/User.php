<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    function getAuthorizationCode() {
        $params = array('response_type' => 'code',
            'client_id' => API_KEY,
            'scope' => SCOPE,
            'state' => uniqid('', true), // unique long string
            'redirect_uri' => REDIRECT_URI,
        );
        // Authentication request
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);

        // Needed to identify request when it returns to us
        $_SESSION['state'] = $params['state'];
        // Redirect user to authenticate
        header("Location: $url");
        exit;
    }

    public function getAccessToken() {
        $params = array('grant_type' => 'authorization_code',
            'client_id' => API_KEY,
            'client_secret' => API_SECRET,
            'code' => $_GET['code'],
            'redirect_uri' => REDIRECT_URI,
        );

        // Access Token request
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);

        // Tell streams to make a POST request
        $context = stream_context_create(
                array('http' =>
                    array('method' => 'POST',
                    )
                )
        );
        // Retrieve access token information
        $response = file_get_contents($url, false, $context);
        // Native PHP object, please
        $token = json_decode($response);
        // Store access token and expiration time
        $_SESSION['access_token'] = $token->access_token; // guard this! 
        $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time

        return true;
    }

    function fetch($method, $resource, $body = '') {

        $params = array('oauth2_access_token' => $_SESSION['access_token'],
            'format' => 'json',
        );
        $url = 'https://www.linkedin.com' . $resource . '?' . http_build_query($params);
        $context = stream_context_create(
                array('http' =>
                    array('method' => $method,
                    )
                )
        );
        $response = file_get_contents($url, false, $context);
        return json_decode($response);
    }

    public function index() {

        if (NULL != $_GET && NULL != $_GET['state'] && NULL != $_GET['code']) {

//            echo'<pre>';print_r($_GET);echo'</pre>';
            define('API_KEY', '78un9sant5o14b');
            define('API_SECRET', '52UcUPRQgVxyouIH');
            define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . '/ckfirst');
            define('SCOPE', 'r_fullprofile r_emailaddress');

            if (isset($_GET['error'])) {
                // LinkedIn returned an error
                print $_GET['error'] . ': ' . $_GET['error_description'];
                exit;
            } elseif (isset($_GET['code'])) {
                $this->getAccessToken();
            } else {
                if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
                    // Token has expired, clear the state
                    $_SESSION = array();
                }
                if (empty($_SESSION['access_token'])) {
                    // Start authorization process
                    getAuthorizationCode();
                }
            }

            //fetch user data
            $user = $this->fetch('GET', '/v1/people/~:(id,firstName,lastName,headline,picture-url,email-address,date-of-birth)');
//            echo'<pre>';print_r($user);echo'</pre>';
            //check if user already registerd through social media
            $arrayWhere = array('social_media_type_id' => '3', 'social_media_user_id' => $user->id);
            $queryCheckUserRecord = $this->db->select('*')->from('social_media_logins')->where($arrayWhere)->get()->num_rows();

//            echo $queryCheckUserRecord;//exit;
            //create session
            $arraySessionData = array(
                'social_login_status' => 1,
                'session_userId' => '',
                'session_userName' => 'LinkedIn',
                'session_userDocument' => '',
                'social_media_type_id' => '3',
                'social_media_user_id' => $user->id
            );
            $this->session->sess_expiration = '900';
            $this->session->set_userdata($arraySessionData);

            if (false == $queryCheckUserRecord) {

                //Register into social_media_logins
                $queryInsertSocialMediaLogin = array(
                    'social_media_type_id' => '3',
                    'social_media_user_id' => $user->id,
                    'social_media_username' => $user->firstName .' '. $user->lastName,
                    'access_token' => $_GET['code'],
                    //'status' => $_POST['status'],
                    'created_by' => '1',
                    'created_on' => 'now()',
                    'updated_by' => '1',
                );

                //Get inserId of social media logins
                if ($this->db->insert('social_media_logins', $queryInsertSocialMediaLogin)) {
                    $socialMediaInsertId = $this->db->insert_id();
                }

                //Insert data in user_registrations on login using LinkedIn
                $queryInsertUserRegistrations = array(
                    'social_media_login_id' => $socialMediaInsertId,
                    'username' => $user->firstName . $user->lastName,
//                                'password'  ,
                    'firstname' => $user->firstName,
//                                'middlename'    ,
                    'lastname' => $user->lastName,
//                    'gender' => $user_profile->gender,
                    'email' => $user->emailAddress,
//                    'date_of_birth' => $user_profile->birthDay . $user_profile->birthMonth . $user_profile->birthYear,
//                    'age' => $user_profile->age,
//                    'contact_no' => $user_profile->phone,
                    'image' => $user->pictureUrl,
//                                'documents' ,
//                                'business_category_ids' ,
//                                'email_verification_code'   ,
//                                'email_active_status' => $user_profile->emailVerified,
                    'created_by' => '1',
                    'created_on' => 'now()',
                    'updated_by' => '1'
                );
                $this->db->insert('user_registrations', $queryInsertUserRegistrations);
            } else {
                $this->linkedInLogin();
            }
        }

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
            //if loggedin through social media using facebook
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
                                'social_media_username' => $_POST['name'],
                                'access_token' => $_POST['accessToken'],
                                'status' => $_POST['status'],
                                'created_by' => '1',
                                'created_on' => 'now()',
                                'updated_by' => '1',
                            );

                            $this->db->insert('social_media_logins', $queryInsertSocialMediaLogin);
                        } 

                        $reponceData = array(
                            'Success' => 'Login Successful using Facebook. Welcome to ConnectKarma!',
                            'baseURL' => base_url() . 'index.php/',
                            'controller' => 'user',
                            'action' => 'facebookLogin'
                        );
                        echo json_encode($reponceData);
                        exit;
                    }
                }
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
                } else {

                    $MSG['Success'] = '<br>UserId and Password does not match, Authentication Failure!';

                    $this->load->view('common/header');
                    $this->load->view('home/index', $MSG);
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

            //load required models
            $this->load->model('UserModel');
            $this->load->model('EmailModel');

            //echo'<pre>';print_r($_POST);echo'</pre>';exit;
            $data = array(
                'firstname' => $_POST['firstname'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'business_category_ids' => $_POST['categories'],
                'created_on' => 'now()'
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

            $verificationCode = substr(md5(uniqid(rand(), true)), 16, 16);
            //      $this->sendVerificationEmail($_POST['email'], $verificationCode);exit;

            $data = array(
                'created_by' => $userId,
                'updated_by' => $userId,
                'email_verification_code' => $verificationCode
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
            $MSG['Success'] = 'Your Registration is Successful. An email is sent to your email address for verification. <br>Welcome to ConnectKarma!';

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
    }

    public function verify($verificationText = NULL) {

        $noRecords = $this->UserModel->verifyEmailAddress($verificationText);
        if ($noRecords > 0) {

            $MSG['Success'] = 'Your email address verified. Welcome to ConnectKarma!';

            $this->load->view('common/header');
            $this->load->view('user/user', $MSG);
            $this->load->view('common/footer');
        } else {

            $MSG['Error'] = 'Your email address verification code does not match. Please contact Administrator!';

            $this->load->view('common/header');
            $this->load->view('user/index', $MSG);
            $this->load->view('common/footer');
        }
    }

    public function sendVerificationEmail($userEmail, $verificationCode) {

        $this->load->model('EmailModel');
        $this->EmailModel->sendVerificatinEmail($userEmail, $verificationCode);
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

    public function forgotPassword() {
        
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

    public function linkedInLogin() {

        $MSG['Success'] = 'Login Successful using LinkedIn. Welcome to ConnectKarma!';

        $this->load->view('common/header');
        $this->load->view('user/user', $MSG);
        $this->load->view('common/footer');
    }

    public function twitterLogin() {

        $reponceData = 1;
        echo json_encode($reponceData);exit;
    }

}
