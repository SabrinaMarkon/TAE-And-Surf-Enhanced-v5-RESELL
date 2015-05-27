<?php

    $MySqlHostname = "localhost"; //the name of your host - if its local leave it as is.
    $MySqlUsername = "phpsites_demota5"; //the username to your database.
    $MySqlPassword = "FNq!KpMgP[^1"; //the password to your database.
    $MySqlDatabase = "phpsites_demotaeenhancedv5"; //the name of your database.


// do not edit below this line!!
///////////////////////////////////////////////////////////////////////

	$dblink=MYSQL_CONNECT($MySqlHostname, $MySqlUsername, $MySqlPassword) or die("Could not connect to database");
	@mysql_select_db("$MySqlDatabase") or die( "Could not select database");

?>