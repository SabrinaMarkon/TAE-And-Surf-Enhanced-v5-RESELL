<?php

session_start();
include "../config.php";
include "../header.php";
include "../style.php";
include "../connect.php";

$userid = $_POST['userid'];

if( session_is_registered("alogin") ) {

if ($_POST["action"] == "save")
{
$q = "update members set commission=\"$commission\",paypal_email=\"$paypal_email\",alertpay_email=\"$alertpay_email\",safepay_email=\"$safepay_email\",moneybookers_email=\"$moneybookers_email\" where id=\"$id\"";
$r = mysql_query($q);
$show = "<p align=\"center\">Account Saved!</p>";
}
?>
<table align="center" border="0" width="100%">
<tr>
<td width="15%" valign=top><br>
<? include("adminnavigation.php"); ?>
</td>
<td valign="top" align="center"><br><br> <?
echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";
        echo "<H2>Regular Commissions Owed</H2>";
           $query = "select * from members where commission>1.00 ORDER BY commission DESC";
		$result = mysql_query ($query)
	     	or die ("Query failed");
        $numrows = @ mysql_num_rows($result);
        if ($numrows == 0) {
        	echo "<p><center>No commission payments pending.</p></center>";

        }
if ($show != "")
{
echo $show;
}
        ?>
		<br>
           <table width=90% border=1 cellpadding=2 cellspacing=0 bgcolor="<?php echo $admintablebgcolor ?>">
        	<tr>
	          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Userid</font></center></td>
              <? if ($pay_with['paypal']) { ?>
                <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Paypal email</font></center></td>
              <? } ?>
              <? if ($pay_with['alertpay']) { ?>
                <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Alertpay email</font></center></td>
              <? } ?>
              <? if ($pay_with['safepay']) { ?>
                <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Safepay email</font></center></td>
              <? } ?>
              <? if ($pay_with['moneybookers']) { ?>
                <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Moneybookers email</font></center></td>
              <? } ?>
	          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Amount</font></center></td>
              <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Save</font></center></td>

			  <? if ($pay_with['paypal']) { ?>
			  <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Paypal</font></center></td>
			  <? } ?>
			  <? if ($pay_with['alertpay']) { ?>
			  <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Alertpay</font></center></td>
			  <? } ?>
			  <? if ($pay_with['safepay']) { ?>
			  <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Safepay</font></center></td>
			  <? } ?>
			  <? if ($pay_with['moneybookers']) { ?>
			  <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Moneybookers</font></center></td>
			  <? } ?>

	        </tr>
        <?
    	while ($line = mysql_fetch_array($result)) {
			$id = $line["id"];
            $userid = $line["userid"];
            $commission = $line["commission"];
			$formattedcommission = number_format($commission, 2);
            $member_paypal_email = $line["paypal_email"];
            $member_alertpay_email = $line["alertpay_email"];
            $member_safepay_email = $line["safepay_email"];
            $member_moneybookers_email = $line["moneybookers_email"];

        ?><tr>
			<form method=POST action=commission.php>
          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><? echo $userid; ?></font></center></td>
          <? if ($pay_with['paypal']) { ?>
          	  <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><input type="text" name="paypal_email" value="<? echo $member_paypal_email; ?>" size="30"></font></center></td>
          <? } ?>
          <? if ($pay_with['alertpay']) { ?>
          	  <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><input type="text" name="alertpay_email" value="<? echo $member_alertpay_email; ?>" size="30"></font></center></td>
          <? } ?>
          <? if ($pay_with['safepay']) { ?>
          	  <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><input type="text" name="safepay_email" value="<? echo $member_safepay_email; ?>" size="30"></font></center></td>
          <? } ?>
          <? if ($pay_with['moneybookers']) { ?>
          	  <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><input type="text" name="moneybookers_email" value="<? echo $member_moneybookers_email; ?>" size="30"></font></center></td>
          <? } ?>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><input type="text" name="commission" value="<? echo $commission; ?>"></font></center></td>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
          <input type="hidden" name="userid" value="<? echo $userid; ?>">
		  <input type="hidden" name="action" value="save">
          <input type="hidden" name="id" value="<? echo $id; ?>">
          <input type="submit" value="Save">
          </center>
          </td></form> 
<? if ($pay_with['paypal']) { 
if ($member_paypal_email != "")
			{
?>
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<td bgcolor="<? echo $contrastcolour; ?>"><center>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $member_paypal_email ?>">
<input type="hidden" name="item_name" value="<? echo $sitename; ?> Pay Commission <? echo $userid; ?>">
<input type="hidden" name="amount" value="<?php echo $formattedcommission ?>">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="<? echo $domain; ?>/admin/payout.php?userid=<?php echo $userid ?>&pay=<?php echo $formattedcommission ?>">
<input type="hidden" name="cancel_return" value="<? echo $domain; ?>/admin/commission.php">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="no_note" value="1">
<input type="image" src="<?php echo $domain ?>/images/paypalsm.gif" border="0" name="submit" alt="Paypal" height="28">
</center></td>
</form>
<? 
			}
if ($member_paypal_email == "")
			{
?>
<td bgcolor="<? echo $contrastcolour; ?>" align="center"></td>
<?php
			}
} 
?>
<? if ($pay_with['alertpay']) { 
if ($member_alertpay_email != "")
			{
?>
<form method="post" action="https://secure.payza.com/checkout" >
<td bgcolor="<? echo $contrastcolour; ?>"><center>        
<input type="hidden" name="ap_purchasetype" value="item"/> 
<input type="hidden" name="ap_merchant" value="<? echo $member_alertpay_email; ?>"/> 
<input type="hidden" name="ap_currency" value="USD"/> 
<input type="hidden" name="ap_returnurl" value="<? echo $domain; ?>/admin/payout.php?userid=<?php echo $userid ?>&pay=<?php echo $formattedcommission ?>"/> 
<input type="hidden" name="ap_cancelurl" value="<? echo $domain; ?>/admin/commission.php"/> 
<input type="hidden" name="ap_itemname" value="<? echo $sitename; ?> Pay Commission <? echo $userid; ?>"/> 
<input type="hidden" name="ap_quantity" value="1"/> 
<input type="hidden" name="apc_1" value="<? echo $userid; ?>">
<input type="hidden" name="apc_2" value="<? echo $formattedcommission; ?>">
<input type="hidden" name="ap_amount" value="<? echo $formattedcommission; ?>"/> 
<input type="image" name="ap_image" src="<?php echo $domain ?>/images/payzasm.png" alt="Alertpay" height="28"/>
</center></td>
</form>
<?
			}
if ($member_alertpay_email == "")
			{
?>
<td bgcolor="<? echo $contrastcolour; ?>" align="center"></td>
<?php
			}
}
?>
<? if ($pay_with['safepay'])
{
if ($member_safepay_email != "")
			{
?>
<form action="https://www.safepaysolutions.com/index.php" method="post">
<td bgcolor="<? echo $contrastcolour; ?>"><center>
<input type="hidden" name="_ipn_act" value="_ipn_payment">
<input type="hidden" name="fid" value="49d5116c623ffa73411fcfd33227c7">
<input type="hidden" name="notifyURL" value="<? echo $domain; ?>/safepay_ipn.php">
<input type="hidden" name="returnURL" value="<? echo $domain; ?>/admin/payout.php?userid=<?php echo $userid ?>&pay=<?php echo $formattedcommission ?>">
<input type="hidden" name="cancelURL" value="<? echo $domain; ?>/admin/commission.php">
<input type="hidden" name="iowner" value="<? echo $member_safepay_email; ?>">
<input type="hidden" name="ireceiver" value="<? echo $member_safepay_email; ?>">
<input type="hidden" name="iamount" value="<? echo $formattedcommission; ?>">
<input type="hidden" name="itemName" value="<? echo $sitename; ?> Pay Commission <? echo $userid; ?>">
<input type="hidden" name="itemNum" value="">
<input type="hidden" name="idescr" value="">
<input type="hidden" name="idelivery" value="1">
<input type="hidden" name="iquantity" value="1">
<input type="hidden" name="imultiplyPurchase" value="n">
<input type="hidden" name="custom1" value="<? echo $userid; ?>">
<input type="hidden" name="custom2" value="<? echo $formattedcommission; ?>">
<input type="hidden" name="colortheme" value="">
<input type="image" src="<?php echo $domain ?>/images/safepaysm.gif" alt="Safepay" height="28">
</center></td>
</form>
<?
			}
if ($member_safepay_email == "")
			{
?>
<td bgcolor="<? echo $contrastcolour; ?>" align="center"></td>
<?php
			}
}
?>
<? if ($pay_with['moneybookers'])
{
if ($member_moneybookers_email != "")
			{
?>
<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
<td bgcolor="<? echo $contrastcolour; ?>"><center>
<input type="hidden" name="pay_to_email" value="<? echo $member_moneybookers_email; ?>">
<input type="hidden" name="return_url" value="<? echo $domain; ?>/admin/payout.php?userid=<?php echo $userid ?>">
<input type="hidden" name="cancel_url" value="<? echo $domain; ?>/admin/commission.php">
<input type="hidden" name="language" value="EN">
<input type="hidden" name="amount" value="<? echo $formattedcommission; ?>">
<input type="hidden" name="currency" value="USD">
<input type="hidden" name="merchant_fields" value="userid,itemname">
<input type="hidden" name="itemname" value="<? echo $sitename; ?> Pay Commission <? echo $userid; ?>">
<input type="hidden" name="userid" value="<? echo $userid; ?>">
<input type="hidden" name="pay" value="<? echo $formattedcommission; ?>">
<input type="hidden" name="detail1_text" value="<? echo $sitename; ?> Pay Commission <? echo $userid; ?>">
<input type="image" style="border-width: 1px; border-color: #8B8583;" src="<?php echo $domain ?>/images/moneybookerssm.gif" alt="Moneybookers" height="28">
</center></td>
</form>
<?
			}
if ($member_moneybookers_email == "")
			{
?>
<td bgcolor="<? echo $contrastcolour; ?>" align="center"></td>
<?php
			}
}
?>
</tr>
<?
        }
        echo "</table></center>" ;
        echo "</td></tr></table>";

  }
else
	echo "Unauthorised Access!";

include "../footer.php";

?>