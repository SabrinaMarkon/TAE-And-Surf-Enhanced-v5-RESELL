<?php

session_start();

include "../header.php";
include "../config.php";
include "../style.php";

$userid = $_POST['userid'];
$refered = $_POST['refered'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$contactemail = $_POST['contactemail'];
$paypalemail = $_POST['paypalemail'];
$alertpay_email = $_POST['alertpay_email'];
$safepay_email = $_POST['safepay_email'];
$moneybookers_email = $_POST['moneybookers_email'];
$memtype = $_POST['memtype'];
$ip = $_POST['ip'];

if( session_is_registered("alogin") ) {
    	?><table>
      	<tr>
        <td width="15%" valign=top><br>
        <? include("adminnavigation.php"); ?>
        </td>
        <td  valign="top" align="center"><br><br> <?
    	echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";?>

    	<table width=100% border=0 cellpadding=2 cellspacing=2>
  		<tr>
          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Name</font></center></td>
          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Userid</font></center></td>
          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Contact Email</font></center></td>
          <td bgcolor="<? echo $contrastcolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Edit Member</font></center></td>
        </tr>
	<?

        $query = "select * from members where ";

        if ((bool)$userid) {
        	$query .= "userid='".$userid."'";
            $firstadded = 1;
        }
        if ((bool)$name) {
        	if ($firstadded == 1) {
            	$query .= " or " ;
            }
        	$query .= "name like'".$name."'" ;
            $firstadded = 1 ;
        }
        if ((bool)$lastname) {
        	if ($firstadded == 1) {
            	$query .= " or " ;
            }
        	$query .= "lastname like'".$lastname."'" ;
            $firstadded = 1 ;
        }
        if ((bool)$contactemail) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "contact_email='".$contactemail."'";
            $firstadded = 1;
        }
        if ((bool)$paypalemail) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "paypal_email='".$paypalemail."'";
            $firstadded = 1;
        }
       if ((bool)$alertpay_email) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "alertpay_email='".$alertpay_email."'";
            $firstadded = 1;
        }
        if ((bool)$safepay_email) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "safepay_email='".$safepay_email."'";
            $firstadded = 1;
        }
        if ((bool)$moneybookers_email) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "moneybookers_email='".$moneybookers_email."'";
            $firstadded = 1;
        }

        if ((bool)$memtype) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "memtype='".$memtype."'";
            $firstadded = 1;
        }
        if ((bool)$refered) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "referid='".$refered."'";
            $firstadded = 1;
        }
         if ((bool)$ip) {
            if ($firstadded == 1) {
            	$query .= " or ";
            }
        	$query .= "ip='".$ip."'";
            $firstadded = 1;
        }

    	$result = mysql_query ($query)
         	or die ("Search failed");

    while ($line = mysql_fetch_array($result)) {
	    $name = $line["name"];
                    $userid = $line["userid"];
	    $contactemail = $line["contact_email"];
                    $ip = $line["ip"];

		?>
  		<tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><? echo $name; ?> <? echo $lastname; ?></font></center></td>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><? echo $userid; ?></font></center></td>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>"><? echo $contactemail; ?></font></center></td>
          <td bgcolor="<? echo $basecolour; ?>" valign="middle"><center><br>
          <table>
            <tr>
              <td bgcolor="<? echo $basecolour; ?>" valign="middle"> <center>
	              <form method=POST action=edit.php>
	              <input type="hidden" name="userid" value="<? echo $userid; ?>">
	              <input type="submit" value="Edit">
	              </form></center>
              </td>
              <td bgcolor="<? echo $basecolour; ?>" valign="middle"><center>
	              <form method=POST action=deletethismember.php>
	              <input type="hidden" name="userid" value="<? echo $userid; ?>">
	              <input type="submit" value="Delete">
	              </form></center>
              </td>
            </tr>
          </table>
          </td>
        </tr>
        <?
     }
     ?>
	 </center>

     </td>
     </tr>
     </table>
	 <? echo "</td></tr></table>";
}
else
	{
	echo "Unauthorised Access!";
    }

include "../footer.php";
mysql_close($dblink);
?>