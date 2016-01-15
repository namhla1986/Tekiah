<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;

//COLLECT ALL THE VALUES FROM THE FORM FIELDS AND ASSIGN THEM TO SESSION VARIABLES


//GENERAL - REQUIRED FIELDS

		$vtitle = filter_var(trim($_POST['txttitle']), FILTER_SANITIZE_STRING);
		
		if ($vtitle === ''){
			$vvalidate++;
			
			}
		

		$vstartdate = filter_var(trim($_POST['txtstartdate']), FILTER_SANITIZE_STRING);
		
		if ($vstartdate === ''){
			$vvalidate++;
			
			}
			

		$vcontent = trim($_POST['txtcontent']);
		
		if ($vcontent === ''){
			$vvalidate++;
			
			}



$vqstr = "?kvalidation=failed";
$vqstr .= "&ktitle=" . urlencode($vtitle);
$vqstr .= "&kstartdate=" . urlencode($vstartdate);
$vqstr .= "&kcontent=" . urlencode($vcontent);

if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: event-add-new.php' . $vqstr);
		exit();
	
	} else {
		
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_events = sprintf("INSERT INTO tblevents (edate, etitle, estartdate, econtent) VALUES (curdate(), %s, %s, %s)", 
		escapestring($vconntekiah, $vtitle, 'text'),
		escapestring($vconntekiah, $vstartdate, 'date'),
		escapestring($vconntekiah, $vcontent, 'text')
		);
$sql_events_result = mysqli_query($vconntekiah, $sql_events);

	if($sql_events_result){
		
		header('Location: event-view.php');
		exit();
		
		}else{
			
		header ('Location: event-add-new.php?kinsert=failed');
		
			exit();

			}
		}
		
		} else{
		
		header('Location: signout.php');
		exit();
		}
?>
