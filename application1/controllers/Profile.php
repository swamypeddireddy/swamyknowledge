<?php

class Profile extends CI_Controller {

	public function linkedin_connect()
	{
		define('API_KEY', '78un9sant5o14b'); // input your API Key here
		define('API_SECRET', '52UcUPRQgVxyouIH'); // input your API Secret here
		define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . '/ckfirst/index.php/User/index');
		//define('REDIRECT_URI', 'http://183.82.114.189/ckfirst/User/index'); // input your redirect (redirect to this method again)
		define('SCOPE', 'r_basicprofile r_fullprofile r_contactinfo r_emailaddress');

		// You'll probably use a database
		session_name('linkedin');
		session_start();

		// OAuth 2 Control Flow
		if (isset($_GET['error'])) {
			// LinkedIn returned an error
			print $_GET['error'] . ': ' . $_GET['error_description'];
			exit;
		} elseif (isset($_GET['code'])) {
			// User authorized your application
			if ($_SESSION['state'] == $_GET['state']) {
				// Get token so you can make API calls
				$this->getAccessToken();
			} else {
				// CSRF attack? Or did you mix up your states?
				exit;
			}
		} else { 
			if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
				// Token has expired, clear the state
				$_SESSION = array();
			}
			if (empty($_SESSION['access_token'])) {
				// Start authorization process
				$this->getAuthorizationCode();
			}
		}

		// Congratulations! You have a valid token. Now fetch your profile 
		$user = $this->fetch('GET', '/v1/people/~:(firstName,lastName,headline,email-address,summary,educations,last-modified-timestamp,interests,skills,date-of-birth,positions,picture-url,languages,projects)');

		$cv_contents = '
			<div>
				<div style="float:left;width:80px;margin-right:10px;">
					<img src="'.$user->pictureUrl.'" />
				</div>
				<div style="float:left;">
					<h1 style="margin:0">'.$user->firstName.' '.$user->lastName.'</h1>
					<p>'.$user->headline.'</p>
					<p>'.$user->emailAddress.'</p>
				</div>
			</div>
			<div style="clear:both;"></div>
			<hr />
			<h2>Summary</h2>
			<p>'.$user->summary.'</p>
			<hr />
			<p>Experience ('.$user->positions->_total.' total)</p>
		';

		if(isset($user->positions->values))
		{
			$cv_contents .= "<ul>";
			foreach ($user->positions->values as $experience)
			{
				if(!isset($experience->summary))
				{
					$summary = "No experience description available for this company.";
				}
				else
				{
					$summary = $experience->summary;
				}

				$cv_contents .= "
					<li>
						<p>".$experience->company->name." as ".$experience->title."</p>
						<p>".$summary."</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
		}
		else
		{
			$cv_contents .= "No information available.";
		}

		$cv_contents .= "<hr />";
		$cv_contents .= "<h2>Projects</h2>";

		if(isset($user->projects->values))
		{
			$cv_contents .= "<ul>";
			foreach ($user->projects->values as $projects)
			{
				$cv_contents .= "
					<li>
						<p>".$projects->name."</p>
						<p>".$projects->description."</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
		}
		else
		{
			$cv_contents .= "No information available.";
		}

		$cv_contents .= "<hr />";
		$cv_contents .= "<h2>Languages</h2>";

		if(isset($user->languages->values))
		{
			/*
			$cv_contents .= "<ul>";
			foreach ($user->languages->values as $languages)
			{
				$cv_contents .= "
					<li>
						<p>".$languages->language->name."</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
			*/

			$cv_contents .= "<ul>";
			foreach ($user->languages->values as $languages)
			{
				$cv_contents .= "
					<li>
						<p>".$languages->language->name."</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
		}
		else
		{
			$cv_contents .= "No information available.";
		}

		$cv_contents .= "<hr />";
		$cv_contents .= "<h2>Skills &amp; Expertise</h2>";

		if(isset($user->skills->values))
		{
			$cv_contents .= "<ul>";
			foreach ($user->skills->values as $skills)
			{
				$cv_contents .= "
					<li>
						<p>".$skills->skill->name."</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
		}
		else
		{
			$cv_contents .= "No information available.";
		}

		$cv_contents .= "<hr />";
		$cv_contents .= "<h2>Education</h2>";

		if(isset($user->educations->values))
		{
			$cv_contents .= "<ul>";
			foreach ($user->educations->values as $educations)
			{
				$cv_contents .= "
					<li>
						<p>".$educations->schoolName." (".$educations->startDate->year." to ".$educations->endDate->year.")</p>
					</li>
				";
			}
			$cv_contents .= "</ul>";
		}
		else
		{
			$cv_contents .= "No information available.";
		}

		$cv_contents .= "<hr />";
		$cv_contents .= "<h2>Interests</h2>";
		$cv_contents .= "<p>".$user->interests."</p>";

		echo $cv_contents;
	}

	private function getAuthorizationCode()
	{
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

	private function getAccessToken()
	{
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
		$_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
		$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time

		return true;
	}

	private function fetch($method, $resource, $body = '')
	{
		$params = array('oauth2_access_token' => $_SESSION['access_token'],
						'format' => 'json',
				  );

		// Need to use HTTPS
		$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
		// Tell streams to make a (GET, POST, PUT, or DELETE) request
		$context = stream_context_create(
						array('http' => 
							array('method' => $method,
		                    )
		                )
		            );

		// Hocus Pocus
		$response = file_get_contents($url, false, $context);

		// Native PHP object, please
		return json_decode($response);
	}

}