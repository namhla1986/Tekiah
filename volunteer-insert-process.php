<?php
$vdate = date('Y-m-d');
$vmailinglist = $_GET['txtmailinglist'];


//required
		$vname = trim($_GET['txtname']);
		$vsurname = trim($_GET['txtsurname']);
		$vemail = trim($_GET['txtemail']);
		$vmsg = trim($_GET['txtmsg']);

		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');

		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');

		//FORMULATE THE INSERT STATEMENT
		$sql_volunteer = sprintf("INSERT INTO tblvolunteers (vdate, vname, vsurname, vemail, vmsg) VALUES (%s, %s, %s, %s, %s)", 
		escapestring($vconntekiah, $vdate, 'text'),
		escapestring($vconntekiah, $vname, 'text'),
		escapestring($vconntekiah, $vsurname, 'text'),
		escapestring($vconntekiah, $vemail, 'text'),
		escapestring($vconntekiah, $vmsg, 'text')
		);
		
		$sql_volunteer_result = mysqli_query($vconntekiah, $sql_volunteer);
		
		if($vmailinglist == 'yes'){
			
		require('inc-conntekiah.php');
		
		require 'inc-function-escape-string.php';
		
//FORMULATE THE INSERT STATEMENT
		$sql_mailinglist = sprintf("INSERT INTO tblmailinglist (mdate, memail) VALUES (%s, %s)", 
		escapestring($vconntekiah, $vdate, 'text'),
		escapestring($vconntekiah, $vemail, 'text')
		);

		$sql_mailinglist_result = mysqli_query($vconntekiah, $sql_mailinglist);
		
		echo 'success_ml'; 
		
		
			}else {
		echo 'success';
				
				}
			
		
		
?>
