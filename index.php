<?php
include "config.php";
include "header.php";
include "style.php";
 
if ($referid=="") {
 $referid="admin";
    }
    $count= mysql_query("select * from members WHERE verified=1");
    $rowcount = @mysql_num_rows($count);
    $count= mysql_query("select * from members WHERE memtype='PRO' and verified='1'");
    $prorowcount = @ mysql_num_rows($count);
    $count= mysql_query("select * from members WHERE memtype='JV Member' and verified='1'");
    $jvrowcount = @ mysql_num_rows($count);
    $count= mysql_query("select * from members WHERE memtype='SUPER JV' and verified='1'");
    $superjvrowcount = @ mysql_num_rows($count);
    ?>

<font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
    <table width=960>
<?php
###########
$hheadlinequeryexclude = "select * from hheadlineads where clicks<=max and approved=1 order by rand()";
$hheadlineresult = mysql_query($hheadlinequeryexclude);
$hheadlinerows = mysql_num_rows($hheadlineresult);
###########
$hheaderqueryexclude = "select * from hheaderads where clicks<=max and approved=1 order by rand()";
$hheaderresult = mysql_query($hheaderqueryexclude);
$hheaderrows = mysql_num_rows($hheaderresult);
###########
if (($hheadlinerows > 0) or ($hheaderrows > 0))
{
?>
<tr><td align="center" colspan="2">
<?php
include "hhiframe.php";
?>
</td></tr>
<?php
}
?>
      <tr>
        <td width=20% cellspacing="10" cellpadding="5" bordercolor="<? echo $contrastcolour; ?>" border="1" valign="top">
            <center>
            <font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
            <p>Member Count: <? echo $rowcount; ?></p>
            <p><?php echo $toplevel ?>: <? echo $superjvrowcount; ?><br>
               <?php echo $middlelevel ?>: <? echo $jvrowcount; ?><br>
               <?php echo $lowerlevel ?>: <? echo $prorowcount; ?></p>

	    	<H3><a href="<? echo $domain; ?>/memberlogin.php">Member Login</a></H3>      	
<?
############################################################################################################### FEATURED ADS - Sabrina Markon - June 2 2010
$featuredadq1 = "select * from featuredads where views<=max and approved=1 order by rand() limit $featuredadnumberofboxes";
$featuredadr1 = mysql_query($featuredadq1);
$featuredadrows1 = mysql_num_rows($featuredadr1);
if ($featuredadrows1 > 0)
{
echo "<font size=2 face='$fonttype' color='$fontcolour'><center>";
echo "<br><font face=\"Tahoma\" size=\"2\"><center><b>FEATURED ADS</b><br><br>";		
echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"$featuredadwidth\" align=\"center\">";
$topborder = 0;
while ($featuredadrowz1 = mysql_fetch_array($featuredadr1))
	{
	$featuredadid = $featuredadrowz1["id"];
	$featuredviewq = "update featuredads set views=views+1 where id=\"$featuredadid\"";
	$featuredviewr = mysql_query($featuredviewq);
	$featuredadheading = $featuredadrowz1["heading"];
	$featuredadheading = stripslashes($featuredadheading);
	$featuredadheadinghighlight = $featuredadrowz1["headinghighlight"];
	if ($featuredadheadinghighlight == "")
	{
	$featuredadheadinghighlight = $featuredadheadingbgcolor;
	}
	$featuredaddescription = $featuredadrowz1["description"];
	$featuredaddescription = stripslashes($featuredaddescription);
	$featuredaddescription = trim($featuredaddescription);
	$featuredaddescription = nl2br($featuredaddescription);
	$featuredadredircturl = "./featuredadclicks.php?id=" . $featuredadid;
	if ($topborder != 0)
	{
	$onepixeltopborder = " border-top: 0px;";
	}
	$topborder = $topborder+1;
?>
<tr><td align="center">
<div onclick="window.open('<?php echo $featuredadredircturl ?>','_blank');" id="featuredadpanetop" style="text-align: left; font-weight: bold; width: <?php echo $featuredadwidth ?>px; height: <?php echo $featuredadheightheading ?>px; background: <?php echo $featuredadheadinghighlight ?>; border: 1px solid <?php echo $featuredadheadingbordercolor ?>; border-bottom: 0px; overflow: visible; padding: 4px; color: <?php echo $featuredadheadingfontcolor ?>; font-family: '<?php echo $featuredadheadingfontface ?>'; font-size: <?php echo $featuredadheadingfontsize ?>; overflow: hidden; cursor: pointer;<?php echo $onepixeltopborder ?>">
<div id="featuredadpanetitle" style="width: <?php echo $featuredadwidth ?>px; height: <?php echo $featuredadheightheading ?>px; text-align: center; overflow: hidden; cursor: pointer;">
<?php
echo $featuredadheading;
?>
</div>
</div>
<div onclick="window.open('<?php echo $featuredadredircturl ?>','_blank');" id="featuredadpane" style="text-align: left; width: <?php echo $featuredadwidth ?>px; height: <?php echo $featuredadheight ?>px; background: <?php echo $featuredaddescbgcolor ?>; border: 1px solid <?php echo $featuredaddescbordercolor ?>; overflow: hidden; padding: 4px; color: <?php echo $featuredaddescfontcolor ?>; font-family: '<?php echo $featuredaddescfontface ?>'; font-size: <?php echo $featuredaddescfontsize ?>; text-align: center; cursor: pointer;">
<div id="featuredaddescpane" style="padding: 4px; cursor: pointer;">
<?php
echo $featuredaddescription;
?>
</div>
</div>
</td></tr>
<?php
	} # while ($featuredadrowz1 = mysql_fetch_array($featuredadr1))
if ($featuredadadsbytext != "")
{
?>
<tr><td align="center">
<div onclick="window.open('<?php echo $featuredadadsbyurl ?>','_blank');" id="featuredadadsby" style="text-align: left; font-weight: bold; width: <?php echo $featuredadwidth ?>px; height: <?php echo $featuredadadsbyheight ?>px; background: <?php echo $featuredadadsbybgcolor ?>; border: 1px solid <?php echo $featuredadadsbybordercolor ?>; overflow: hidden; padding: 4px; color: <?php echo $featuredadadsbyfontcolor ?>; font-family: '<?php echo $featuredadadsbyfontface ?>'; font-size: <?php echo $featuredadadsbyfontsize ?>; overflow: hidden; cursor: pointer; border-bottom: 1px solid  <?php echo $featuredadadsbybordercolor ?>; border-top: 0px;">
<div id="featuredadadsbytext" style="width: <?php echo $featuredadwidth ?>px; height: <?php echo $featuredadadsbyheight ?>px; text-align: center; overflow: hidden; cursor: pointer;">
<?php
echo $featuredadadsbytext;
?>
</div>
</div>
<?php
}
echo "</table><br>";
} # if ($featuredadrows1 > 0)
############################################################################################################### END FEATURED ADS - Sabrina Markon - June 2 2010

    $query1 = "SELECT * FROM pages WHERE name='Advertising Column'";
    $result1 = mysql_query ($query1);
    $line1 = mysql_fetch_array($result1);
    $htmlcode = $line1["htmlcode"];
    echo $htmlcode;

