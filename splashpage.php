<?PHP 
$sref=$_REQUEST["ref"]; 
include "config.php";
mysql_close();
?>
<html>
<head>
<meta http-equiv="Content-Type" 
content="text/html; charset=iso-8859-1"> 
<title>Join <? echo $sitename; ?>!</title>
</head>

<body background="/images/bg.jpg"> 

<center>&nbsp;<p><a href="<? echo $domain; ?>/index.php?referid=<?PHP echo $sref ?>" target=_blank">
<img src="<? echo $domain; ?>/images/FiftySplash.gif" border="0"></a></p>
<br>
Your Click Will Open A New Window</center>
</body>

</html> 