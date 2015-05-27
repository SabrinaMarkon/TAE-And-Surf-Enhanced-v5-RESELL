<?php
include "config.php";
if ($_GET['referid']) {
	
	if($_COOKIE['referid']!=$_GET['referid']) mysql_query("UPDATE members SET hits_unique=hits_unique+1,hits_visitor=hits_visitor+1 WHERE userid='".$_GET['referid']."'");
	else mysql_query("UPDATE members SET hits_visitor=hits_visitor+1 WHERE userid='".$_GET['referid']."'");
	
	setcookie('referid', $_GET['referid'], time()+365*24*60*60);
	setcookie('referrer', $_SERVER['HTTP_REFERER'], time()+365*24*60*60);
	header('Location: index.php');
}

include "header.php";

include "style.php";


function friendlyURL($string){
	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	return strtolower(trim($string, '-'));
}



    $count= mysql_query("select * from members WHERE verified=1");
    $rowcount = @mysql_num_rows($count);
	

    ?><font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
    </font><font face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">    
    	<p align="right">
<a href="<? echo $domain; ?>/signup.php"><font face="Tahoma" size="2" color="<? echo $fontcolour; ?>"><u>Sign up</u></font></a> - <a href="<? echo $domain; ?>/bannerstats.php"><font face="Tahoma" size="2" color="<? echo $fontcolour; ?>"><u>Banner stats</u></font></a> - <a href="<? echo $domain; ?>/memberlogin.php"><font face="Tahoma" size="2" color="<? echo $fontcolour; ?>"><u>Member login</u></font></a></b></p>
	</font><font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
   <center><?
 
 
// Top banner 
$position = "top";
include "banners.php";   
echo "[<a href=\"sponsor.php\">Advertise Here</a>]<br>";




   
  
	
	

?>


<?
	
	echo "<b>Categories:</b><table width=\"88%\"><tr>";
	$sql = mysql_query("SELECT * FROM post_categories ORDER BY name ASC");
	$i = 0;
	while($each = mysql_fetch_array($sql)) {
	
			$i++;
			if($i==4) {
			$i=1;
			echo "</tr><tr>";
			}	

		
		$count = intval(@mysql_num_rows(mysql_query("SELECT * FROM post WHERE category='".$each['id']."'"))) + intval(@mysql_num_rows(mysql_query("SELECT * FROM premiumads WHERE approved=1 AND expire>='".time()."' AND category='".$each['id']."'")));
		
	

			//echo "<td><a href=\"category.php?id=".$each['id']."\">".$each['name']."</a> (".$count.")</td>";
			echo "<td><a href=\"".$each['id']."-".friendlyURL($each['name']).".html\">".$each['name']."</a> (".$count.")</td>";


	}
	echo "</tr></table>";
	
	
$name = $sitename;
if($_COOKIE['referid']) {
	$sql = mysql_query("SELECT name FROM members WHERE userid='".$_COOKIE['referid']."'");
	if(@mysql_num_rows($sql)) $name = mysql_result($sql,0)."";
}	

    ?>
	
<br><br>	
<table width="88%" cellpadding=4 cellspacing=0 bgcolor="<? echo $table_bg; ?>" border=1>
<tr><td><b><font color="<? echo $table_color; ?>"><? echo $name; ?> Recommends</font></b></td><td width="80"><b><font color="<? echo $table_color; ?>">Counter</font></b></td></tr>
<?

$favs = getrecommended($_COOKIE['referid']);
$count=1;
foreach($favs as $each) {
	$count++;
	if($count==3) $count=1;

	if($each['user']) {
		$click = "clicku.php?user=".$each['user']."&";
		mysql_query("UPDATE builder SET fav".$each['id']."_views=fav".$each['id']."_views+1 WHERE userid='".$each['user']."'");
	} else {
		$click = "clicka.php?";
		mysql_query("UPDATE builder_fav SET views=views+1 WHERE id='".$each['id']."'");
	}
	
	
	echo "<tr class=\"line".$count."\"><td><a target=\"_blank\" href=\"".$click."id=".$each['id']."\">".$each['title']."</a></td><td>Hits: ".$each['hits']."</td></tr>";

}



?>
</table>	

