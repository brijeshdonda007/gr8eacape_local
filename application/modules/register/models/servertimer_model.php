<?php

class Servertimer_model extends CI_Model

{



     public function __construct()

	 	{

        

    	}

		

	function get_local_time($time="none")

			{

				$time_zone=$this->get_time_zone_setting();	

			

				$hour_delay=$time_zone[0];

				$minute_delay=$time_zone[1];

	

					if($time!='none')

						if($time_zone[2]=='+')

						{

							return date("Y-m-d H:i:s",mktime (gmdate("H")+$hour_delay,gmdate("i")+$minute_delay,gmdate("s"), gmdate("m"),gmdate("d"),gmdate("Y")));

						}

						else

							{

								return date("Y-m-d H:i:s",mktime (gmdate("H")-$hour_delay,gmdate("i")-$minute_delay,gmdate("s"), gmdate("m"),gmdate("d"),gmdate("Y")));

							}

					else

					if($time_zone[2]=='+')

						{

							return date("Y-m-d",mktime(gmdate("H")+$hour_delay,gmdate("i")+$minute_delay,gmdate("s"),gmdate("m"), gmdate("d"),gmdate("Y")));

						}

					else

						{

							return date("Y-m-d",mktime(gmdate("H")-$hour_delay,gmdate("i")-$minute_delay,gmdate("s"),gmdate("m"), gmdate("d"),gmdate("Y")));

						}

					

			}



	

function get_time_zone_setting()

{

	

			$sql="SELECT delay,sign FROM tbl_timezone WHERE status='1'";

			$query=$this->db->query($sql);

		    $record = $query->row_array();			

			$data=$record['delay'].":".$record['sign'];

			$split=explode(":",$data);

		

			return $split;

}		

		

		

		function get_local_time_clock()

		{

			$time_zone=$this->get_time_zone_setting();	

			$hour_delay=$time_zone[0];

			$minute_delay=$time_zone[1];

			$time=date("H:i:s",mktime(gmdate("H")+$hour_delay,gmdate("i")+$minute_delay,gmdate("s")));

			$piece = explode(":",$time);

			return $piece[0]*60*60+$piece[1]*60+$piece[2];

				

		}

		

function shortDateFormat($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("d M Y",$str_date);

	$tm_frmt=date("H:i:s",$str_date);

	

	return $dt_frmt.', '.$tm_frmt;

}



function change_date_formate($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("d M Y",$str_date);

	$tm_frmt=date("h:i:s a",$str_date);

	

	return $dt_frmt.', '.$tm_frmt;

}

function change_clock($date)

{

	$str_date=strtotime($date);

	return date("d M Y",$str_date);

}



function change_date_formate_without_year($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("d M",$str_date);

	$tm_frmt=date("h:i:s a",$str_date);

	

	return $dt_frmt.', '.$tm_frmt;

}



function change_date_formate_without_year_sec($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("d M",$str_date);

	$tm_frmt=date("h:i a",$str_date);

	

	return $dt_frmt.', '.$tm_frmt;

}

function dateFormateWithoutTime($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("D, dS M Y",$str_date);

		

	return $dt_frmt;

}



function dateFormateWithTime($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("D, dS M Y h:i a",$str_date);

		

	return $dt_frmt;

}

function dateFormateWithTimeSec($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("D, dS M Y h:i:s a",$str_date);

		

	return $dt_frmt;

}





function expiryDateFormat($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("dS F Y h:i:s a",$str_date);

	return $dt_frmt;

}



function changeDateFormat($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("M d, h:i a",$str_date);		

	return $dt_frmt;

}

function changeToMonthDay($date)

{

	$str_date=strtotime($date);

	$dt_frmt=date("M d",$str_date);		

	return $dt_frmt;

}

function gethour()

{

	$dt=$this->get_local_time("time");

	$str_date=strtotime($dt);	

	$hour=date("H",$str_date);

	

	return $hour;

}	





/******************MY Library**************************/

function geoCheckIP($ip)

       {

               //check, if the provided ip is valid

               if(!filter_var($ip, FILTER_VALIDATE_IP))

               {

                       throw new InvalidArgumentException("IP is not valid");

               }



               //contact ip-server

               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);

               if (empty($response))

               {

                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");

               }



               //Array containing all regex-patterns necessary to extract ip-geoinfo from page

               $patterns=array();

               $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';

               $patterns["country"] = '#Country: (.*?)&nbsp;#i';

               $patterns["state"] = '#State/Region: (.*?)<br#i';

               $patterns["town"] = '#City: (.*?)<br#i';



               //Array where results will be stored

               $ipInfo=array();



               //check response from ipserver for above patterns

               foreach ($patterns as $key => $pattern)

               {

                       //store the result in array

                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';

               }



               return $ipInfo;

       }

	

	

function getRealIpAddr()

{

    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet

    {

      $ip=$_SERVER['HTTP_CLIENT_IP'];

    }

    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy

    {

      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

    }

    else

    {

      $ip=$_SERVER['REMOTE_ADDR'];

    }

    return $ip;

}





function curPageURL() {

 $pageURL = 'http';

 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}



function encodePassword($pwd)

		{

			$temp='REVEAL';

			$new=$temp.$pwd;

			$a=md5(sha1($new));

			return $a;

		}

		



function changeIdTo7digit($id)

{

	$len=strlen($id);

	$rev_len=6-$len;

	for($i=1;$i<=$rev_len;$i++)

	{

		$added_string.='0';

	}

	return $added_string.$id;

}

function change2DigitNumeric($nVal)

{

	$len=strlen($nVal);

	$rev_len=2-$len;

	for($i=1;$i<=$rev_len;$i++)

	{

		$added_string.='0';

	}

	return $added_string.$nVal;

}

		

		

function shorten_string($string,$count)

		{

			if(strlen($string)<=$count)

				{

					return $string;

				}

			else

				{

					return substr($string,0,$count).'...';

				}

		}





}

?>