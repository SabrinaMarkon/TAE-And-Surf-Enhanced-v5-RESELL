<?php
include "../header.php";
include "../config.php";
include "../style.php";
?>
<div align="center">
	<table border="0" cellpadding="5" cellspacing="5" width="658" bgcolor="#FFFFFF" height="479">
		<tr>
			<td valign="top">
			<div align="center">
				<table cellpadding="30" width="750">
					<tr>
						<td valign="top">
							<center>
							<font size=5>
							<b><font face="Verdana">Thank you for your purchase!</font></b><p>
						<font style="font-size: 14pt;" face="verdana">
						<span style="font-size: 12pt; font-family: Verdana; font-weight:700">
							Your advertising has been credited to your account!<BR><BR>
Login and click on "Advertising" to setup your ads.<BR></span></font></p>
							<p>&nbsp;</p>
							<p><b><font face="Verdana">&nbsp;<BR>Get back to the site <a href="<?php echo $domain ?>/memberlogin.php">here</a>

							
							</font></b></p>

							
							</center></td>
					</tr>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>
<?php
include "../footer.php";
mysql_close($dblink);
?>