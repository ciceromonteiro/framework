<?php
/****************************
**    GENERAL FUNCTIONS    **
*****************************/

// sanitize data
function injection($vlw)
{
	if (is_type($vlw, 'float'))
	{
		$vlw = c_float($vlw);
	}
	else if (is_type($vlw, 'date'))
	{
		$vlw = format_date($vlw, '-');
	}
	else// regular string
	{
		$vlw = htmlspecialchars(stripslashes($vlw));
        $vlw = str_ireplace("script", "blocked", $vlw);
        $vlw = mysql_escape_string($vlw);
        $vlw = trim($vlw);
	}
	return $vlw;
}

// verify different types of data via regex
function is_type($vlw, $type)
{
	$r = FALSE;
	if (is_string($vlw))
	{
		switch ($type)
		{
			case "int":
				$regex = "/^[0-9]{1,}$/";
				break;
			case "float":
				$regex = "/^([0-9]{1,3}\.?){1,}((\,[0-9]{2}){1})?$/";
				break;
			case "date":
				//$regex = "/^([0-9]{2,4}\/?\-?){2}([0-9]{2,4}\/?\-?)((\s?[0-9]{2}\:?){3})?$/";
				$regex = "/^([0-9]{2})\/?\-?([0-9]{2})\/?\-?([0-9]{4})$/";
				break;
			default:
				break;
		}
		if (preg_match($regex, $vlw))
		{
			$r = TRUE;
		}
	}
	return $r;
}

// writes a string
function __($str)
{
	echo $str;
	return false;
}

// format numbers as float values to insert into or retreive from the db
function c_float($vlw, $op=FALSE)
{
	if ($op)
	{
		return number_format($vlw, 2, ',', '.');
	}
	else if (strstr($vlw, ","))
	{
		$vlw = str_replace('.', '', $vlw);
		return str_replace(',','.', $vlw);
	}
	else if ($op && strstr($vlw, "."))
	{
		return str_replace('.',',', $vlw);
	}
	return $vlw;
}

// formats like currency value
function f_currency($vlw, $symbol=true)
{
	if ($vlw)
	{
    	return $symbol ? "$ ".number_format($vlw, 2, ',', '') : number_format($vlw, 2, ',', '');
	}
	else
	{
		return false;
	}
}

// generates urls by given models/views/params
function url($model=false, $view=false, $params=false)
{
	global $CFG;
	$page = $CFG->wwwroot;
	if ($model)
	{
		$inf = new Inflector();
		$page .= $model ? "/".$inf->pluralize($model) : "";
		$page .= $view ? "/".$view : "";
		if (!is_array($params) && $params)
		{
			$page .= "/$params";
		}
		else if ($params)
		{
			if (count($params))
			{
				foreach ($params as $k=>$v)
				{
					$page .= "/$k/$v";
				}
			}
		}
	}
	return $page;
}

// gets the country by ip addr
function get_country_from_ip($ipAddr)
{
    //function to find country and city from IP address
    //Developed by Roshan Bhattarai http://roshanbh.com.np
    //verify the IP address for the
    ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
    $ipDetail=array(); //initialize a blank array
    //get the XML result from hostip.info
    $xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);
    //get the city name inside the node <gml:name> and </gml:name>
    preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);
    //assing the city name to the array
    //$ipDetail['city']=$match[2];
    //get the country name inside the node <countryName> and </countryName>
    preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);
    //assign the country name to the $ipDetail array
    $ipDetail['country']=$matches[1];
    //get the country name inside the node <countryName> and </countryName>
    preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
    $ipDetail['country_code']=$cc_match[1]; //assing the country code to array
    //return the array containing city, country and country code
    return $ipDetail;
}

// generates an uniq numeric only ID
function UID()
{
	$r = false;
	$num = array(0,1,2,3,4,5,6,7,8,9);
	for($i=0;$i<6;$i++)
	{
		$r .= array_rand($num);
	}
	return $r;
}