################################################################## START RECOMMENDED SYSTEMS CODE - Sabrina Oct 22 2010
$rq = "select * from recommendedsystems order by id limit 1";
$rr = mysql_query($rq);
$rrows = mysql_num_rows($rr);
if ($rrows > 0)
{
$recommendedsystems = mysql_result($rr,0,"htmlcode");
echo $recommendedsystems;
}
################################################################## END RECOMMENDED SYSTEMS CODE
?>

 </font>
			
            </center>
          </td>
	    <td width=80%><center>
<div style="text-align: center;">
<?php
$query1 = "SELECT * FROM pages WHERE name='Index (Main) Page'";
$result1 = mysql_query($query1);
$line1 = mysql_fetch_array($result1);
$htmlcode = $line1["htmlcode"];
include "banners.php";
echo $htmlcode;
?>


<!-- DELETE BELOW -->
<script type="text/javascript">
function ajaxFunction(){
    var ajaxRequest;  // The variable that makes Ajax possible!
   
    try{
        // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e){
        // Internet Explorer Browsers
        try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                // Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            var ajaxDisplay = document.getElementById('ajaxDiv');
            ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
    }
    var order_domain_name = document.getElementById('order_domain_name').value;
    var order_domain_extension = document.getElementById('order_domain_extension').value;
   
    var queryString = "?order_domain_name=" + order_domain_name + "&order_domain_extension=" + order_domain_extension;
    ajaxRequest.open("GET", "script_domain_checker.php" + queryString, true);
    ajaxRequest.send(null);
}

