<?php
include 'config.php';

$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

$sizeof = sizeof($requestURI);

for($i= 0;$i < $sizeof;$i++)
{
	if (@$requestURI[$i] == @$scriptName[$i] || @$requestURI[$i] == "")
	{
		unset($requestURI[$i]);
	}
}

$params = array();

$command = array_values($requestURI);

$attr = false;
if ($count = count($command))
{
    foreach ($command as $k=>$v)
    {
        if (strstr($v, '?'))// attributes via get
        {
            $arr = explode('?', $v);
            $attr = $arr[1];
            $command[$k] = $arr[0];
        }
        if ($k >= 2)
        	$params[] = $v;
    }
    if ($attr)// set $_GET values
    {
        $arr = explode('&', $attr);
        foreach ($arr as $k=>$v)
        {
            $a = explode('=', $v);
            $_GET[$a[0]] = $a[1];
        }
    }
    switch ($command[0])
    {
        case "home":
			include DOCROOT."/app/views/users/index.php";
			break;
        case "docs":
			include DOCROOT."/app/views/public/docs.php";
        	break;
        case "join":
			include DOCROOT."/app/views/users/add.php";
			break;
        case "login":
        	include DOCROOT."/app/views/users/login.php";
			break;
        case "logout":
			include DOCROOT."/app/views/users/logout.php";
        	break;
        default:// default route settings
            $page = DOCROOT."/app/views";
            $command[1] = @$command[1] ? $command[1] : "index";// view
            $page .= "/".$command[0]."/".$command[1].".php";
            if (file_exists($page))
            {
            	if (count($_SESSION))
            	{
					$_SESSION['URL'] = $command[0]."/".@$command[1];
            	}
            	else
            	{
					unset($_SESSION['URL']);
            	}
                include $page;
            }
            else
            {
                include DOCROOT."/core/libs/views/404.php";
            }
            break;
    }
}
else
{
	unset($_SESSION['URL']);
	include DOCROOT.'/app/views/public/index.php';
}

?>
