<?
session_start();
include "config.php";
$flid = $_GET['flid'];
$url = $_GET['url'];
if (($flid != "") and ($url != ""))
{
$url = $domain."/fullloginad.php?flid=".$flid."&url=".urlencode($url);
}
else
{
$url = $domain."/members/index.php";
}
?>
<html>

<head><meta name="robots" content="noindex,nofollow">

<title>Special Offer</title>

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

     

<?



		$query = "SELECT * FROM pages where name='Offer page'";

		$result = mysql_query ($query)

			or die ("Query failed");

		while ($line = mysql_fetch_array($result)) {

			$htmlcode = $line["htmlcode"];

			echo $htmlcode;

		}



?>





		<p align="center"><b><font face="Tahoma" size="4" color="#008000">MAKE SURE TO CLICK RETURN TO MERCHANT (<? echo $adminname; ?>)<br></font></font></b></p>&nbsp;<P align=center>

<?

		

			$sql = mysql_query("SELECT * FROM offerpage LIMIT 1");

			$offer = mysql_fetch_array($sql);

?>



						 <table style="width: 80%; height: 100px" cellspacing="0" cellpadding="0" align="center">

						 <tr>





<? if($paypal<>"") { ?>

<td align="center">

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_xclick">

<input type="hidden" name="business" value="<? echo $paypal; ?>">

<input type="hidden" name="item_name" value="<? echo $sitename; ?> Special Offer">

<input type="hidden" name="amount" value="<? echo $offer['price']; ?>">

<input type="hidden" name="page_style" value="PayPal">

<input type="hidden" name="no_shipping" value="1">

<input type="hidden" name="return" value="<? echo $domain; ?>/members/advertise.php">

<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="lc" value="US">

<input type="hidden" name="bn" value="PP-BuyNowBF">

<input type="hidden" name="on0" value="User ID">

<input type="hidden" name="os0" value="<? echo $userid; ?>">

<input type="hidden" name="notify_url" value="<? echo $domain; ?>/offer_ipn.php">

<input type="image" src="<? echo $domain; ?>/images/paypal.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">

</form>

</td>



  <? } ?>

  

 <?	if ($alertpay<>"") { ?>

<td align="center">

  <form method="post" action="https://secure.payza.com/checkout" > 

  <input type="hidden" name="ap_purchasetype" value="item"/> 

  <input type="hidden" name="ap_merchant" value="<? echo $alertpay; ?>"/> 

  <input type="hidden" name="ap_currency" value="USD"/>

  <input type="hidden" name="ap_returnurl" value="<? echo $domain; ?>/members/advertise.php"/>

  <input type="hidden" name="ap_itemname" value="<? echo $sitename; ?> Special Offer"/> 

  <input type="hidden" name="ap_quantity" value="1"/>

  <input type="hidden" name="ap_amount" value="<? echo $offer['price']; ?>"/> 

  <input type="hidden" name="apc_1" value="<? echo $userid; ?>">

  <input type="image" name="ap_image" src="<?php echo $domain ?>/images/payza.png"/>    

  </form>

</td>

          <? }

		  if ($moneybookers_email<>"") { ?>
<td align="center">
<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
<input type="hidden" name="pay_to_email" value="<? echo $moneybookers_email; ?>">
<input type="hidden" name="status_url" value="<? echo $domain; ?>/moneybookers_ipn.php">
<input type="hidden" name="return_url" value="<? echo $domain; ?>/members/payreturn.php">
<input type="hidden" name="cancel_url" value="<? echo $domain; ?>/advertise.php">
<input type="hidden" name="language" value="EN">
<input type="hidden" name="amount" value="<? echo $offer['price']; ?>">
<input type="hidden" name="currency" value="USD">
<input type="hidden" name="merchant_fields" value="userid,itemname">
<input type="hidden" name="itemname" value="<? echo $sitename; ?> Special Offer">
<input type="hidden" name="userid" value="<? echo $userid; ?>">
<input type="hidden" name="detail1_text" value="<? echo $sitename; ?> Special Offer">
<input type="image" style="border-width: 1px; border-color: #8B8583;" src="http://www.moneybookers.com/images/logos/checkout_logos/checkout_120x40px.gif">
</form>
</td> 

          <? }

		  if ($safepay_email<>"") { ?>
<td align="center">
<form action="https://www.safepaysolutions.com/index.php" method="post">
<input type="hidden" name="_ipn_act" value="_ipn_payment">
<input type="hidden" name="fid" value="49d5116c623ffa73411fcfd33227c7">
<input type="hidden" name="notifyURL" value="<? echo $domain; ?>/safepay_ipn.php">
<input type="hidden" name="returnURL" value="<? echo $domain; ?>/members/payreturn.php">
<input type="hidden" name="cancelURL" value="<? echo $domain; ?>/advertise.php">
<input type="hidden" name="iowner" value="<? echo $safepay_email; ?>">
<input type="hidden" name="ireceiver" value="<? echo $safepay_email; ?>">
<input type="hidden" name="iamount" value="<? echo $offer['price']; ?>">
<input type="hidden" name="itemName" value="<? echo $sitename; ?> Special Offer">
<input type="hidden" name="itemNum" value="">
<input type="hidden" name="idescr" value="">
<input type="hidden" name="idelivery" value="1">
<input type="hidden" name="iquantity" value="1">
<input type="hidden" name="imultiplyPurchase" value="n">
<input type="hidden" name="custom1" value="<? echo $userid; ?>">
<input type="hidden" name="colortheme" value="">
<input type="image" src="https://www.safepaysolutions.com/images/xpmt_paybutton_1.gif" alt="Pay through SafePay Solutions">
</form>
</td> 

          <? }

          ?>


						</tr>

						</table>

 





						</center></p>

						<p align="center"><font face="verdana" size="2">

						<span style="background-color: #FFFF00">**Do Not Forget To Click &quot;Return To Merchant (<? echo $adminname; ?>)&quot; After Payment**</span></p>

						</font><font face="verdana" size="2">

						</p>

						

						<p align="center"><b>If you are not interested, click the link below.</b></p>

						<p align="center"><a href="<?php echo $url ?>"><b>No, thanks. Just send me to <? echo $sitename; ?></a></b></font></font></td>

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

   				