<?
$sql = mysql_query("SELECT * FROM premiumads WHERE approved=1 AND expire>='".time()."'");
if(@mysql_num_rows($sql)) {
?>
<BR><BR><BR>	
<table width="88%" cellpadding=4 cellspacing=0 bgcolor="<? echo $table_bg; ?>" border=1>
<tr><td><b><font color="<? echo $table_color; ?>">Premium Ads</b> - $<? echo $premiumprice; ?> for <? echo $premiumdays; ?> days</font></td><td width="80"><b><font color="<? echo $table_color; ?>">Expiration</font></b></td></tr>
<?

$count=3;
while($each = mysql_fetch_array($sql)) {
	$count++;
	if($count==5) $count=3;

	echo "<tr class=\"line".$count."\"><td><a target=\"_blank\" href=\"clickp.php?id=".$each['id']."\">".$each['subject']."</a><br>".$each['adbody']."</td><td>".date('Y-m-d', $each['expire'])."</td></tr>";

}

mysql_query("UPDATE premiumads SET views=views+1 WHERE approved=1 AND expire>='".time()."'");


?>
</table>
<?
}
?>
<BR><BR><BR>
<table width="88%" cellpadding=4 cellspacing=0 bgcolor="<? echo $table_bg; ?>" border=1><tr><td><b><font color="<? echo $table_color; ?>">Featured <? echo $clickbk['keyword']; ?> Ads
</td></tr></table>
<table width="88%" border=1 cellpadding=0 cellspacing=0><tr><td><center>
<!-- Begin CBTopSites Ads code --> 
  <script type="text/javascript"><!--
DO_iframe_width = "88%";
DO_iframe_height = "100px";
DO_clickbank_nickname = "<? echo $clickbk['id']; ?>";
DO_horizontal_or_vertical = "h";
DO_number_of_sites_in_ad = "3";
DO_category = "";
DO_keywords = "<? echo $clickbk['keyword']; ?>";
DO_ad_border = "0";
DO_border_color = "FFFFFF";
DO_background_color = "FFFFFF";
DO_description_color = "000000";
DO_link_color = "0000FF";
DO_hover_color = "FF0000";
DO_tid = "adboard";
//-->
</script>
<script type="text/javascript" src="http://cbtopsites.com/affiliates/ads_tid.php">
</script><noscript>Enable javascript to view <a href="http://cbtopsites.com">CB Top Sites</a>
<a href="http://cbtopsites.com/affiliates/">Clickbank</a> Ads.</noscript>
 
<!-- End of CBTopSites Ads code --></center></td></tr></table>


	
<?
$sql = mysql_query("SELECT * FROM post ORDER BY posted DESC LIMIT 25");
if(@mysql_num_rows($sql)) {
?>	
<BR><BR><BR>	
<table width="88%" cellpadding=4 cellspacing=0 bgcolor="<? echo $table_bg; ?>" border=1>
<tr><td><b><font color="<? echo $table_color; ?>">Latest 25 Free Ads</font></b></td><td width="80"><b><font color="<? echo $table_color; ?>">Expiration</font></b></td></tr>
<?

$count=1;

while($each = mysql_fetch_array($sql)) {
	$count++;
	if($count==3) $count=1;

	echo "<tr class=\"line".$count."\"><td><a target=\"_blank\" href=\"click.php?id=".$each['id']."\">".$each['subject']."</a><br>".$each['adbody']."</td><td>".date('Y-m-d', $each['expire'])."</td></tr>";

}

mysql_query("UPDATE post SET views=views+1 ORDER BY posted DESC LIMIT 25");


?>
</table>
<BR><BR>
<?
}
?>

<BR>
<table width="88%" cellpadding=4 cellspacing=0 border=1><tr><td>
<!-- Begin CBTopSites.com Search Box code -->
<div align="center">
<form name="search" action="http://cbtopsites.com/search.php" method="get" target="_blank">
<a href="http://cbtopsites.com/r/<? echo $clickbk['id']; ?>">
eBooks, Software and Downloads</a>
<br>
<input type="text" name="keywords" value="" size="40" maxlength="35">
<input type="hidden" name="r" value="<? echo $clickbk['id']; ?>">
<input type="hidden" name="tid" value="adboard">
<input type="submit" value="search">
</form>
</div>
<!-- End CBTopSites.com Search Box code -->	
</td></tr></table>

<?
echo "<br><br>";

// Bottom banner 
$position = "bottom";
include "banners.php";   
echo "[<a href=\"sponsor.php\">Advertise Here</a>]<br>";


echo "<br><br>";
include "footer.php";
mysql_close($dblink);
?>