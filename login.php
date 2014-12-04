<?php
session_start();
set_include_path("../src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/Client.php';

$client_id = '80315172508.apps.googleusercontent.com';
$client_secret = 'PGCM5jzIyIZxNHNvnW4Cl-FF';
$redirect_uri = 'https://www.castillomax.com/pagos/login.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('email', 'profile');

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();
}

if (!isset($token_data)) {
  header( 'Location: ' .$authUrl) ;
} else {
  $_SESSION['email'] = $token_data[payload][email]; 
  $_SESSION['domain'] = $token_data[payload][hd]; 
  $_SESSION['verified'] = $token_data[payload][email_verified];
  if ($token_data[payload][email] == 'latencio@castillomax.com' || $token_data[payload][email] == 'mcastillo@castillomax.com' || $token_data[payload][email] == 'jviloria@castillomax.com') {
    $_SESSION['admin'] = 1;
  } else {
    $_SESSION['admin'] = 0;
  }
  header( 'Location: http://www.castillomax.com/pagos/insertar.php');
}
?>