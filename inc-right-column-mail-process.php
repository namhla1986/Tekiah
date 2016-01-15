<?php
$vdate = date('Y-m-d');


//required
		$vemail = trim($_GET['txtemail']);

		
			
		require('inc-conntekiah.php');
		
		require 'inc-function-escape-string.php';
		
//FORMULATE THE INSERT STATEMENT
		$sql_mailinglist = sprintf("INSERT INTO tblmailinglist (mdate, memail) VALUES (%s, %s)", 
		escapestring($vconntekiah, $vdate, 'text'),
		escapestring($vconntekiah, $vemail, 'text')
		);

		$sql_mailinglist_result = mysqli_query($vconntekiah, $sql_mailinglist);
		
	if($sql_mailinglist_result){

		echo 'success_ml'; 
		
		
			}
			
		
		
?>
