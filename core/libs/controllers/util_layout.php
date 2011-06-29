<?php
/*****************************
** DEFAULT LAYOUT FUNCTIONS **
*****************************/

function default_messages()
{
	global $MSG;
	global $CFG;

	if ($sizeof = sizeof($MSG->success))
	{
		for ($i=0;$i<$sizeof;$i++)
		{
			echo "<p class=\"success\">".$MSG->success[$i]."</p>";
		}
	}
	if($sizeof = sizeof($MSG->error))
	{
		for ($i=0;$i<$sizeof;$i++)
		{
			echo "<p class=\"error\">".$MSG->error[$i]."</p>";
		}
	}
	if($sizeof = sizeof($MSG->alert))
	{
		for ($i=0;$i<$sizeof;$i++)
		{
			echo "<p class=\"alert\">".$MSG->alert[$i]."</p>";
		}
	}
	if($sizeof = sizeof($MSG->notice))
	{
		for ($i=0;$i<$sizeof;$i++)
		{
			echo "<p class=\"notice\">".$MSG->notice[$i]."</p>";
		}
	}
}

function title($str=false)
{
	$title = $str ? "<title>$str - FISL</title>" : "<title>FISL</title>";
	echo $title;
	return false;
}

function head($title=NULL)
{
	global $CFG;
	title($title);
	include DOCROOT."/app/views/public/head.php";
	return FALSE;
}

function menu()
{
	global $CFG;
	include DOCROOT."/app/views/public/menu.php";
	return FALSE;
}

function footer()
{
    global $CFG;
    include DOCROOT."/app/views/public/footer.php";
    return FALSE;
}
?>
