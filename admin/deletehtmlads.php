<?php

session_start();

include "../header.php";
include "../config.php";
include "../style.php";

$id = $_POST['id'];

if( session_is_registered("alogin") ) {
    	?><table>
      	<tr>
        <td width="15%" valign=top><br>
        <? include("adminnavigation.php"); ?>
        </td>
        <td valign="top" align="center"><br><br> <?
    	echo "<font size=2 face='$fonttype' color='$fontcolour'><p><b><center>";

    $query1 = "delete from post_html where id='".$id."'";
	$result1 = mysql_query ($query1)
	     or die ("Delete from 'banners' failed");

    echo "The htmlad has been deleted!";

    ?><p>Click <a href=viewallhtmlads.php>here</a> to go back<p><?
    echo "</td></tr></table>";
    }

else  {
	echo "Unauthorised Access!";
    }

include "../footer.php";
mysql_close($dblink);
?>