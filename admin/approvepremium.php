<?php

session_start();


include "../config.php";
include "../header.php";
include "../style.php";

$id = $_POST['id'];

if( session_is_registered("alogin") ) {

    	?><table>
      	<tr>
        <td width="15%" valign=top><br>
        <? include("adminnavigation.php"); ?>
        </td>
        <td  valign="top" align="center"><br><br> <?
        echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";

		
		if($_POST['submit'] == "Delete") {
		$query = "update premiumads set added=0 where id=".$id;
		$result = mysql_query ($query);
        echo "<p><center>The premium ad has been sent back to the user.</p></center>";
		} else {
		
		
		$sql = mysql_query("SELECT * FROM premiumads WHERE id=".$id);
		$info = mysql_fetch_array($sql);
		
		
        $query = "update premiumads set approved=1,expire='".(time()+$info['days']*24*60*60)."' where id=".$id;
		$result = mysql_query ($query);
        echo "<p><center>The premium ad has been approved.</p></center>";
		}
		
		
        echo "</td></tr></table>";
  }
else
	echo "Unauthorised Access!";

include "../footer.php";

?>