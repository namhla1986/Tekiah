<?php require("inc-public-predoctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
$vbox = $_POST['txtbox'];

//COLLECT ALL THE VALUES FROM THE FORM FIELDS AND ASSIGN THEM TO SESSION VARIABLES


//GENERAL - REQUIRED FIELDS

		$vname = filter_var(trim($_POST['txtname']), FILTER_SANITIZE_STRING);
		
		if ($vname === ''){
			$vvalidate++;
			
			}
		

		$vsurname = filter_var(trim($_POST['txtsurname']), FILTER_SANITIZE_STRING);
		
		if ($vsurname === ''){
			$vvalidate++;
			
			}

		$vemail = filter_var(trim($_POST['txtemail']), FILTER_SANITIZE_STRING);
		
		if ($vemail === ''){
			$vvalidate++;
			
			}

		$vmsg = filter_var(trim($_POST['txtmsg']), FILTER_SANITIZE_STRING);
		
		if ($vmsg === ''){
			$vvalidate++;
			
			}



$vqstr = "?kvalidation=failed";
$vqstr .= "&kname=" . urlencode($vname);
$vqstr .= "&ksurname=" . urlencode($vsurname);
$vqstr .= "&kemail=" . urlencode($vemail);

if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: volunteer-form.php' . $vqstr);
		exit();
	
	} else {
		
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_volunteer = sprintf("INSERT INTO tblvolunteers (vname, vsurname, vemail, vmsg) VALUES (%s, %s, %s, %s)", 
		escapestring($vconntekiah, $vname, 'text'),
		escapestring($vconntekiah, $vsurname, 'text'),
		escapestring($vconntekiah, $vemail, 'text'),
		escapestring($vconntekiah, $vmsg, 'text')
		);
		
		$sql_volunteer_result = mysqli_query($vconntekiah, $sql_volunteer);
		
		if($sql_volunteer_result == 'yes'){
			
			
		require 'inc-function-escape-string.php';
			}
			
		require('inc-conntekiah.php');
		
//FORMULATE THE INSERT STATEMENT
		$sql_mailinglist = sprintf("INSERT INTO tblmailinglist (memail) VALUES (%s)", 
		escapestring($vconntekiah, $vemail, 'text')
		);

$sql_mailinglist_result = mysqli_query($vconntekiah, $sql_mailinglist);

		
		header('Location: volunteer-form.php?kinsert=successful');
		exit();		
		
		
			
		header ('Location: volunteer-form.php?kinsert=failed');
		
			exit();

			}
		
		} else{
		
		header('Location: volunteer-form.php');
		exit();
		}
?>
