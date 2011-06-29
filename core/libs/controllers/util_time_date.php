<?php
/****************************
** DATE AND TIME FUNCTIONS **
*****************************/

// gives the difference between two given dates ('Y-m-d H:m:s' format)
function diff_dates($date1, $date2, $details=false)
{
	$date1 = strtotime($date1);
	$date2 = strtotime($date2);
	//$dateDiff = $date1 > $date2 ? $date1 - $date2 : $date2 - $date1;
	$dateDiff = $date1 - $date2;
	$fullDays = floor($dateDiff/(60*60*24));
	//$dateDiff = $date1 > $date2 ? $date1 - $date2 : $date2 - $date1;
	$dateDiff = $date1 - $date2;
	$fullDays = floor($dateDiff/(60*60*24));
	if ($details)// still don't return it
	{
		$fullHours = floor(($dateDiff-($fullDays*60*60*24))/(60*60));
		$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);
	}
	return $fullDays;
}

// this little switch-case finds out the correct due date for each month
function due_date($day, $month)
{
	switch ($month)
	{
		case 2:
			$day = $day > 28 ? 28 : $day;
			break;
		case 2:
		case 4:
		case 6:
		case 9:
		case 11:
			$day = $day == 31 ? 30 : $day;
			break;
		default:
			$day = $day;
			break;
	}
	return $day;
}

// formats date to and from the database (consider revision)
function format_date($date, $sep="-", $t=true)
{
    $date = str_replace("-", "/", $date);
    $time = "";
    if (strstr($date, " "))
    {
        $date_arr = explode(" ", $date);
        $time = $t ? " ".$date_arr[1] : "";
        $date = $date_arr[0];
    }
    $new = explode("/", $date);
    return $new[2].$sep.$new[1].$sep.$new[0].$time;
    return $date;
}

// gives a mysql datetime format
function now()
{
	return date("Y-m-d H:i:s");
}

// get someone's age by a given birthdate
function get_age($date)
{
	$age = FALSE;
	if (is_type($date, 'date') && $date != "0000-00-00")
	{
		if (strstr($date, '-'))
		{
			$date = format_date($date);
		}
		$date_a = explode("/", $date);
		$dia = (int)$date_a[0];
		$mes = (int)$date_a[1];
		$ano = (int)$date_a[2];
		$dia_atual = date('d');
		$mes_atual = date('m');
		$ano_atual = date('Y');
		$age = $ano_atual - $ano;
		if ($mes_atual < $mes)
		{
			$age--;
		}
		else if ($mes_atual == $mes && $dia_atual < $dia)
		{
			$age--;
		}
	}
	return $age;
}

// writes date a date with words (consider revision)
function ext_date($date)// formato dd/mm/aaaa
{
	$r = $date;
	if ($date)
	{
		if (strstr($date, '-'))
		{
			$date = format_date($date);
		}
		if ($date_a = explode('/', $date))
		{
			$dia = $date_a[0];
			$suf = "th";
			if ($dia == 1)
			{
				$suf = "st";
			}
			else if ($dia == 2)
			{
				$suf = "nd";
			}
			else if ($dia == 3)
			{
				$suf = "rd";
			}
			$mes_num = $date_a[1];
			$meses = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$mes = $meses[(int)$mes_num];
			$ano = $date_a[2];
			$r = "$dia$suf of $mes $ano";
		}
	}
	return $r;
}
?>