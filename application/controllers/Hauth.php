<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class HAuth extends CI_Controller {

    public function __construct() {
        // Constructor to auto-load HybridAuthLib
        parent::__construct();
        $this->load->library('HybridAuthLib');
    }

    public function index() {
        // Send to the view all permitted services as a user profile if authenticated
        $login_data['providers'] = $this->hybridauthlib->getProviders();
        foreach ($login_data['providers'] as $provider => $d) {
            if ($d['connected'] == 1) {
                $login_data['providers'][$provider]['user_profile'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
            }
        }

        $this->load->view('hauth/home', $login_data);
    }

    public function login($provider) {

        log_message('debug', "controllers.HAuth.login($provider) called");

        try {

            log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
            $this->load->library('HybridAuthLib');

            if ($this->hybridauthlib->providerEnabled($provider)) {

                log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
                $service = $this->hybridauthlib->authenticate($provider);
                //echo $provider; //exit;

                if ($service->isUserConnected()) {
                    log_message('debug', 'controller.HAuth.login: user authenticated.');

                    $user_profile = $service->getUserProfile();

                    log_message('info', 'controllers.HAuth.login: user profile:' . PHP_EOL . print_r($user_profile, TRUE));

                    $data['user_profile'] = $user_profile;

                    //$this->load->view('hauth/done',$data);
//                                        require_once(APPPATH.'controllers/User.php');
//                                        User::index();
//                    echo'<pre>';
//                    print_r($_GET);
//                    echo'</pre>';
//                    echo'<pre>';
//                    print_r($user_profile);
//                    echo'</pre>';
//                    exit;

                    if ('' != $user_profile) {

//                        echo'<pre>';
//                        print_r($user_profile);
//                        echo'</pre>';
//                        exit;
                        //check if user already registerd through social media
                        $arrayWhere = array('social_media_type_id' => '2', 'social_media_user_id' => $user_profile->identifier);
                        $queryCheckUserRecord = $this->db->select('*')->from('social_media_logins')->where($arrayWhere)->get()->num_rows();

                        //create session
                        //if ('connected' == $_POST['status']) {
                        $arraySessionData = array(
                            'social_login_status' => 1,
                            'session_userId' => '',
                            'session_userName' => 'twitter',
                            'session_userDocument' => '',
                            'social_media_type_id' => '2',
                            'social_media_user_id' => $user_profile->identifier
                        );
                        $this->session->sess_expiration = '900';
                        $this->session->set_userdata($arraySessionData);
                        //}
                        //echo'session_created';exit;
                        //if not registered in social_media_logins
                        if (false == $queryCheckUserRecord) {

                            //echo'usr not registered, registering user';
                            //register in social_media_logins
                            $queryInsertSocialMediaLogin = array(
                                'social_media_type_id' => '2',
                                'social_media_user_id' => $user_profile->identifier,
                                'social_media_username' => $user_profile->displayName,
                                //'access_token' => $_POST['accessToken'],
                                //'status' => $_POST['status'],
                                'profile_url' => $user_profile->profileURL,
                                'created_by' => '1',
                                'created_on' => 'now()',
                                'updated_by' => '1'
                            );
                            $this->db->insert('social_media_logins', $queryInsertSocialMediaLogin);
                            $socialMediaInsertId = $this->db->insert_id();

                            //Insert data in user_registrations on login using twitter
                            $queryInsertUserRegistrations = array(
                                'social_media_login_id' => $socialMediaInsertId,
                                'username' => $user_profile->displayName,
//                                'password'  ,
                                'firstname' => $user_profile->firstName,
//                                'middlename'    ,
                                'lastname' => $user_profile->lastName,
                                'gender' => $user_profile->gender,
                                'email' => $user_profile->email,
                                'date_of_birth' => $user_profile->birthDay . $user_profile->birthMonth . $user_profile->birthYear,
                                'age' => $user_profile->age,
                                'contact_no' => $user_profile->phone,
                                'image' => $user_profile->photoURL,
//                                'documents' ,
//                                'business_category_ids' ,
//                                'email_verification_code'   ,
//                                'email_active_status' => $user_profile->emailVerified,
                                'created_by' => '1',
                                'created_on' => 'now()',
                                'updated_by' => '1'
                            );
                            $this->db->insert('user_registrations', $queryInsertUserRegistrations);

                            //insert user data in other required table
//                            $user_profile->identifier => 171123757
//                            $user_profile->webSiteURL => 
//                            $user_profile->description => 
//                            $user_profile->language => 
//                            $user_profile->address => 
//                            $user_profile->country => 
//                            $user_profile->region => Jalna, India
//                            $user_profile->city => 
//                            $user_profile->zip => 
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

                        redirect('User/index');
                        //$this->index();
//                                            $reponceData = array(
//                                                'Success' => 'Login Successful using Facebook. Welcome to ConnectKarma!',
//                                                'baseURL' => base_url() . 'index.php/',
//                                                'controller' => 'user',
//                                                'action' => 'facebookLogin'
//                                            );
                    }
                } else { // Cannot authenticate user
                    show_error('Cannot authenticate user');
                }
            } else { // This service is not enabled.
                log_message('error', 'controllers.HAuth.login: This provider is not enabled (' . $provider . ')');
                show_404($_SERVER['REQUEST_URI']);
            }
        } catch (Exception $e) {
            $error = 'Unexpected error';
            switch ($e->getCode()) {
                case 0 : $error = 'Unspecified error.';
                    break;
                case 1 : $error = 'Hybriauth configuration error.';
                    break;
                case 2 : $error = 'Provider not properly configured.';
                    break;
                case 3 : $error = 'Unknown or disabled provider.';
                    break;
                case 4 : $error = 'Missing provider application credentials.';
                    break;
                case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                    //redirect();
                    if (isset($service)) {
                        log_message('debug', 'controllers.HAuth.login: logging out from service.');
                        $service->logout();
                    }
                    show_error('User has cancelled the authentication or the provider refused the connection.');
                    break;
                case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                    break;
                case 7 : $error = 'User not connected to the provider.';
                    break;
            }

            if (isset($service)) {
                $service->logout();
            }

            log_message('error', 'controllers.HAuth.login: ' . $error);
            show_error('Error authenticating user.');
        }
    }

    public function endpoint() {

        log_message('debug', 'controllers.HAuth.endpoint called.');
        log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: ' . print_r($_REQUEST, TRUE));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
        }

        log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
        require_once APPPATH . '/third_party/hybridauth/index.php';
    }

    public function logout() {

        echo 'logging out twitter';
    }

}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
