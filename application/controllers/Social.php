<?php

class Social extends CI_Controller {
 
 
  public function __construct() {
     parent::__construct();
       $this->load->library('session','TwitterOAuth');
        $this->load->helper('url');
        $this->load->model('Social_model');
	}//end __construct()
	public function index()
	{
 
	      $this->load->view('login');
	}
 
    public function session($provider) { 
 
    	 $this->load->helper('url_helper');
		 $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
         $request_token = $twitteroauth->getRequestToken('http://w3code.in/index.php/social/getTwitterData');
         $_SESSION['oauth_token'] = $request_token['oauth_token'];
         $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
         $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
          header('Location: ' . $url);
 
		}
    function getTwitterData()
    {
    //echo "hello";die;
              if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
           // We've got everything we need
              $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
       // Let's request the access token
              $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
       // Save it in a session var
           $_SESSION['access_token'] = $access_token;
       // Let's get the user's info
           $user_info = $twitteroauth->get('account/verify_credentials');
       // Print user's info
 
           if (isset($user_info->error)) {
               // Something's wrong, go back to square 1  
               header('Location: login-twitter.php');
           } else {
           $data = array('uid'=>$user_info->id,
                     'name'=>$user_info->name,
                     'follower'=>'',
 
           );
 
                 $this->Social_model->insertTwitterData($data);
           }
       }  
    }
    }