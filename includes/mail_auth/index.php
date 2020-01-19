<?php

/**
 * PHPMailer - PHP email creation and transport class.
 * PHP Version 5.5
 * @package PHPMailer
 * @see https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2012 - 2017 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Get an OAuth2 token from an OAuth2 provider.
 * * Install this script on your server so that it's accessible
 * as [https/http]://<yourdomain>/<folder>/get_oauth_token.php
 * e.g.: http://localhost/phpmailer/get_oauth_token.php
 * * Ensure dependencies are installed with 'composer install'
 * * Set up an app in your Google/Yahoo/Microsoft account
 * * Set the script address as the app's redirect URL
 * If no refresh token is obtained when running this file,
 * revoke access to your app and run the script again.
 */

namespace PHPMailer\PHPMailer;
session_start();
$user_id = $_SESSION['user_id'];

include "../../config/connection.php";
include "../functions.php";
$mysqli=db_connect();
if (isset($_REQUEST['sign_in'])) {
    $_SESSION['sign_in'] = true;
}
/**
 * Aliases for League Provider Classes
 * Make sure you have added these to your composer.json and run `composer install`
 * Plenty to choose from here:
 * @see http://oauth2-client.thephpleague.com/providers/thirdparty/
 */
// @see https://github.com/thephpleague/oauth2-google
use League\OAuth2\Client\Provider\Google;
// @see https://packagist.org/packages/hayageek/oauth2-yahoo
use Hayageek\OAuth2\Client\Provider\Yahoo;
// @see https://github.com/stevenmaguire/oauth2-microsoft
use Stevenmaguire\OAuth2\Client\Provider\Microsoft;

if (!isset($_GET['code']) && !isset($_GET['provider'])) {
?>
<html>
<body>Select Provider:<br/>
<a href='?provider=Google'>Google</a><br/>
<a href='?provider=Yahoo'>Yahoo</a><br/>
<a href='?provider=Microsoft'>Microsoft/Outlook/Hotmail/Live/Office365</a><br/>
</body>
</html>
<?php
exit;
}

require 'vendor/autoload.php';



$providerName = '';

if (array_key_exists('provider', $_GET)) {
    $providerName = $_GET['provider'];
    $_SESSION['provider'] = $providerName;
} elseif (array_key_exists('provider', $_SESSION)) {
    $providerName = $_SESSION['provider'];
}
if (!in_array($providerName, ['Google', 'Microsoft', 'Yahoo'])) {
    exit('Only Google, Microsoft and Yahoo OAuth2 providers are currently supported in this script.');
}

//These details are obtained by setting up an app in the Google developer console,
//or whichever provider you're using.
$clientId = GOOGLE_CLIENT_ID;
$clientSecret = GOOGLE_CLIENT_SECRET;

//If this automatic URL doesn't work, set it yourself manually to the URL of this script
$redirectUri = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$params = [
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
    'accessType' => 'offline'
];


$options = [];
$provider = null;


switch ($providerName) {
    case 'Google':
        $provider = new Google($params);
        if (isset($_REQUEST['sign_in'])) {
            $options = [
                'scope' => [
                    'https://www.googleapis.com/auth/userinfo.email'
                ]
            ];
        }else{
            $options = [
                'scope' => [
                    'https://mail.google.com/',
                    'https://www.googleapis.com/auth/userinfo.email'
                ]
            ];
        }
        
        break;
    case 'Yahoo':
        $provider = new Yahoo($params);
        break;
    case 'Microsoft':
        $provider = new Microsoft($params);
        $options = [
            'scope' => [
                'wl.imap',
                'wl.offline_access'
            ]
        ];
        break;
}

if (null === $provider) {
    exit('Provider missing');
}


if (!isset($_GET['code'])) {
    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    unset($_SESSION['provider']);
    exit('Invalid state');
} else {
    unset($_SESSION['provider']);
    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken(
        'authorization_code',
        [
            'code' => $_GET['code']
        ]
    );
     // Optional: Now you have a token you can look up a users profile data
    $userDetails = $provider->getResourceOwner($token);
    $user_email = $userDetails->getEmail();
    $sender_name = $userDetails->getName();
    $user_details = array("name"=>$sender_name);
    // Use this to interact with an API on the users behalf
    // Use this to get a new access token if the old one expires
    if (isset($_SESSION['sign_in'])) {
        $sql = "SELECT id FROM users WHERE email = '$user_email' LIMIT 1";
        $pres = $mysqli->query($sql);
        $id = "";
        if($pres->num_rows > 0){
            $arr = $pres->fetch_array( MYSQLI_ASSOC );
            $id = $arr['id'];
        }else{
            $sql = "INSERT INTO users ( joining_date, email, google, user_details, status ) VALUES ('" . date("Y-m-d") . "', '" . $user_email . "', '" . $user_email . "', '" . json_encode($user_details) . "', '" . 1 . "')";
            $pres = $mysqli->query($sql);
            if($pres){
                $sql = "SELECT id FROM users WHERE email = '$user_email' LIMIT 1";
                $pres = $mysqli->query($sql);
                $arr = $pres->fetch_array( MYSQLI_ASSOC );
                $id = $arr['id'];
            }
        }
        set_default_value($id);
        please_go('dashboard');
        unset($_SESSION['sign_in']);
    } else {
        $refresh_token = $token->getRefreshToken();
        $access_token = $token->getToken();

        if ($refresh_token != NULL) {
            add_user_meta($user_id, 'google_refresh_token', $refresh_token);
            add_user_meta($user_id, 'google_gmail_address', $user_email);
            add_user_meta($user_id, 'google_access_token', $access_token);
            add_user_meta($user_id, 'google_sender_name', $sender_name);
        }else{
            //file_get_contents('https://accounts.google.com/o/oauth2/revoke?token='.$access_token);
            get_curl_data('https://accounts.google.com/o/oauth2/revoke?token='.$access_token);
            add_user_meta($user_id, 'google_refresh_token', "");
            add_user_meta($user_id, 'google_gmail_address', "");
            // add_user_meta($user_id, 'google_access_token', "");
            add_user_meta($user_id, 'google_sender_name', "");
        }
        header ('Location: '.BASE.'/auth_settings');
    }
}