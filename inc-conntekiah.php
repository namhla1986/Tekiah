<?php 
$vmysqlserver = 'localhost';
$vconnusername = 'brian';
$vconnpassword = 'brian';
$vconndb = 'dbtekiah';

// CONNECT TO MYSQL SERVER
$vconntekiah = mysqli_connect($vmysqlserver, $vconnusername, $vconnpassword, $vconndb);
if (!$vconntekiah){
	
	//REDIRECT TO ERROR PAGE WHEN PAGE FAILS
	echo "Connection failed";
	exit();
	
	} else {
		//INDICATE WHICH DATABASE YOU WANT TO WORK WITH
		mysqli_select_db($vconntekiah,$vconndb);
	}
?>
