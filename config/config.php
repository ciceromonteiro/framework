<?php
/*
* config file: contains default definitions
*/
header('Content-type: text/html; charset=utf-8');
session_name('5b2af3df55f975cb9bafd01e09adfc51b8089f38');
session_start();
ob_start();
set_time_limit(2000);
date_default_timezone_set('America/Recife');

// display errors: 1 - production, 0 - usage
ini_set('display_errors', 1);

// default definitions 
define('DIR', 'monteiro');
define('WWWROOT', "http://".$_SERVER['SERVER_NAME']."/".DIR);
define('WEBROOT', WWWROOT."/webroot");
define('ACTION', end(explode('/', $_SERVER['REQUEST_URI'])));
define('DOCROOT', $_SERVER['DOCUMENT_ROOT']."/".DIR);

// globals
global $FIELDS;
global $ONLOAD;
global $MSG;
global $DATA;

// include stuff
$inc_dir         = DOCROOT."/core/libs/controllers/";
$core_dir        = DOCROOT."/core/libs/models/";
$class_dir       = DOCROOT."/app/models/";
$controllers_dir = DOCROOT."/app/controllers/";


// inc core models
if ($files = scandir($core_dir))
{
	foreach ($files as $f)
	{
		if (strstr($f, ".class.php"))
			include_once $core_dir.$f;
	}
}
else
	die("Houve um problema ao incluir as classes do sistema. Procure o administrador do sistema.");

// inc core controllers
if ($files = scandir($inc_dir))
{
    include_once $inc_dir."app_controller.php";
	include_once $inc_dir."util_layout.php";
	include_once $inc_dir."util_general.php";
	include_once $inc_dir."util_time_date.php";
}
else
	die("Houve um problema ao incluir os arquivos do sistema. Procure o administrador do sistema.");

// inc models
if ($files = scandir($class_dir))
{
	foreach ($files as $f)
	{
		if (substr($f, -10) == ".class.php")
			include_once $class_dir.$f;
	}
}
else
	die("Houve um problema ao incluir as classes do usu&aacute;rio. Procure o administrador do sistema.");

// inc controllers
if ($files = scandir($controllers_dir))
{
	foreach ($files as $f)
	{
		if (substr($f, -4) == ".php")
			include_once $controllers_dir.$f;
	}
}
else
	die("Houve um problema ao incluir as fun&ccedil;&otilde;es do usu&aacute;rio. Procure o administrador do sistema.");

// default definitions
$dao = new DAO();

// default messages
$MSG->success = NULL;// green
$MSG->error   = NULL;// red
$MSG->alert   = NULL;// yellow
$MSG->notice  = NULL;// blues

$DATA = @$_POST['data'] ? @$_POST['data'] : FALSE;
?>
