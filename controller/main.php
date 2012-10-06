<?php

require_once(__DIR__.'/../view/Smarty.class.php');
require_once(__DIR__."/../functions/session.inc.php");

/**
 * This controller routes all incoming requests to the appropriate controller
 */
 
// Automatically includes files containing classes that are called
spl_autoload_register(function ($className) {
	// compose file name
	$file = __DIR__.'/../model/' . strtolower($className) . '.php';
	
	// fetch file
	if (file_exists($file))
	{
		// get file
		include_once($file);		
	}
	else
	{
		// file does not exist!
		die("File '$className' containing class '$className' not found.");	
	}
});

if(!isset($_SESSION)) {
    // There is no active session
    StartSecureSession();
}
// Creates a new smarty object.
$Smarty = new Smarty;

// $Smarty->force_compile = true;
$Smarty->debugging = true;
$Smarty->caching = false;
$Smarty->cache_lifetime = 120;

// Set template, compile, cache directories.
$Smarty->setTemplateDir(__DIR__.'/../templates')
       ->setCompileDir(__DIR__.'/../templates_c')
       ->setCacheDir(__DIR__.'/../cache');

$User = new User();

if($User->getCurrentUser() && defined('USER')) {    
    $UserID = $User->getID();
    if ($UserID != USER) {
        define('USER',$UserID);
    }
    $Smarty->assign('CurrentUser', $User);
    $Smarty->assign('LoggedIn', 1);
} else {
    define('USER', null);
    $Smarty->assign('LoggedIn', 0);
}
	
// fetch the passed request
$request = $_SERVER['QUERY_STRING'];
// parse the page request and other GET variables
$parsed = explode('&' , $request);
// the page is the first element
$page = array_shift($parsed);

// the rest of the array are get statements, parse them out.
$getVars = array();
foreach ($parsed as $argument)
{
	// split GET vars along '=' symbol to separate variable, values
	list($variable , $value) = preg_split('/=/' , $argument);
	$getVars[$variable] = $value;
}

// compute the path to the file
$target = __DIR__.'/../controller/' . $page . '.php';

// get target
if (file_exists($target)) {
	include_once($target);
	
	// modify page to fit naming convention
	$class = ucfirst($page) . 'Controller';
	
	// instantiate the appropriate class
	if (class_exists($class)) {
		$controller = new $class;
		// once we have the controller instantiated, execute the default function
		// pass any GET varaibles to the main method
		$controller->main($getVars, $Smarty);
	}
	else {
		// did we name our class correctly?
		die('class does not exist!');
	}
} elseif (!file_exists($target) && $page == "") {
	$Smarty->assign('Title', 'Startpage');
	$Smarty->display('index.tpl');	
} else {
	// can't find the file in 'controllers'!
    $Smarty->assign('Title', 'Fehler');
    $Smarty->assign('Msg', 'Seite "' . $_SERVER['QUERY_STRING']. '" nicht gefunden!');
	$Smarty->display('error.tpl');
}
?>
