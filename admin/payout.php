<?php
session_start();
include "../config.php";
include "../header.php";
include "../style.php";
if (($apc_1 != "") or ($apc_2 != ""))
{
$userid = $apc_1;
$pay = $apc_2;
}
if (($custom1 != "") or ($custom2 != ""))
{
$userid = $custom1;
$pay = $custom2;
}
?>
<table align="center" border="0" width="100%">
<tr>
<td width="15%" valign=top><br>
<? include("adminnavigation.php"); ?>
</td>
<td valign="top" align="center"><br><br> <?
echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";
$q = "select * from members where userid=\"$userid\"";
$r = mysql_query($q) or die(mysql_error());
$rows = mysql_num_rows($r);
if ($rows > 0)
	{
$q2 = "insert into regularpayouts (userid,paid,datepaid,description) values (\"$userid\",\"$pay\",NOW(),\"Regular Commission Payout\")";
$r2 = mysql_query($q2) or die(mysql_error());
$q3 = "update members set commission=0 where userid=\"$userid\"";
$r3 = mysql_query($q3) or die(mysql_error());
echo "<p><center>Payment to ".$userid." has been completed.</p></center>";
	}
echo "</td></tr></table>";
include "../footer.php";
?>