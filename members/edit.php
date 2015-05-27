<?php

session_start();

include "../header.php";
if ($userid<>"") {
	include "../configpost.php";
}
else {
    include "../config.php";
}
include "../style.php";

if( ($userid<>"")&&($password<>"") ) {

        include("navigation.php");
        include("../banners2.php");

            echo "<font size=2 face='$fonttype' color='$fontcolour'><p><center>";
	        ?>

	        <center>
            <p><font size=6>Edit My Details</font></p>
	        <form method="POST" action="editnow.php"><br>
	        First Name:<br><input type="text" name="Name" value="<? echo $name; ?>"><br>
                Last Name:<br><input type="text" name="lastname" value="<? echo $lastname; ?>"><br>
	        <input type="hidden" name="Userid" value="<? echo $userid; ?>">
	        Password:<br><input type="password" name="Password" value="<? echo $password; ?>"><br>
	        Password Verification:<br><input type="password" name="Password2" value="<? echo $password; ?>"><br>
	        Email:<br><input type="text" name="ContactEmail" value="<? echo $contact_email; ?>"><br>
            <? if ($pay_with['paypal']) { ?>
	            Paypal Email:<br><input type="text" name="PaypalEmail" value="<? echo $paypal_email; ?>"><br>
                <? } ?>
	    <? if ($pay_with['alertpay']) { ?>
	            Alertpay Email:<br><input type="text" name="AlertpayEmail" value="<? echo $alertpayemail; ?>"><br>
	            <? } ?>
	    <? if ($pay_with['safepay']) { ?>
	            Safepay Email:<br><input type="text" name="SafepayEmail" value="<? echo $safepayemail; ?>"><br>
	            <? } ?>
	    <? if ($pay_with['moneybookers']) { ?>
	            Moneybookers Email:<br><input type="text" name="MoneybookersEmail" value="<? echo $moneybookersemail; ?>"><br>
	            <? } ?>
            <br><br><br>

            <input type="hidden" name="oldemail" value="<? echo $contact_email; ?>">
	        <input type="submit" value="Update">
	        </form>
	        </center>
            <? if ($verified != 1) { ?>
            	<center><p>Your account is unverified, click this button to have your verification email resent.</p>
                <form method="POST" action="resendv.php">
                <input type="hidden" name="userid" value="<? echo $userid; ?>">
                <input type="hidden" name="email" value="<? echo $contact_email; ?>">
                <input type="submit" value="Resend">
	        	</form>
                </center>
            <? } else {?>		
			
			    <form method="POST" action="vacation.php?action=go">
                <input type="submit" value="Go on vacation">
	        	</form>
                </center>
			
	        <?
			  }
			  
         echo "</font></td></tr></table>";

	}
else
  { ?>

  <font size=3 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><p><b><center>You must be logged in to access this site. Please <a href="../index.php">click here</a> to login.</p></b></font>

  <? }

include "../footer.php";
mysql_close($dblink);
?>