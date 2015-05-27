<?php

session_start();

include "../header.php";
include "../config.php";
include "../style.php";
if( session_is_registered("alogin") ) {


	$tbl_name="surfurls";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;

	/*
	First get total number of rows in data table.
	If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE approved=1";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];

	/* Setup vars for query. */
	$targetpage = "viewallsurfs.php"; 	//your file name  (the name of this file)
	$limit = 50; 								//how many items to show per page
	$page = $_GET['page'];
	if($page)
	$start = ($page - 1) * $limit; 			//first item to display on this page
	else
	$start = 0;								//if no page var is given, set start to 0


	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE  approved=1 LIMIT $start, $limit";
	$result = mysql_query($sql);


	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	/*
	Now we apply our rules and draw the pagination object.
	We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{





		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1)
		$pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
		else
		$pagination.= "<span class=\"disabled\">� previous</span>";

		//pages
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
				$pagination.= "<span class=\"current\">$counter</span>";
				else
				$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
					else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
					else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
					else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
			}
		}

		//next button
		if ($page < $counter - 1)
		$pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
		else
		$pagination.= "<span class=\"disabled\">next �</span>";
		$pagination.= "</div>\n";
	}




       	?><table>
      	<tr>
        <td width="15%" valign=top><br>
        <? include("adminnavigation.php"); ?>
        </td>
        <td valign="top" align="center"><br><br> <?

        echo "<font size=2 face='$fonttype' color='$fontcolour'><p><center>";
        echo "<center><p><b>";
        echo "$total_pages Active Surf pages Found";
        echo "</center></p></b>";
        mysql_close($dblink);
    ?>
<table align=center><tr><td><?=$pagination?></td></tr></table>
    <table width=70% border=0 cellpadding=2 cellspacing=2>	        <?
    $approvearray = array('No','Yes');
    while ($line = mysql_fetch_array($result)) {
    	$id = $line["id"];
    	$userid = $line["userid"];
    	$approved = $approvearray[$line["approved"]];
    	$name = $line["surfname"];
    	$credits = $line["surfpoint"];
    	$shown = $line["surfview"];
    	$surfurl = $line["surfurl"];
    	$clicks = $line["surfclicks"];
        ?><tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Userid:&nbsp;<? echo $userid; ?></font></center></td></tr> <tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Approved:&nbsp;<? echo $approved; ?></font></center></td></tr><tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Name:&nbsp;<? echo $name; ?></font></center></td></tr>
          <tr><td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">URL:&nbsp;<a href="<? echo $surfurl; ?>" target="_blank"><? echo $surfurl; ?></a></font></center></td></tr>
          <tr><td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Credit:&nbsp;<? echo $credits; ?> surf credits</font></center></td></tr>
          <tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Shown:&nbsp;<? echo $shown; ?></font></center></td></tr><tr>
          <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">Clicks:&nbsp;<? echo $clicks; ?></font></center></td></tr> 
          <form method="POST" action="deleteusersurf.php">
          <tr>
 		  <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
          <input type="hidden" name="id" value="<? echo $id; ?>">
          <input type="submit" value="Delete">
 		  <input type="hidden" name="currentpoints_<? echo $id; ?>" value="<? echo $credits; ?>">
		  <input type="hidden" name="currentuserid_<? echo $id; ?>" value="<? echo $userid; ?>">         
			 	</center>
          </td></tr>
           </form>
          <form method="POST" action="suspendsurf.php">
         <tr>
 <td bgcolor="<? echo $basecolour; ?>"><center><font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
          <input type="hidden" name="id" value="<? echo $id; ?>">
          <input type="submit" value="Suspend">
          </center>
          </td></tr>
          </form>

          </td></tr> 

<tr>
<td>&nbsp;</td>

</tr>


 <?
    }
    echo "</table></center>" ;
    echo "</td></tr></table>";
}
else
echo "Unauthorised Access!";
?>
<table align=center><tr><td><?=$pagination?></td></tr></table>
<?
include "../footer.php";

?>