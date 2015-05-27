<?



include "config.php";



?>



<html>



<head><meta name="robots" content="noindex,nofollow">



<title>One-Time Offer</title>



<style>



<!--



BODY {



background-image: url(/images/bg.jpg);



background-repeat:repeat-x,y;



background-position:top;



background-attachment:fixed;



margin-top: 0px;



margin-bottom: 0px;



}



--></style>



</head>







<center>

<img src="/images/header.jpg">

<TABLE width="960px" height="400" border="1" cellpadding="10" cellspacing="10" bordercolor="#00008b" bgcolor="#FFFFFF">







  <TR bgcolor="#FFFFFF">







    <TD valign="top">







      <p align="left"><font face="Tahoma" size="3"><center>



	  <img src="<? echo $domain; ?>/images/dont.gif">



	  </center><BR><BR>



	  Thank you for confirming your email address!</font></p>











<?







		$query = "SELECT * FROM pages where name='OTO'";



		$result = mysql_query ($query)



			or die ("Query failed");



		while ($line = mysql_fetch_array($result)) {



			$htmlcode = $line["htmlcode"];



			echo $htmlcode;



		}







?>











		<p align="center"><b><font face="Tahoma" size="4" color="#008000">MAKE SURE TO CLICK RETURN TO MERCHANT (<? echo $adminname; ?>)<br></font></font></b></p>&nbsp;<P align=center>



<?



		



			$sql = mysql_query("SELECT * FROM oto LIMIT 1");



			$oto = mysql_fetch_array($sql);



?>











<center>



						 <table style="width: 80%; height: 100px" cellspacing="0" cellpadding="0" align="center">



						 <tr>







<? if($paypal<>"")
{ 
if ($oto['priceinterval'] == "onetime")
{	
?>
<td align="center">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal; ?>">
<input type="hidden" name="item_name" value="<? echo $sitename; ?> One-Time Offer">
<input type="hidden" name="item_number" value="<? echo $sitename; ?> OTO#1">
<input type="hidden" name="amount" value="<? echo $oto['price']; ?>">
<input type="hidden" name="page_style" value="PayPal">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="<? echo $domain; ?>/thank-you-alot.php">
<input type="hidden" name="cancel_return" value="<? echo $domain; ?>/">
<input type="hidden" name="cn" value="Where did you hear about us?">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="hidden" name="on0" value="User ID">
<input type="hidden" name="os0" value="<? echo $_GET['id']; ?>">
<input type="hidden" name="notify_url" value="<? echo $domain; ?>/otoipn2.php">
<input type="image" src="<? echo $domain; ?>/images/paypal.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td>
<? 
}
if ($oto['priceinterval'] != "onetime")
{
?>
<td align="center">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="<? echo $paypal; ?>">
<input type="hidden" name="item_name" value="<? echo $sitename; ?> One-Time Offer">
<input type="hidden" name="item_number" value="monthly">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="<? echo $domain; ?>/images/paypal.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="a3" value="<? echo $oto['price']; ?>">
<input type="hidden" name="return" value="<? echo $domain; ?>/members/thank-you-alot.php">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="M">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
<input type="hidden" name="on0" value="User ID">
<input type="hidden" name="os0" value="<? echo $_GET['id']; ?>">
<input type="hidden" name="notify_url" value="<? echo $domain; ?>/otoipn2.php">
</form>
</td>
<?
}
}
if ($alertpay<>"") 
{ 
if ($oto['priceinterval'] == "onetime")
	{
?>
<td align="center">
<form method="post" action="https://secure.payza.com/checkout" > 
<input type="hidden" name="ap_purchasetype" value="item"/> 
<input type="hidden" name="ap_merchant" value="<? echo $alertpay; ?>"/> 
<input type="hidden" name="ap_currency" value="USD"/> 
<input type="hidden" name="ap_returnurl" value="<? echo $domain; ?>/thank-you-alot.php"/>  
<input type="hidden" name="ap_itemname" value="<? echo $sitename; ?> One-Time Offer"/> 
<input type="hidden" name="ap_itemcode" value="<? echo $sitename; ?> OTO#1"/> 
<input type="hidden" name="ap_quantity" value="1"/> 
<input type="hidden" name="ap_amount" value="<? echo $oto['price']; ?>"/> 
<input type="hidden" name="apc_1" value="<? echo $_GET['id']; ?>"> 
<input type="image" name="ap_image" src="<?php echo $domain ?>/images/payza.png"/> 
</form>
</td>
<?
	}
if ($oto['priceinterval'] != "onetime")
	{
?>
<td align="center">
<form method="post" action="https://secure.payza.com/checkout">
<input type="hidden" name="ap_purchasetype" value="subscription"> 
<input type="hidden" name="ap_merchant" value="<? echo $alertpay; ?>">
<input type="hidden" name="ap_itemname" value="<? echo $sitename; ?> One-Time Offer">
<input type="hidden" name="ap_currency" value="USD">
<input type="hidden" name="apc_1" value="<? echo $_GET['id']; ?>">
<input type="hidden" name="ap_returnurl" value="<? echo $domain; ?>/thank-you-alot.php">
<input type="hidden" name="ap_quantity" value="1">
<input type="hidden" name="ap_amount" value="<? echo $oto['price']; ?>">
<input type="image" name="ap_image" src="<?php echo $domain ?>/images/payza.png"/> 
<input type="hidden" name="ap_timeunit" value="month">
<input type="hidden" name="ap_periodlength" value="1"> 
</form>
</td>
<?
	}
}
?>









						</tr>



						</table>







   



</center>



						</p>



						<p align="center"><font face="verdana" size="2">



						<span style="background-color: #FFFF00">**Do Not Forget To Click &quot;Return To Merchant (<? echo $adminname; ?>)&quot; After Payment**</span></p>



						</font><font face="verdana" size="2">



						</p>



						<p>If you are not interested, click the link below. <b>



						But remember - </b>you will not get another chance at 



						this offer!&nbsp; </p>



						<p><a href="<? echo $domain; ?>/memberlogin.php">No, thanks. Just 



						send me to <? echo $sitename; ?></a></font></td>



					</tr>



				</table>



			</div>



			</td>



		</tr>



	</table>



</div>



</body>



</html>



<?



mysql_close();



?>