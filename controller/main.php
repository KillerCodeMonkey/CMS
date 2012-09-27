<?php

require_once(__DIR__.'/../view/Smarty.class.php');

/**
 * This controller routes all incoming requests to the appropriate controller
 */
 
//Automatically includes files containing classes that are called
spl_autoload_register(function ($className) {
     echo 'test';
	//compose file name
	$file = __DIR__.'/../model/' . strtolower($className) . '.php';
	
	//fetch file
	if (file_exists($file))
	{
		//get file
		include_once($file);		
	}
	else
	{
		//file does not exist!
		die("File '$className' containing class '$className' not found.");	
	}
});

$Smarty = new Smarty;

//$smarty->force_compile = true;
$Smarty->debugging = true;
$Smarty->caching = true;
$Smarty->cache_lifetime = 120;

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
	
//fetch the passed request
$request = $_SERVER['QUERY_STRING'];

//parse the page request and other GET variables
$parsed = explode('&' , $request);
print_r($parsed);

//the page is the first element
$page = array_shift($parsed);

//the rest of the array are get statements, parse them out.
$getVars = array();
foreach ($parsed as $argument)
{
	//split GET vars along '=' symbol to separate variable, values
	list($variable , $value) = split('=' , $argument);
	$getVars[$variable] = $value;
}

//compute the path to the file
$target = __DIR__.'/../controller/' . $page . '.php';

//get target
if (file_exists($target))
{
	include_once($target);
	
	//modify page to fit naming convention
	$class = ucfirst($page) . Controller;
	
	//instantiate the appropriate class
	if (class_exists($class))
	{
		$controller = new $class;
	}
	else
	{
		//did we name our class correctly?
		die('class does not exist!');
	}
}
else
{
	//can't find the file in 'controllers'! 
	die('page does not exist!');
}

//once we have the controller instantiated, execute the default function
//pass any GET varaibles to the main method
$controller->main($getVars, $Smarty);
?>