/***********************************************
* Dynamic Ajax Content- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}
</script>
<br>
<div style="color:#000;font-size:24px;font-weight:bold;">The <font color="#ff0000">FREE</font> Enhanced Advertise & Surf TAE<br>(Text Ad Exchange) v5.9 Script!!</div>
<br>
<div style="color:#f00;font-size:24px;font-weight:bold;">THIS SCRIPT IS FREE!!! AND COMES WITH RESELL RIGHTS!!!</div>
<br><br>
<a href="http://demotaeenhancedv5.phpsitescripts.com/admin" target="_blank"><img src="http://phpsitescripts.com/images/demo.png" border="0"></a>
<br><br><br>
Please check out our interactive DEMO of the Enhanced Advertise & Surf TAE (Text Ad Exchange) v5.9 Script as an admin <a href="http://demotaeenhancedv5.phpsitescripts.com/admin" target="_blank">HERE</a> (admin login details are already in the login form for you). <br><br>Examine our DEMO site as a member <a href="http://demotaeenhancedv5.phpsitescripts.com/memberlogin.php" target="_blank">HERE</a> (demo member details are already in the login form)</b><br><br>
<div style="text-align:left;padding-left:100px;">SCRIPT REQUIREMENTS:<br>
<ul>
<li>Unix/Linux (CentOS most CPanel servers run is good)</li>
<li>PHP 5.2 or Greater Version</li>
<li>MySQL Database Support</li>
<li>Ioncube Loader</li>
<li>GD Library</li>
<li>cURL</li>
</ul>
</div>
<br><br>
<table cellpadding="10" cellspacing="2" border="0" align="center" width="600" style="border:2px dashed #f00;background:#fff;">
<tr><td colspan="2" align="center"><br><font size="6" color="ff0000">Download This Enhanced Advertise & Surf TAE (Text Ad Exchange) v5.9 Script Now for <font color="#ff0000">FREE!!!</font></td</tr>
<form action="http://phpsitescripts.com/sales_order.php" method="post">
<tr><td align="right">Licence:</td><td>Unlimited Multiple Site License with Resell Rights for Enhanced Advertise & Surf TAE (Text Ad Exchange) v5.9 Script</td></tr>
<tr><td align="right">URL of Premade Site you want to adopt:<br>(or leave blank)</td><td valign="top"><input type="text" name="order_premadesiteurl" size="50" maxlength="500"></td></tr>
<tr><td align="right">Register Domain for your site's License URL:<br>(or leave blank)</td><td style="width:350px;" valign="top"><input type="text" name="order_domain_name" id="order_domain_name" size="25" maxlength="500" style="font-size:12px;">
<select name="order_domain_extension" id="order_domain_extension" onchange="javascript:document.getElementById('ajaxDiv').innerHTML=''" style="font-size:12px;">
<option value="info">.info - FREE FOREVER!</option>
<option value="com">.com - 8.00/year</option>
<option value="us">.us - 8.00/year</option>
<option value="net">.net - 8.00/year</option>
<option value="biz">.biz - 8.00/year</option>
<option value="org">.org - 8.00/year</option>
<option value="me">.me - 8.00/year</option>
<option value="ws">.ws - 8.00/year</option>
<option value="co">.co - 8.00/year</option>
<option value="ca">.ca - 8.00/year</option>
</select>
<input type="button" value="Check Availability (may take a moment)" onclick="ajaxFunction()" style="font-size:12px;"><br><span id="ajaxDiv"></span>
<span id="domain_price"></span>
</td></tr>
<tr><td align="right">License Key URL:<br>(exact url where you will install the script. If registering a new domain, this should match the url in that field)</td><td valign="top"><input type="text" name="order_licenseurl" size="50" maxlength="500"></td></tr>

<tr><td align="right">Order Hosting for your Script:<br>(kindly allow time for setup after purchase)</td><td valign="top">
<select name="order_hosting" style="font-size:12px;width:322px;">
<option value="No Hosting Needed (zipped script or premade site only)">No Hosting Needed (zipped script or premade site only)</option>
<option value="Shared Hosting for ONE domain - adds 9.99/month to order">Shared Hosting for ONE domain - adds 9.99/month to order</option>
<option value="Dedicated VPS Hosting 4 GB RAM - adds 99.99/month to order">Dedicated VPS Hosting 4 GB RAM - adds 99.99/month to order</option>
</select>
</td></tr>

<tr><td align="right">UserID:</td><td><input type="text" name="userid" size="50" maxlength="255"></td></tr>
<tr><td align="right">Password:</td><td><input type="text" name="password" size="50" maxlength="255"></td></tr>
<tr><td align="right">First Name:</td><td><input type="text" name="firstname" size="50" maxlength="255"></td></tr>
<tr><td align="right">Last Name:</td><td><input type="text" name="lastname" size="50" maxlength="255"></td></tr>
<tr><td align="right">Email:</td><td><input type="text" name="email" size="50" maxlength="255"></td></tr>
<?php
$cq = "select * from countries order by country_id";
$cr = mysql_query($cq);
$crows = mysql_num_rows($cr);
if ($crows > 0)
{
?>
<tr><td align="right">Country:</td><td><select name="country" style="width:322px;" class="pickone">
<?php
	while ($crowz = mysql_fetch_array($cr))
	{
	$country_name = $crowz["country_name"];
?>
<option value="<?php echo $country_name ?>" <?php if ($country_name == "United States") { echo "selected"; } ?>><?php echo $country_name ?></option>
<?php
	}
?>
</select>
</td></tr>
<?php
}
?>
<tr><td align="right">Your Sponsor:</td><td><?php echo $referid ?></td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" name="order_script" value="textadexchange_enhanced_v5.9">
<input type="hidden" name="referid" value="<?php echo $referid ?>">
<input type="image" src="http://phpsitescripts.com/images/downloadnow.jpg" border="0" name="submit" alt="Order!">
</form><br>&nbsp;
</td></tr>
</table>

<br>
<font color="#ff0000" style="background:#ff0;">IMPORTANT:</font> After payment please allow us up to 24 hours to process your order. Please whitelist sabrina@phpsitescripts.com.
<!-- DELETE ABOVE -->






</div> 
<center><table width="73%">
      <tr>
     <td width="89%">
  <p align="center">
        <br>
        </p>
  <center>
  
  <? if(!$jvsignup) { ?>
 

   <table cellspacing="0" cellpadding="5" bordercolor="#000000" border="4" bgcolor="#d3d3d3" width="600">
          <tr>
            <td bgcolor="#eeeeee" align="center">
			
            	            	<font size=2 color="#000000">
               <H3 align="center"><font size="4"><?php echo $toplevel ?></font></H3>
				
               <p align="left">
                   <?
 
                  if ($superjvpoints<>0) {
                  echo "<p>".$superjvpoints." points on joining</p>";
                                   }
                if ($superjvreadearn<>0) {
                     echo "<p>".$superjvreadearn." points for every text ad read</p>";
                                   }
                               if ($superjvhtmlearn<>0) {
                     echo "<p>".$superjvhtmlearn." points for every html ad read</p>";
                                   }
                               if ($superjvbannerclick<>0) {
                     echo "<p>".$superjvbannerclick." points for every banner clicked</p>";
                                   }
                               if ($superjvbuttonclickearn<>0) {
                     echo "<p>".$superjvbuttonclickearn." points for every button banner clicked</p>";
                                   }
                               if ($superjvhotlinkearn<>0) {
                     echo "<p>".$superjvhotlinkearn." points for every hotlink ad clicked</p>";
                                   }
                               if ($superjvptcearn<>0) {
                     echo "<p>".$superjvptcearn." commissions for every paid to click ad read</p>";
                                   }
                                if ($superjvtrafficearn<>0) {
                     echo "<p>".$superjvtrafficearn." points for every traffic link clicked</p>";
                                   }
                                if ($superjvtopnavearn<>0) {
                     echo "<p>".$superjvtopnavearn." points for every top navigation link clicked</p>";
                                  }
                                if ($superjvbotnavearn<>0) {
                     echo "<p>".$superjvbotnavearn." points for every bottom navigation link clicked</p>";
                                  }
                                if ($superjvclickearn<>0) {
                     echo "<p>".$superjvclickearn." points for every solo ad click</p>";
                                  }
                                if ($adminsuperjvclickearn<>0) {
                     echo "<p>".$adminsuperjvclickearn." points for every admin ad clicked</p>";
                                  }
                                
                               if ($superjvpost<>0) {
                     echo "<p>Post ".$superjvpost." text ads per day</p>";
                                  }
                              if ($superjvposthtml<>0) {
                     echo "<p>Post ".$superjvposthtml." html ads per day</p>";
                                  }
                               if ($superjvsave<>0) {
                     echo "<p>Save ".$superjvsave." text ads</p>";
                                  }
                               if ($superjvsavehtml<>0) {
                     echo "<p>Save ".$superjvsavehtml." html ads</p>";
                                  }
                              if ($superjvsavesolos<>0) {
                     echo "<p>Save ".$superjvsavesolos." solo ads</p>";
                                  }
                              if ($superjvurls<>0) {
                     echo "<p>Have ".$superjvurls." links in the Viral Link Cloaker</p>";
                                 }
                             if ($superjvrefpoints<>0) {
                  echo "<p>".$superjvrefpoints." points for every referral</p>";
                                 }
                               if ($superjvreflogin<>0) {
                  echo "<p>".$superjvreflogin." points when a referral logs in</p>";
                                 }
                                  if ($superjvpercent<>0) {
                  echo "<p>When a referral earns points you earn ".$superjvpercent." percent in points</p>";
                                 }
                                if ($superjvbuycom<>0) {
                  echo "<p>When a referral purchases advertising you earn ".$superjvbuycom." percent in commissions</p>";
                                }
                if ($superjvcommission<>0) {                                                      echo "<p>$".$superjvcommission." for every pro member referred";
                                }
                             if ($superjvjvcom<>0) {                                                                                               echo "<p>$".$superjvjvcom." for every JV Member referred";
                               }
                            if ($superjv2supercom<>0) {                                                      echo "<p>$".$superjv2supercom." for every SUPER JV Member referred";
                              }
                              ?>
 
               <p>Price: <b>$<? echo $superjvprice; ?> <? echo $superjvinterval; ?></b></p>
               </font>
 
 
 
    <b>Sign Up Free <?php echo $lowerlevel ?>, Then Upgrade Inside!</b><BR>
 
              </center>
 
            </td>
          </tr>
        </table>
        <br><br>
 
   <table cellspacing="0" cellpadding="5" bordercolor="#000000" border="4" bgcolor="#d3d3d3" width="600">
          <tr>
            <td bgcolor="#eeeeee" align="center">
               <center>
			
            	            	<font size=2 color="#000000">
               <H3 align="center"><font size="4"><?php echo $middlelevel ?></font></H3>
				
               <p align="left">
                <?
 
                if ($jvpoints<>0) {
                  echo "<p>".$jvpoints." points on joining</p>";
                                   }
                if ($jvreadearn<>0) {
                     echo "<p>".$jvreadearn." points for every text ad read</p>";
                                   }
                               if ($jvhtmlearn<>0) {
                     echo "<p>".$jvhtmlearn." points for every html ad read</p>";
                                   }
                               if ($jvbannerearn<>0) {
                     echo "<p>".$jvbannerearn." points for every banner clicked</p>";
                                   }
                               if ($jvbuttonclickearn<>0) {
                     echo "<p>".$jvbuttonclickearn." points for every button banner clicked</p>";
                                   }
                               if ($jvhotlinkearn<>0) {
                     echo "<p>".$jvhotlinkearn." points for every hotlink ad clicked</p>";
                                   }
                               if ($jvptcearn<>0) {
                     echo "<p>".$jvptcearn." commissions for every paid to click ad read</p>";
                                   }
                                if ($jvtrafficearn<>0) {
                     echo "<p>".$jvtrafficearn." points for every traffic link clicked</p>";
                                   }
                                if ($jvtopnavearn<>0) {
                     echo "<p>".$jvtopnavearn." points for every top navigation link clicked</p>";
                                  }
                                if ($jvbotnavearn<>0) {
                     echo "<p>".$jvbotnavearn." points for every bottom navigation link clicked</p>";
                                  }
                                if ($jvclickearn<>0) {
                     echo "<p>".$jvclickearn." points for every solo ad click</p>";
                                  }
                                if ($adminjvclickearn<>0) {
                     echo "<p>".$adminjvclickearn." points for every admin ad clicked</p>";
                                  }
                              
                               if ($jvpost<>0) {
                     echo "<p>Post ".$jvpost." text ads per day</p>";
                                  }
                               if ($jvposthtml<>0) {
                     echo "<p>Post ".$jvposthtml." html ads per day</p>";
                                  }
                               if ($jvsave<>0) {
                     echo "<p>Save ".$jvsave." text ads</p>";
                                  }
                               if ($jvsavehtml<>0) {
                     echo "<p>Save ".$jvsavehtml." html ads</p>";
                                  }
                               if ($jvsavesolos<>0) {
                     echo "<p>Save ".$jvsavesolos." solo ads</p>";
                                  }
                               if ($jvurls<>0) {
                     echo "<p>Have ".$jvurls." links in the Viral Link Cloaker</p>";
                                 }
                               if ($jvrefpoints<>0) {
                  echo "<p>".$jvrefpoints." points for every referral</p>";
                                 }
                               if ($jvreflogin<>0) {
                  echo "<p>".$jvreflogin." points when a referral logs in</p>";
                                 }
                                if ($jvpercent<>0) {
                  echo "<p>When a referral earns points you earn ".$jvpercent." percent in points</p>";
                                 }
                                if ($jvbuycom<>0) {
                  echo "<p>When a referral purchases advertising you earn ".$jvbuycom." percent in commissions</p>";
                                }
                if ($jvcommission<>0) {                                                      echo "<p>$".$jvcommission." for every pro member referred";
                                }
                             if ($jvjvcom<>0) {                                                                                               echo "<p>$".$jvjvcom." for every JV Member referred";
                               }
                            if ($jvsupercom<>0) {                                                      echo "<p>$".$jvsupercom." for every SUPER JV Member referred";
                              }
                         
    ?> 
<p>Price: <b>$<? echo $jvprice; ?> <? echo $jvinterval; ?></b></p>
               </font>
 
 
 
    <b>Sign Up Free <?php echo $lowerlevel ?>, Then Upgrade Inside!</b><BR>
 

               </center>
            </td>
          </tr>
        </table>
        <br><br>
 
   <table cellspacing="0" cellpadding="5" bordercolor="#000000" border="4" bgcolor="#d3d3d3" width="600">
          <tr>
            <td bgcolor="#eeeeee" align="center">
               <center>
               <font size="2" face="tahoma" color="#000000">
               <H3 align="center"><font size="4"><?php echo $lowerlevel ?></font></H3>


                <?
 
                if ($propoints<>0) {
                  echo "<p>".$propoints." points on joining</p>";
                                   }
                if ($proreadearn<>0) {
                     echo "<p>".$proreadearn." points for every text ad read</p>";
                                   }
                               if ($prohtmlearn<>0) {
                     echo "<p>".$prohtmlearn." points for every html ad read</p>";
                                   }
                               if ($probannerearn<>0) {
                     echo "<p>".$probannerearn." points for every banner clicked</p>";
                                   }
                               if ($probuttonclickearn<>0) {
                     echo "<p>".$probuttonclickearn." points for every button banner clicked</p>";
                                   }
                               if ($prohotlinkearn<>0) {
                     echo "<p>".$prohotlinkearn." points for every hotlink ad clicked</p>";
                                   }
                               if ($proptcearn<>0) {
                     echo "<p>".$proptcearn." commissions for every paid to click ad read</p>";
                                   }
                                if ($protrafficearn<>0) {
                     echo "<p>".$protrafficearn." points for every traffic link clicked</p>";
                                   }
                                if ($protopnavearn<>0) {
                     echo "<p>".$protopnavearn." points for every top navigation link clicked</p>";
                                  }
                                if ($probotnavearn<>0) {
                     echo "<p>".$probotnavearn." points for every bottom navigation link clicked</p>";
                                  }
                                if ($proclickearn<>0) {
                     echo "<p>".$proclickearn." points for every solo ad click</p>";
                                  }
                                if ($adminproclickearn<>0) {
                     echo "<p>".$adminproclickearn." points for every admin ad clicked</p>";
                                  }
                                if ($propost<>0) {
                     echo "<p>Post ".$propost." text ads per day</p>";
                                  }
                               if ($proposthtml<>0) {
                     echo "<p>Post ".$proposthtml." html ads per day</p>";
                                  }
                               if ($prosave<>0) {
                     echo "<p>Save ".$prosave." text ads</p>";
                                  }
                               if ($prosavehtml<>0) {
                     echo "<p>Save ".$prosavehtml." html ads</p>";
                                  }
                               if ($prosavesolos<>0) {
                     echo "<p>Save ".$prosavesolos." solo ads</p>";
                                  }
                               if ($prourls<>0) {
                     echo "<p>Have ".$prourls." links in the Viral Link Cloaker</p>";
                                 }
                               if ($prorefpoints<>0) {
                  echo "<p>".$prorefpoints." points for every referral</p>";
                                 }
                               if ($proreflogin<>0) {
                  echo "<p>".$proreflogin." points when a referral logs in</p>";
                                 }
                                if ($propercent<>0) {
                  echo "<p>When a referral earns points you earn ".$propercent." percent in points</p>";
                                 }
                                if ($probuycom<>0) {
                  echo "<p>When a referral purchases advertising you earn ".$probuycom." percent in commissions</p>";
                                }
                if ($procommission<>0) {                                                      echo "<p>$".$procommission." for every pro member referred";
                                }
                             if ($projvcom<>0) {                                                                                               echo "<p>$".$projvcom." for every JV Member referred";
                               }
                            if ($prosupercom<>0) {                                                      echo "<p>$".$prosupercom." for every SUPER JV Member referred";
                              }
                           ?>                      
               <p align="center">Price: <b>FREE</b></p>
                   </font>
               <font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
                 <form method="POST" action="join.php">
<input type="hidden" name="referrer" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                 <p align="center">
                 <br><br>
                 <b><?php echo $lowerlevel ?> Members Signup</b>
                 <br><br>Username (no spaces):<br>
                 <input type="text" size="25" name="new_userid">
                 <br>Password:<br>
                 <input type="text" size="25" value name="new_password">
                 <br>Retype Password:<br>
                 <input type="text" size="25" value name="new_passwordv">
                <br>First Name:(required)<br>
                 <input type="text" size="25" name="new_fullname">
                                 <br>Last Name:(required)<br>
                 <input type="text" size="25" name="new_lastname">
                 <br>Email:<br>
                 <input type="text" size="25" name="new_contact">
                 <br>
          </font>
                 </p>
                   </font>
    <center>
               <font size="2" color="<? echo $fontcolour; ?>">
               
          <p><font size="2" color="<? echo $fontcolour; ?>">Member Type:&nbsp;<b><?php echo $lowerlevel ?></b></p>
                   </font>
 
 <p>
 
 <font size="2" color="<? echo $fontcolour; ?>">
 
                 <input type="checkbox" name="terms" value=1> By joining you agree to receive emails from <? echo $sitename; ?>.  You are also agreeing to the rest of our 
 
    <a href="<? echo $domain; ?>/terms.php" target=_blank">
 
     <font color="#000000"><u>Terms and Conditions</u></font></a>. You can view the list of banned emails <a href="<? echo $domain; ?>/bannedlist.php" target=_blank">
 
 
 
     <font color="#000000"><u>here</u></font></a>.</center>
 
                   </font>   
 

               <font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
 
 <br>
                                     
 
                 <p>
                         <input type="hidden" size="25" name="referid" value="<? echo $referid; ?>">
                        <input type="hidden" name="mtY" value="PRO">
                 <input type="submit" value="Create Account">
                                </form></font></p>
                   </font>
                      </td>
          </tr>
        </table><br><br>
 

<?
 
 } else {
 
?>
 
 
 
<table cellspacing="2" width="600" cellpadding="10" bordercolor="<? echo $fontcolour; ?>" border="2">
          <tr>
            <td bgcolor="#eeeeee" align="center">
   
             <font size=2 face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
                <br>
               </font>
             <font size=2 color="<? echo $fontcolour; ?>">
               <H3 align="center"><font size="4"><?php echo $toplevel ?></font></H3>
    <br><b><span style="background-color: #FFFF00">
    </span></b>
    <font color="#000000" size="2"><b>
    <span style="background-color: #FFFF00"></span>
               </b></font>
               <center><font size="2" color="000000">
                      <?
 
 
 
                 if ($superjvpoints<>0) {
                  echo "<p>".$superjvpoints." points on joining</p>";
                                   }
                if ($superjvreadearn<>0) {
                     echo "<p>".$superjvreadearn." points for every text ad read</p>";
                                   }
                               if ($superjvhtmlearn<>0) {
                     echo "<p>".$superjvhtmlearn." points for every html ad read</p>";
                                   }
                               if ($superjvbannerclick<>0) {
                     echo "<p>".$superjvbannerclick." points for every banner clicked</p>";
                                   }
                               if ($superjvbuttonclickearn<>0) {
                     echo "<p>".$superjvbuttonclickearn." points for every button banner clicked</p>";
                                   }
                               if ($superjvhotlinkearn<>0) {
                     echo "<p>".$superjvhotlinkearn." points for every hotlink ad clicked</p>";
                                   }
                               if ($superjvptcearn<>0) {
                     echo "<p>".$superjvptcearn." commissions for every paid to click ad read</p>";
                                   }
                                if ($superjvtrafficearn<>0) {
                     echo "<p>".$superjvtrafficearn." points for every traffic link clicked</p>";
                                   }
                                if ($superjvtopnavearn<>0) {
                     echo "<p>".$superjvtopnavearn." points for every top navigation link clicked</p>";
                                  }
                                if ($superjvbotnavearn<>0) {
                     echo "<p>".$superjvbotnavearn." points for every bottom navigation link clicked</p>";
                                  }
                                if ($superjvclickearn<>0) {
                     echo "<p>".$superjvclickearn." points for every solo ad click</p>";
                                  }
                                if ($adminsuperjvclickearn<>0) {
                     echo "<p>".$adminsuperjvclickearn." points for every admin ad clicked</p>";
                                  }
                                
                               if ($superjvpost<>0) {
                     echo "<p>Post ".$superjvpost." text ads per day</p>";
                                  }
                              if ($superjvposthtml<>0) {
                     echo "<p>Post ".$superjvposthtml." html ads per day</p>";
                                  }
                               if ($superjvsave<>0) {
                     echo "<p>Save ".$superjvsave." text ads</p>";
                                  }
                               if ($superjvsavehtml<>0) {
                     echo "<p>Save ".$superjvsavehtml." html ads</p>";
                                  }
                              if ($superjvsavesolos<>0) {
                     echo "<p>Save ".$superjvsavesolos." solo ads</p>";
                                  }
                              if ($superjvurls<>0) {
                     echo "<p>Have ".$superjvurls." links in the Viral Link Cloaker</p>";
                                 }
                             if ($superjvrefpoints<>0) {
                  echo "<p>".$superjvrefpoints." points for every referral</p>";
                                 }
                               if ($superjvreflogin<>0) {
                  echo "<p>".$superjvreflogin." points when a referral logs in</p>";
                                 }
                                  if ($superjvpercent<>0) {
                  echo "<p>When a referral earns points you earn ".$superjvpercent." percent in points</p>";
                                 }
                                if ($superjvbuycom<>0) {
                  echo "<p>When a referral purchases advertising you earn ".$superjvbuycom." percent in commissions</p>";
                                }
                if ($superjvcommission<>0) {                                                      echo "<p>$".$superjvcommission." for every pro member referred";
                                }
                             if ($superjvjvcom<>0) {                                                                                               echo "<p>$".$superjvjvcom." for every JV Member referred";
                               }
                            if ($superjv2supercom<>0) {                                                      echo "<p>$".$superjv2supercom." for every SUPER JV Member referred";
                              }
                              ?>
 
               <p>Price: <b>$<? echo $superjvprice; ?> <? echo $superjvinterval; ?></b></p>
               </font>
 
 
 
    <b>Sign Up Free <?php echo $middlelevel ?>, Then Upgrade Inside!</b><BR>
 
 
 
               </center>
 
            </td>
          </tr>
        </table>
<br><br>
         
 
        <table cellspacing="2" cellpadding="10" width="600" bordercolor="<? echo $fontcolour; ?>" border="2">
          <tr>
            <td bgcolor="#eeeeee" align="center">
               <font size="2" color="<? echo $fontcolour; ?>">
               <H3 align="center"><font size="4"><?php echo $middlelevel ?></font></H3>
<center><font size="2" color="000000">
                <?
 
                if ($jvpoints<>0) {
                  echo "<p>".$jvpoints." points on joining</p>";
                                   }
                if ($jvreadearn<>0) {
                     echo "<p>".$jvreadearn." points for every text ad read</p>";
                                   }
                               if ($jvhtmlearn<>0) {
                     echo "<p>".$jvhtmlearn." points for every html ad read</p>";
                                   }
                               if ($jvbannerearn<>0) {
                     echo "<p>".$jvbannerearn." points for every banner clicked</p>";
                                   }
                               if ($jvbuttonclickearn<>0) {
                     echo "<p>".$jvbuttonclickearn." points for every button banner clicked</p>";
                                   }
                               if ($jvhotlinkearn<>0) {
                     echo "<p>".$jvhotlinkearn." points for every hotlink ad clicked</p>";
                                   }
                               if ($jvptcearn<>0) {
                     echo "<p>".$jvptcearn." commissions for every paid to click ad read</p>";
                                   }
                                if ($jvtrafficearn<>0) {
                     echo "<p>".$jvtrafficearn." points for every traffic link clicked</p>";
                                   }
                                if ($jvtopnavearn<>0) {
                     echo "<p>".$jvtopnavearn." points for every top navigation link clicked</p>";
                                  }
                                if ($jvbotnavearn<>0) {
                     echo "<p>".$jvbotnavearn." points for every bottom navigation link clicked</p>";
                                  }
                                if ($jvclickearn<>0) {
                     echo "<p>".$jvclickearn." points for every solo ad click</p>";
                                  }
                                if ($adminjvclickearn<>0) {
                     echo "<p>".$adminjvclickearn." points for every admin ad clicked</p>";
                                  }
                               
                               if ($jvpost<>0) {
                     echo "<p>Post ".$jvpost." text ads per day</p>";
                                  }
                               if ($jvposthtml<>0) {
                     echo "<p>Post ".$jvposthtml." html ads per day</p>";
                                  }
                               if ($jvsave<>0) {
                     echo "<p>Save ".$jvsave." text ads</p>";
                                  }
                               if ($jvsavehtml<>0) {
                     echo "<p>Save ".$jvsavehtml." html ads</p>";
                                  }
                               if ($jvsavesolos<>0) {
                     echo "<p>Save ".$jvsavesolos." solo ads</p>";
                                  }
                               if ($jvurls<>0) {
                     echo "<p>Have ".$jvurls." links in the Viral Link Cloaker</p>";
                                 }
                               if ($jvrefpoints<>0) {
                  echo "<p>".$jvrefpoints." points for every referral</p>";
                                 }
                               if ($jvreflogin<>0) {
                  echo "<p>".$jvreflogin." points when a referral logs in</p>";
                                 }
                                if ($jvpercent<>0) {
                  echo "<p>When a referral earns points you earn ".$jvpercent." percent in points</p>";
                                 }
                                if ($jvbuycom<>0) {
                  echo "<p>When a referral purchases advertising you earn ".$jvbuycom." percent in commissions</p>";
                                }
                if ($jvcommission<>0) {                                                      echo "<p>$".$jvcommission." for every pro member referred";
                                }
                             if ($jvjvcom<>0) {                                                                                               echo "<p>$".$jvjvcom." for every JV Member referred";
                               }
                            if ($jvsupercom<>0) {                                                      echo "<p>$".$jvsupercom." for every SUPER JV Member referred";
                              }
                         
    ?> 
<p align="center">Price: <b>FREE</b></p>
                   </font>
               <font size="2" face="<? echo $fonttype; ?>" color="<? echo $fontcolour; ?>">
                 <form method="POST" action="join.php">
<input type="hidden" name="referrer" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                 <p align="center">
                 <br><br>
                 <b><?php echo $middlelevel ?> Signup</b>
                 <br><br>Username (no spaces):<br>
                 <input type="text" size="25" name="new_userid">
                 <br>Password:<br>
                 <input type="text" size="25" value name="new_password">
                 <br>Retype Password:<br>
                 <input type="text" size="25" value name="new_passwordv">
                 <br>First Name:(required)<br>
                 <input type="text" size="25" name="new_fullname">
                                 <br>Last Name:(required)<br>
                 <input type="text" size="25" name="new_lastname">
                 <br>Email:<br>
                 <input type="text" size="25" name="new_contact">
                 <br>
          </font>
                 </p>
                   </font>
    <center>
               <font size="2" color="<? echo $fontcolour; ?>">
                         <p><font size="2" color="<? echo $fontcolour; ?>">Member Type:&nbsp;<b><?php echo $middlelevel ?></b></p>
                   </font>
 
 <p>
 
 <font size="2" color="<? echo $fontcolour; ?>">
 
                 <input type="checkbox" name="terms" value=1> By joining you agree to receive emails from <? echo $sitename; ?>.  You are also agreeing to the rest of our 
 
    <a href="<? echo $domain; ?>/terms.php" target=_blank">
 
     <font color="#000000"><u>Terms and Conditions</u></font></a>. You can view the list of banned emails <a href="<? echo $domain; ?>/bannedlist.php" target=_blank">
 
 
 
     <font color="#000000"><u>here</u></font></a>.</center>
 
                   </font>   
 

                        <input type="hidden" size="25" name="referid" value="<? echo $referid; ?>">
                        <input type="hidden" name="mtY" value="JV Member">
                 <input type="submit" value="Create Account">
                        </form>
          
                         </center>
                   </font>
            </td>
          </tr>
        </table><br><br>
 
<?
 
}
 
?>
 

        </td>
        </tr>
        </table>
        </div>
        </font>
</table>
 
<?
 
include "footer.php";
mysql_close($dblink);
?>