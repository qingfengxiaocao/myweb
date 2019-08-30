<?php
/**
 *   Example for a simple cas 2.0 client
 *
 * PHP Version 5
 *
 * @file     example_simple.php
 * @category Authentication
 * @package  PhpCAS
 * @author   Joachim Fritschi <jfritschi@freenet.de>
 * @author   Adam Franco <afranco@middlebury.edu>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link     https://wiki.jasig.org/display/CASC/phpCAS
 */
// Load the settings from the central config file
require_once 'config.php';
// Load the CAS lib
require_once 'CAS.php';
// Enable debugging
phpCAS::setDebug();
// Enable verbose error messages. Disable in production!
phpCAS::setVerbose(true);
// Initialize phpCAS
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);
// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
phpCAS::setNoCasServerValidation();
// force CAS authentication
phpCAS::forceAuthentication();
// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().
// logout if desired
if (isset($_REQUEST['logout'])) {
	$param=array("service"=>"http://2001:da8:270:2021::62/myweb/index.php");
	phpCAS::logout($param);
	
}
// for this test, simply print that the authentication was successfull
//require 'script_info.php'; 
//session_destroy();
//	//session_start();  	

//phpCAS::getUser() = phpCAS::getUser();//print_r($_SESSION);
//var_dump($_SESSION);
//print_r($_SESSION['phpCAS']);
//print session_name(); echo '<br>';
//print session_id();
                                   //header("Location: index.php");
?>
<!--<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    <p><a href="?logout=<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ; ?>">Logout</a></p>
  </body>
</html>-->