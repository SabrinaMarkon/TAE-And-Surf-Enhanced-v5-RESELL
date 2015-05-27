<?php

session_start();

include "../config.php";
include "../header.php";
include "../style.php";

if( session_is_registered("alogin") ) {
?>
<table align="center" border="0" width="100%">
<tr>
<td width="15%" valign=top><br>
<? include("adminnavigation.php"); ?>
</td>
<td valign="top" align="center"><br><br> <?
echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";

    if ($action=="save") {

$update=mysql_query("update settings set setting='$admintablebgcolorp' where name='admintablebgcolor'");
$update1=mysql_query("update settings set setting='$sitenamep' where name='sitename'");
$update2=mysql_query("update settings set setting='$domainp' where name='domain'");
$update3=mysql_query("update settings set setting='$adminpwp' where name='adminpw'");
$update4=mysql_query("update settings set setting='$adminemailp' where name='adminemail'");
$update5=mysql_query("update settings set setting='$paypalp' where name='paypal'");
$update6=mysql_query("update settings set setting='$safepay_emailp' where name='safepay_email'");
$update7=mysql_query("update settings set setting='$safepay_passphrasep' where name='safepay_passphrase'");
$update8=mysql_query("update settings set setting='$moneybookers_emailp' where name='moneybookers_email'");
$update9=mysql_query("update settings set setting='$moneybookers_idp' where name='moneybookers_id'");
$update10=mysql_query("update settings set setting='".serialize($pay_withp)."' where name='pay_with'");
$update11=mysql_query("update settings set setting='$jvsignupp' where name='jvsignup'");
$update12=mysql_query("update settings set setting='$buttondisplayp' where name='buttondisplay'");
$update13=mysql_query("update settings set setting='$basecolourp' where name='basecolour'") ;
$update14=mysql_query("update settings set setting='$contrastcolourp' where name='contrastcolour'");
$update15=mysql_query("update settings set setting='$fonttypep' where name='fonttype'");
$update16=mysql_query("update settings set setting='$fontcolourp' where name='fontcolour'");
$update17=mysql_query("update settings set setting='$adminnamep' where name='adminname'");
$update18=mysql_query("update settings set setting='$adminaddressp' where name='adminaddress'");
$update19=mysql_query("update settings set setting='$conteststartp' where name='conteststart'");
$update20=mysql_query("update settings set setting='$alertpayp' where name='alertpay'");
$update21=mysql_query("update settings set setting='$seccodep' where name='seccode'");
$update22=mysql_query("update settings set setting='$nav_bgp' where name='nav_bg'");	
$update23=mysql_query("update settings set setting='$nav_hoverp' where name='nav_hover'");	
$update24=mysql_query("update settings set setting='$nav_textp' where name='nav_text'");	
$update25=mysql_query("update settings set setting='$drawingp' where name='drawing'");
$update26=mysql_query("update settings set setting='$drawwinnerp' where name='drawwinner'");
$update27=mysql_query("update settings set setting='$drawpricep' where name='drawprice'");
$update28=mysql_query("update settings set setting='$linkgoodp' where name='linkgood'");
$update29=mysql_query("update settings set setting='$pointratep' where name='pointrate'");
$update30=mysql_query("update settings set setting='$adminnoticep' where name='adminnotice'");
$update=mysql_query("update settings set setting='$toplevelp' where name='toplevel'");
$update=mysql_query("update settings set setting='$middlelevelp' where name='middlelevel'");
$update=mysql_query("update settings set setting='$lowerlevelp' where name='lowerlevel'");


        echo "<p><b>Your settings have been saved.</b></p>";

    }

    else {

    ?>

       <H2>Site Settings</H2>

       <p>Is is absolutely vital you set this up first before doing anything else. You can change your settings at any time you wish.</p>

       <form method="GET" action="siteprofile.php">

       <input type="hidden" name="action" value="save">

       <center>

       <hr>

       <p><b>Site settings</b></p>

       Sitename<br>

       <input type="text" name="sitenamep" value="<? echo $sitename; ?>"><br><br>

       The url to where your script is installed including http:// (no trailing '/')<br>

       <input type="text" name="domainp" value="<? echo $domain; ?>"><br><br>

Name To Call Top Level Membership<br>
<input type="text" name="toplevelp" value="<? echo $toplevel; ?>"><br><br>
Name To Call Middle Level Membership<br>
<input type="text" name="middlelevelp" value="<? echo $middlelevel; ?>"><br><br>
Name To Call Lowest Level Membership<br>
<input type="text" name="lowerlevelp" value="<? echo $lowerlevel; ?>">
<br><br>

       Admin password<br>

       <input type="text" name="adminpwp" value="<? echo $adminpw; ?>"><br><br>

       Admin name<br>

       <input type="text" name="adminnamep" value="<? echo $adminname; ?>"><br><br>

       Admin address<br>

       <input type="text" name="adminaddressp" value="<? echo $adminaddress; ?>"><br><br>

       Your contact email<br>

       <input type="text" name="adminemailp" value="<? echo $adminemail; ?>"><br><br>

       Your Primary PayPal email <br>

       <input type="text" name="paypalp" value="<? echo $paypal; ?>"> <br><br>

	   Your Alertpay email (leave blank if you do not wish to offer alertpay as a payment method)<br>

	   You must put this url as the IPN: <? echo $domain; ?>/alertpay_ipn.php<br>

       <input type="text" name="alertpayp" value="<? echo $alertpay; ?>"> <br><br>

	   Your Alertpay security code<br>

       <input type="text" name="seccodep" value="<? echo $seccode; ?>"> <br><br>

	  Your Safepay username (leave blank if you do not wish to offer safepay as a payment method)<br>

       <input type="text" name="safepay_emailp" value="<? echo $safepay_email; ?>"> <br><br>

	   

	   Your Safepay security passphrase (encrypted)<br>

       <input type="text" name="safepay_passphrasep" value="<? echo $safepay_passphrase; ?>"> <br><br>

	   Your Moneybookers email (leave blank if you do not wish to offer moneybookers as a payment method)<br>

       <input type="text" name="moneybookers_emailp" value="<? echo $moneybookers_email; ?>"> <br><br>

	   Your Moneybookers account id<br>

       <input type="text" name="moneybookers_idp" value="<? echo $moneybookers_id; ?>"> <br><br>

	 Pay members with<br>

       <input type="checkbox" name="pay_withp[paypal]" value="1"<? if($pay_with['paypal']) echo " CHECKED"; ?>> Paypal<br>

       <input type="checkbox" name="pay_withp[alertpay]" value="1"<? if($pay_with['alertpay']) echo " CHECKED"; ?>> Alertpay<br>

       <input type="checkbox" name="pay_withp[safepay]" value="1"<? if($pay_with['safepay']) echo " CHECKED"; ?>> Safepay<br>

       <input type="checkbox" name="pay_withp[moneybookers]" value="1"<? if($pay_with['moneybookers']) echo " CHECKED"; ?>> Moneybookers<br>

	<br>

	   

	   Set signups as Jv members<br>

       <input type="radio" name="jvsignupp" value="1"<? if($jvsignup) echo " CHECKED"; ?>> Yes <input type="radio" name="jvsignupp" value="0"<? if(!$jvsignup) echo " CHECKED"; ?>> No <br><br>

	   Referral Contest Date<br>

       <input type="text" name="conteststartp" value="<? echo $conteststart; ?>"><br><br>


	   Button Banner Display - How many banners should be displayed at the same time?<br> <input type="text" name="buttondisplayp" value="<? echo $buttondisplay; ?>"><br><br>

   How many days should a link in a solo ad be active?&nbsp;
      <input type="text" name="linkgoodp" value="<? echo $linkgood; ?>"> <br><br>

  Commission exchange rate<br>

       1$ = <input type="text" name="pointratep" value="<? echo $pointrate; ?>"> points<br><br>

  Notify Admin On New Signup<br>
   <input type="radio" name="adminnoticep" value="1"<? if($adminnotice) echo " CHECKED"; ?>> Yes <input type="radio" name="adminnoticep" value="0"<? if(!$adminnotice) echo " CHECKED"; ?>> No <br><br>

      <hr>

       

       <p><b>Misc settings</b></p>

       <p>If you are stuck, use basecolour #E2E2E2, contrastcolour #C0C0C0, fonttype Tahoma and fontcolour #5C5C5C.</p>

Background Colour For Admin Area Content Area<br>
<input type="text" name="admintablebgcolorp" value="<? echo $admintablebgcolor; ?>"><br><br>

       Base colour<br>

       <input type="text" name="basecolourp" value="<? echo $basecolour; ?>"><br><br>

       Contrast colour<br>

       <input type="text" name="contrastcolourp" value="<? echo $contrastcolour; ?>"><br><br>

       Font type<br>

       <input type="text" name="fonttypep" value="<? echo $fonttype; ?>"><br><br>

       Font colour<br>

       <input type="text" name="fontcolourp" value="<? echo $fontcolour; ?>"><br><br>
	   
	   Navigation background color<br>

       <input type="text" name="nav_bgp" value="<? echo $nav_bg; ?>"><br><br>
	   
	   Navigation mouseover color<br>

       <input type="text" name="nav_hoverp" value="<? echo $nav_hover; ?>"><br><br>
	   
	   Navigation "Recommended Systems" color<br>

       <input type="text" name="nav_textp" value="<? echo $nav_text; ?>"><br><br>

      	 <hr>
       
       <p><b>Misc settings</b></p>
	   Enable drawing<br>
       <input type="radio" name="drawingp" value="1"<? if($drawing==1) echo ' CHECKED'; ?>> Yes <input type="radio" name="drawingp" value="0"<? if($drawing==0) echo ' CHECKED'; ?>> No<br><br>
	   
	   Price per ticket<br>
       <input type="text" name="drawpricep" value="<? echo $drawprice; ?>"> points<br><br>
	   
 Draw Winner<br>
       <input type="text" name="drawwinnerp" value="<? echo $drawwinner; ?>"> <br><br>
	   <br>


       <input type="submit" value=" Save ">

       </form></center>

    <? }

    echo "</td><td valign=top align=center width=5%></tr></table>";

    }

else  {

	echo "Unauthorised Access!";

    }

include "../footer.php";

mysql_close($dblink);

?>