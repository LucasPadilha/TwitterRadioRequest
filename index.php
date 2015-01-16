<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');

/* Create a TwitterOauth object with consumer/user tokens. */
$connection2 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content2 = $connection->get('account/verify_credentials');

// Incluir rádios e frases

include 'include/sentences.php';
include 'include/stations.php';

/* pega o valor do cookie armazenado anteriormente */

$stations = $$_COOKIE["station"];
$country = $_COOKIE["station"];

// Definir idioma do tweet

if ($country == "us1" OR $country == "us2" OR $country == "us3" OR $country == "us4" OR $country == "us5") {
	$lang = $english_us;
	}
else if ($country == "australia" OR $country == "india" OR $country == "s_africa" OR $country == "philippines" OR $country == "canada") {
	$lang = $english;
	}
else if ($country == "uk") {
	$lang = $uk_daydreaming;
	}
else if ($country == "spain") {
	$lang = $spanish;
	}
else if ($country == "ecuador" OR $country == "puertorico") {
	$lang = $spanish1;
	}
else if ($country == "chile" OR $country == "argentina" OR $country == "mexico" OR $country == "peru") {
	$lang = $spanish2;
	}
else if ($country == "italy") {
	$lang = $italian;
	}
else if ($country == "france") {
	$lang = $french;
	}
else if ($country == "br1") {
	$lang = $brazilian;
	}

// Definir tweets aleatórios
$rand = shuffle($lang);

// Tweetar

$count = count($stations);
for ($i = 0; $i < $count; $i++) {
$connection->post('statuses/update', array('status' => $stations[$i] . " " . $lang[$rand]));
$rand = shuffle($lang);
}

echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
alert ("Thank you!")
</SCRIPT>';

echo '<meta http-equiv="refresh" content="0;url=./index.html">';
