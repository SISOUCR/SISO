<?php
/*
Emilio Rojas
2014
*/

/* */
//SHOWING ALL ERRORS AND WARNINGS
error_reporting(E_ALL);
ini_set('display_errors', 1);
//SHOWING ALL ERRORS AND WARNINGS
/* */

//OR TURN 'EM OFF
//error_reporting(E_ERROR);

/* Set internal character encoding to UTF-8 */
mb_internal_encoding("utf-8");

//Definitions
define( 'CLASS_DIR' , 'Classes' );
define( 'DS' , DIRECTORY_SEPARATOR );

//Class files definition
define( 'API_CONFIG' , 'Config.php' );
define( 'API_DATABASE' , 'Database.php' );
define( 'API_REQUEST' , 'Request.php' );
define( 'API_GET' , 'Get.php' );
define( 'API_POST' , 'Post.php' );
DEFINE( 'API_KEY' , 'Key.php');

//Including classes
include_once CLASS_DIR . DS . API_CONFIG;
include_once CLASS_DIR . DS . API_DATABASE;
include_once CLASS_DIR . DS . API_REQUEST;
include_once CLASS_DIR . DS . API_GET;
include_once CLASS_DIR . DS . API_POST;
include_once CLASS_DIR . DS . API_KEY;