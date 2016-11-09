/* 
 * Created By       : Vivek Ausekar
 * Created On       : 18 Oct, 2016
 * File Location    : http://localhost/connectkarma/assets/js/social_media_login
 * File Name        : social_media_login
 */

//facebook API
$('.fb').click(function () {

    //alert('logging into connectkarma using facebook');
    // Load the SDK asynchronously on document /connectkarma/index.php/User/ as script using facebook-jssdk
    (function (d, s, id) {

        //Reading script jquery.min.js
        var js, fjs = d.getElementsByTagName(s)[0];

        //creating <script id="facebook-jssdk" src="//connect.facebook.net/en_US/sdk.js"> if not exists d.getElementById(id)
        if (d.getElementById(id))
            return;

        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        //js.src = "//connect.facebook.net/en_US/sdk/debug.js";
        fjs.parentNode.insertBefore(js, fjs);

    }(document, 'script', 'facebook-jssdk'));

    //initializing asynchronous call
    window.fbAsyncInit = function () {

        FB.init({
            appId: '1740937489503955',
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse social plugins on this page
            version: 'v2.5' // use graph api version 2.5
        });

        // Now that we've initialized the JavaScript SDK, we call 
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    };

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {

        //alert('statusChangeCallback');
        //console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            var accessToken = response.authResponse.accessToken;
            var status = response.status;
            //console.log(accessToken, status);
            // Logged into your app and Facebook.
            testAPI(accessToken, status);
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.

            $('.messages').css('display', 'block');
            $('.info').css('display', 'block');
            document.getElementById('MSG_INFO').innerHTML = 'Please log into ConnectKarma';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.

            $('.messages').css('display', 'block');
            $('.info').css('display', 'block');
            document.getElementById('MSG_INFO').innerHTML = 'Please log into Facebook.';

            var loginStatus = 0;
            FB.login(function (response) {
                console.log(response);
            }, {scope: 'public_profile,email'});
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {

        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI(accessToken, status) {

        //console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', {fields: 'id,name,first_name,last_name,email,gender'}, function (response) {

            //alert(response.name);
            console.log(response);
            console.log('Successful login for: ' + response.name);

            $.ajax({
                
                method: "POST",
                dataType: "JSON",
                url: "http://localhost/ckfirst/index.php/User/",
                data: {socialMediaLogin: true, socialMediaLoginName: 'facebook', id: response.id, name: response.name, first_name: response.first_name, last_name: response.last_name, email: response.email, gender: response.gender, accessToken: accessToken, status: status},
            }).done(function (data) {

                var URL = data['baseURL'] + data['controller'] + '/' + data['action'];
                window.location = URL;
            });

        });
    }
});

//twitter API
$('.tw').click(function () {
    
//
//    alert('twitter login');
////        $.ajax({
////            method: "POST",
////            dataType: "JSON",
////            url: "https://api.twitter.com/oauth/request_token",
////            data: {OAuth oauth_nonce="K7ny27JTpKVsTgdyLdDfmQQWVLERj2zAK5BslRsqyw", oauth_callback="http%3A%2F%2Fmyapp.com%3A3005%2Ftwitter%2Fprocess_callback", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1300228849", oauth_consumer_key="OqEqJeafRSF11jBMStrZz", oauth_signature="Pc%2BMLdv028fxCErFyi8KXFM%2BddU%3D", oauth_version="1.0"},
////        }).done(function (data) {
////            alert(data);
////            var URL = data['baseURL'] + data['controller'] + '/' + data['action'];
////            window.location = URL;
////        });
//    
////    (function (d, s, id) {
////        
////        //Reading script jquery.min.js
////        var js, fjs = d.getElementsByTagName(s)[0];
////        alert(d.getElementsByTagName(s)[0]);
////
////        if (d.getElementById(id))
////            return
////            alert(d.getElementById(id));
////
////            js = d.createElement(s);
////            js.id = id;
////            js.src = "http://platform.twitter.com/anywhere.js?id=" + 787898701511397376;
////            fjs.parentNode.insertBefore(js, fjs);
////        
////    }(document, "script", 'twitter-anywhere'));
////
////
////    //describe the login actions  
////    twttr.anywhere(function (T) {
////        T.bind("authComplete", function (e, user) {
////            var token = user.attributes._identity;
////            //define the login function on your client through Twitter  
////        });
////    });
////
////    //function we link to the click on the custom login button through Twitter  
////    function doTWSignIn() {
////        twttr.anywhere(function (T) {
////            T.signIn();
////        });
////    }
});

//google API
$('.social_google').click(function () {
    alert('google login');
});