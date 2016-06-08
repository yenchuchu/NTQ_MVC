<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "ntq_test";
$con = mysql_connect($host, $user, $pass) or die ("don't connect to system");
mysql_select_db($database, $con) or die ("don't connect to database");