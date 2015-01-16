<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
require_once('config.php');
/* Build an image link to start the redirect process. */
$content = '<a href="./redirect.php">PEDIR PARAMORE NAS RÁDIOS!</a>';

$content2 = '<a href="./redirect2.php">PEDIR PARAMORE NAS RÁDIOS 2!</a>';

