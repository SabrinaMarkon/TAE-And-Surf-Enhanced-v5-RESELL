<?php
session_start();
include "../header.php";
include "../config.php";
include "../style.php";
if(session_is_registered("ulogin"))
{
include("navigation.php");
include("../banners.php");
echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";
$query = "select * from pages where name='Full Page Login Ads'";
$result = mysql_query($query) or die(mysql_error());
while ($rowz = mysql_fetch_array($result))
{
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
}
#####################
if ($memtype == "SUPER JV")
{
$fullloginadprice = $superjvfullloginadprice;
$fullloginadpointprice = $fullloginadpointpricesuperjv;
}
if ($memtype == "JV Member")
{
$fullloginadprice = $jvfullloginadprice;
$fullloginadpointprice = $fullloginadpointpricejv;
}
if (($memtype != "SUPER JV") and ($memtype != "JV Member"))
{
$fullloginadprice = $profullloginadprice;
$fullloginadpointprice = $fullloginadpointpricepro;
}
echo "<font size=2><br><br>
<b>Full Page Login Ads show 1 time per day per member who logs in, and allows them to earn points for visiting your website.<br><br>For only <font color=#ff0000> \$".$fullloginadprice. "</font> your website receives unlimited visitors all day on the date of your choice!<br></b></font><br><br>";
#####################
if($_GET['year'] AND $_GET['month'])
{
$date =strtotime($_GET['year']."-".$_GET['month']."-01");
}
else
{
$date =time();
}
#####################
# This puts the day, month, and year in seperate variables
$day = date('d', $date) ;
if($day == date('t', $date))
{
$month = date('m', $date+2*24*60*60);
$year = date('Y', $date+2*24*60*60);
}
else
{
$month = date('m', $date) ;
$year = date('Y', $date) ;
}
# get first day of the month
$first_day = mktime(0,0,0,$month, 1, $year) ;

# month name
$title = date('F', $first_day) ; 

# what day of the week the first day of the month falls on
$day_of_week = date('D', $first_day) ;

# Once we know what day of the week it falls on, we know how many blank days occur before it. If the first day of the week is a Sunday then it would be zero
switch($day_of_week)
{
case "Sun": $blank = 0; break;
case "Mon": $blank = 1; break;
case "Tue": $blank = 2; break;
case "Wed": $blank = 3; break;
case "Thu": $blank = 4; break;
case "Fri": $blank = 5; break;
case "Sat": $blank = 6; break;
}

# Next determine how many days are in the current month
$days_in_month = cal_days_in_month(0, $month, $year) ; 

# start building the table heads
echo "<table border=1 width=\"95%\" cellpadding=5 cellspacing=0 bordercolor=#294d26>";
echo "<tr><th colspan=7>";

if($month == 1) {
$prevmonth = 12;
$prevyear = $year-1;
} else {
$prevmonth = $month-1;
$prevyear = $year;
}

if($month == 12) {
$nextmonth = 1;
$nextyear = $year+1;
} else {
$nextmonth = $month+1;
$nextyear = $year;
}

echo "<div style=\"float: left;\"><a href=\"fullloginadbuy.php?year=$prevyear&month=$prevmonth\"> 	&laquo;Previous </a></div><div style=\"float: right;\"><a href=\"fullloginadbuy.php?year=$nextyear&month=$nextmonth\"> 	Next&raquo; </a></div>";

echo "<center><font face=tahoma size=3><b> $title $year </b></font></th></tr>";
echo "<tr><td align=center><font face=tahoma size=2><b>Sunday</b></font></td><td align=center><font face=tahoma size=2><b>Monday</b></font></td><td align=center><font face=tahoma size=2><b>Tuesday</b></font></td><td align=center><font face=tahoma size=2><b>Wednesday</b></font></td><td align=center><font face=tahoma size=2><b>Thursday</b></font></td><td align=center><font face=tahoma size=2><b>Friday</b></font></td><td align=center><font face=tahoma size=2><b>Saturday</b></font></td></tr>";

# this counts the days in the week, up to 7
$day_count = 1;

echo "<tr>";
# take care of those blank days
while ( $blank > 0 )
{
echo "<td height=\"80\" width=\"80\"></td>";
$blank = $blank-1;
$day_count++;
}

# sets the first day of the month to 1
$day_num = 1;

# count up the days, untill we've done all of them in the month
while ( $day_num <= $days_in_month )
{
echo "<td height=\"80\" width=\"80\" valign=\"top\"><font face=tahoma><small><b>$day_num</b></small></font><br>";

if(strtotime($year."-".$month."-".$day_num)>= time()) {
	$sql = mysql_query("select * from fullloginads where rented='".$year."-".$month."-".$day_num."'");
	if(!@mysql_num_rows($sql)) {
echo "<center>";
		  if ($paypal<>"") { ?>
			<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="<? echo $paypal; ?>">
			<input type="hidden" name="item_name" value="<? echo $sitename; ?> Full Page Login Ad <? echo $userid; ?>">
			<input type="hidden" name="on0" value="User ID">
			<input type="hidden" name="os0" value="<? echo $userid; ?>">
			<input type="hidden" name="on1" value="Date">
			<input type="hidden" name="os1" value="<? echo $year."-".$month."-".$day_num; ?>">				
			<input type="hidden" name="amount" value="<? echo $fullloginadprice; ?>">
			<input type="hidden" name="undefined_quantity" value="1">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="return" value="<? echo $domain; ?>/members/advertise.php">
			<input type="hidden" name="cancel" value="<? echo $domain; ?>/members/advertise.php">
			<input type="hidden" name="notify_url" value="<? echo $domain; ?>/members/advertise_ipn.php">
			<input type="hidden" name="currency_code" value="USD">
			</form>
          <? }

		  if ($alertpay<>"") { ?>
			<form method="post" action="https://secure.payza.com/checkout" > 
			<input type="hidden" name="ap_purchasetype" value="item"/> 
			<input type="hidden" name="ap_merchant" value="<? echo $alertpay; ?>"/> 
			<input type="hidden" name="ap_currency" value="USD"/> 
			<input type="hidden" name="ap_returnurl" value="<? echo $domain; ?>/members/payreturn.php"/> 
			<input type="hidden" name="ap_itemname" value="<? echo $sitename; ?> Full Page Login Ad <? echo $userid; ?>"/> 
			<input type="hidden" name="ap_quantity" value="1"/> 
			<input type="hidden" name="apc_1" value="<? echo $userid; ?>">
			<input type="hidden" name="apc_2" value="<? echo $year."-".$month."-".$day_num; ?>">
			<input type="hidden" name="ap_amount" value="<? echo $fullloginadprice; ?>"/> 
			<input type="image" name="ap_image" src="<?php echo $domain ?>/images/payzasm.png" width="62"/>
			</form>
          <? }

		  if ($moneybookers_email<>"") { ?>
			<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
			<input type="hidden" name="pay_to_email" value="<? echo $moneybookers_email; ?>">
			<input type="hidden" name="status_url" value="<? echo $domain; ?>/moneybookers_ipn.php">
			<input type="hidden" name="return_url" value="<? echo $domain; ?>/members/payreturn.php">
			<input type="hidden" name="cancel_url" value="<? echo $domain; ?>/advertise.php">
			<input type="hidden" name="language" value="EN">
			<input type="hidden" name="amount" value="<? echo $fullloginadprice; ?>">
			<input type="hidden" name="currency" value="USD">
			<input type="hidden" name="merchant_fields" value="userid,itemname,rented">
			<input type="hidden" name="itemname" value="<? echo $sitename; ?> Full Page Login Ad <? echo $userid; ?>">
			<input type="hidden" name="userid" value="<? echo $userid; ?>">
			<input type="hidden" name="rented" value="<? echo $year."-".$month."-".$day_num; ?>">
			<input type="hidden" name="detail1_text" value="<? echo $sitename; ?> Solo <? echo $userid; ?>">
			<input type="image" style="border-width: 1px; border-color: #8B8583" width="82" src="http://www.moneybookers.com/images/logos/checkout_logos/checkout_120x40px.gif">
			</form>
          <? }

		  if ($safepay_email<>"") { ?>
			<form action="https://www.safepaysolutions.com/index.php" method="post">
			<input type="hidden" name="_ipn_act" value="_ipn_payment">
			<input type="hidden" name="fid" value="49d5116c623ffa73411fcfd33227c7">
			<input type="hidden" name="notifyURL" value="<? echo $domain; ?>/safepay_ipn.php">
			<input type="hidden" name="returnURL" value="<? echo $domain; ?>/members/payreturn.php">
			<input type="hidden" name="cancelURL" value="<? echo $domain; ?>/advertise.php">
			<input type="hidden" name="iowner" value="<? echo $safepay_email; ?>">
			<input type="hidden" name="ireceiver" value="<? echo $safepay_email; ?>">
			<input type="hidden" name="iamount" value="<? echo $fullloginadprice; ?>">
			<input type="hidden" name="itemName" value="<? echo $sitename; ?> Full Page Login Ad <? echo $userid; ?>">
			<input type="hidden" name="itemNum" value="">
			<input type="hidden" name="idescr" value="">
			<input type="hidden" name="idelivery" value="1">
			<input type="hidden" name="iquantity" value="1">
			<input type="hidden" name="imultiplyPurchase" value="n">
			<input type="hidden" name="custom1" value="<? echo $userid; ?>">
			<input type="hidden" name="custom2" value="<? echo $year."-".$month."-".$day_num; ?>">
			<input type="hidden" name="colortheme" value="">
			<input type="image" src="https://www.safepaysolutions.com/images/xpmt_paybutton_1.gif" alt="Pay through SafePay Solutions">
			</form>
          <? }

if (($fullloginadpointprice > 0) and ($points >= $fullloginadpointprice))
{
?>
<p><font face="Tahoma" size="2"><a href="trade.php?item=fullloginad&fullloginadpointprice=<?php echo $fullloginadpointprice ?>&rented=<? echo $year."-".$month."-".$day_num; ?>"><br>TRADE <?php echo $fullloginadpointprice ?> POINTS</a></font></p>
<?
}
	} # if(!@mysql_num_rows($sql))
}

echo "</td>";

$day_num++;
$day_count++;

# Make sure a new rows is started every week
if ($day_count > 7)
{
echo "</tr><tr>";
$day_count = 1;
}
}
?>
</tr></table>
<? 
echo "</font></td></tr></table>";
} # if(session_is_registered("ulogin"))
else
{
?>
<font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><p><b><center>You must be logged in to access this site. Please <a href="<? echo $domain; ?>/memberlogin.php">click here</a> to login.</p></b></font><center>
<?
}
include "../footer.php";
mysql_close($dblink);
?>