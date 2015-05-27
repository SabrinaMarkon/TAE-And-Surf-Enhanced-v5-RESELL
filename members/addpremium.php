<?php



session_start();


include "../config.php";
include "../header.php";
include "../style.php";



$done = $_POST['done'];

$id = $_POST['id'];
$subject = $_POST['subject'];
$url = $_POST['url'];
$adbody = $_POST['adbody'];
$category = $_POST['category'];

if( session_is_registered("ulogin") ) {
?>
<SCRIPT LANGUAGE="JavaScript">
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
</script>
<?
	$limit = 100;


    include("navigation.php");

    include("../banners.php");

    echo "<font size=2 face='$fonttype' color='$fontcolour'><p><center>";

    if ($done == "YES") {
	
	

		if (empty($subject)){

       		?><p>No subject line entered. Click <a href=addpremium.php>here</a> to go back<p> <?

       		include "../footer.php";

       		exit;

    	}

		if (empty($url)){

       		?><p>No url entered. Click <a href=addpremium.php>here</a> to go back<p> <?

       		include "../footer.php";

       		exit;

    	}

		if (empty($adbody)){

       		?><p>No ad text entered. Click <a href=addpremium.php>here</a> to go back<p> <?

       		include "../footer.php";

       		exit;

    	}
		
		
    	$query = "update premiumads set subject='$subject', url='$url', adbody='".substr($adbody,0,$limit)."', added=1, approved=0, category='$category' where id=".$id;

    	$result = mysql_query ($query)

	     	or die ("Query failed");

    	?>

      		<p><center>Thank you your premium ad has been submitted to Admin for Approval. <a href="advertise.php">Click here</a> to go back.</p></center>

    	<?

    }

    else {

    	$query = "SELECT * FROM premiumads where added=0 and userid='".$_SESSION[uname]."' limit 1";

		$result = mysql_query ($query)

			or die ("Query failed");

    	while ($line = mysql_fetch_array($result)) {

            $id = $line["id"];

            $subject = $line["subject"];
			$adbody = $line["adbody"];
            $url = $line["url"];

            ?>



              <center><H2>Add your premium ad</H2>


              <form method="POST" action="addpremium.php" name="text">
			  
			  Category:<br>
			  <select name="category">
			  <?
			  $sql = mysql_query("SELECT * FROM post_categories ORDER BY name ASC");
			  while($each = mysql_fetch_array($sql)) {
				if($each['id'] == $line['category']) echo "<option value=\"".$each['id']."\" SELECTED>".$each['name']."</option>";
				else echo "<option value=\"".$each['id']."\">".$each['name']."</option>";
			  }
			  ?>
			  </select><br><br>

              Subject Line:<br>

              <input type="text" name="subject" maxlength="50"><br>

              Url:<br>

              <input type="text" name="url" maxsize="70" value="http://"><br><br>
			  
			  Ad text:<br><textarea name="adbody" cols="40" rows="5" onKeyDown="textCounter(document.text.adbody,document.text.remLen2,<? echo $limit; ?>)"
onKeyUp="textCounter(document.text.adbody,document.text.remLen2,<? echo $limit; ?>)"><? echo $adbody; ?></textarea><br>
<input readonly type="text" name="remLen2" size="4" maxlength="4" value="<? echo $limit; ?>">
characters left<br>
<span style="background-color: #FFFF00;">Limit <? echo $limit; ?> Characters Only</span>

              <input type="hidden" name="id" value="<? echo $id; ?>">

              <input type="hidden" name="done" value="YES">

			  <p><b>Please double check your premium ad, as it cannot be edited once submitted.</b></p>

              <input type="submit" value="Save">

              </form></center>

            <?

    	}

    }

    echo "</td></tr></table>";

  }

else

  { ?>



  <p>You must be logged in to access this site. Please <a href="../index.php">click here</a> to login.</p>



  <? }



include "../footer.php";

mysql_close($dblink);

?>