// generates a really good and unique token
function uuid() {   

     // Generate 128 bit random sequence
     $randmax_bits = strlen(base_convert(mt_getrandmax(), 10, 2));  // how many bits is mt_getrandmax()
     $x = '';
     while (strlen($x) < 128) {
         $maxbits = (128 - strlen($x) < $randmax_bits) ? 128 - strlen($x) :  $randmax_bits;
         $x .= str_pad(base_convert(mt_rand(0, pow(2,$maxbits)), 10, 2), $maxbits, "0", STR_PAD_LEFT);
     }

     // break into fields
     $a = array();
     $a['time_low_part'] = substr($x, 0, 32);
     $a['time_mid'] = substr($x, 32, 16);
     $a['time_hi_and_version'] = substr($x, 48, 16);
     $a['clock_seq'] = substr($x, 64, 16);
     $a['node_part'] =  substr($x, 80, 48);
    
     // Apply bit masks for "random or pseudo-random" version per RFC
     $a['time_hi_and_version'] = substr_replace($a['time_hi_and_version'], '0100', 0, 4);
     $a['clock_seq'] = substr_replace($a['clock_seq'], '10', 0, 2);

    // Format output
    return sprintf('%s%s%s%s%s',
        str_pad(base_convert($a['time_low_part'], 2, 16), 8, "0", STR_PAD_LEFT),
        str_pad(base_convert($a['time_mid'], 2, 16), 4, "0", STR_PAD_LEFT),
        str_pad(base_convert($a['time_hi_and_version'], 2, 16), 4, "0", STR_PAD_LEFT),
        str_pad(base_convert($a['clock_seq'], 2, 16), 4, "0", STR_PAD_LEFT),
        str_pad(base_convert($a['node_part'], 2, 16), 12, "0", STR_PAD_LEFT));
}

// updates a batch of data for one object
function batch_update($obj, $arr)
{
	foreach ($arr as $k=>$v)
	{
		if (is_array($v))
		{
			echo $k." - ".$v."<br />";
		}
		$obj->set($k, $v);
	}
	return $obj;
}

// validates the uniqueness of one field
function validates_uniqueness_of($attr, $array, $class, $field_name=FALSE)
{
	global $FIELDS;
	global $MSG;
	$dao = new DAO();
	if ($dao->Retrieve($class, array($attr=>$array[$attr]), TRUE, TRUE))
	{
		$field_name = $field_name ? $field_name : $attr;
		$FIELDS[] = $attr;
		$MSG->error[] = "<strong>$field_name</strong> already registered";
	}
	return false;
}

// validates the presence of one field
function validates_presence_of($model, $view, $field_name=FALSE)
{
    global $FIELDS;
    global $MSG;
    $field_name = $field_name ? $field_name : $view;
    if (!@$_POST['data'][ucwords($model)][$view])
    {
        $FIELDS[] = ucwords($model)."_".ucwords($view);
        $MSG->error[] = "The field <strong>$field_name</strong> can't be null.";
    }
    return false;
}

// validates format of one field
function validates_format_of($model, $view, $format, $field_name=FALSE, $required=FALSE)
{
    global $FIELDS;
    global $MSG;
    $field_name = $field_name ? $field_name : $view;
    switch ($format)
    {
        case "email":
            if (!filter_var($_POST['data'][$model][$view], FILTER_VALIDATE_EMAIL) && @$_POST['data'][$model][$view])
            {
                $FIELDS[] = ucwords($model)."_".ucwords($view);
                $MSG->error[] = "The field <strong>$field_name</strong> is not a valid e-mail address.";
            }
            if ($required && !@$_POST['data'][$model][$view])
            {
				$FIELDS[] = ucwords($model)."_".ucwords($view);
                $MSG->error[] = "The field <strong>$field_name</strong> can't be null.";
            }
            break;
        default:
            break;
    }
}

// check for errors before procedure
function check_errors()
{
	global $FIELDS;
	global $ONLOAD;
	if ($sizeof = sizeof($FIELDS))
	{
		$ONLOAD = " onload=\"";
		for ($i=0;$i<$sizeof;$i++)
		{
			$ONLOAD .= "validates_presence_of('".$FIELDS[$i]."');";
		}
		$ONLOAD .= "\"";
		return true;
	}
	else
	{
		$ONLOAD = "";
	}
	return false;
}

// redirects to any page
function redirect_to($addr="")
{
    $wwwroot = WWWROOT;
    header("location:$wwwroot/$addr");
}

// authenticates user depending on the case
function auth($op=FALSE)
{
	global $CFG;
	global $MSG;
	$r = TRUE;
	switch ($op)
	{
		case "yes":// logged in
			if (!$_SESSION)
			{
                redirect_to("users/login");
			}
			break;
		case "no":// logged out
			if ($_SESSION)
			{
				redirect_to();
			}
			break;
		default:// both
			break;
	}
	return $r;
}

// transforms an object into an array
function object_2_array($obj)
{
	$obj2array = array();

	$arr_keys = $obj->get_keys();
	$obj_size = sizeof($arr_keys);

	for($i=0; $i<$obj_size; $i++){
		$obj2array[$arr_keys[$i]] = $obj->get($arr_keys[$i]);
	}

    return $obj2array;
}

?>