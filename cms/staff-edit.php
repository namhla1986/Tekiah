<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
													
//COLLECT ALL THE VALUES FROM THE FORM FIELDS AND ASSIGN THEM TO SESSION VARIABLES

//DATE
$vdate = date('Y-m-d');

//GENERAL - REQUIRED FIELDS
$vname = trim($_POST['txtname']);

	if ($vname != '') {
		
		
		if ($vname == ''){
			$vvalidate++;
			
			}
		} else{
			
			$vvalidate++;
			
			}

$vsurname = trim($_POST['txtsurname']);

	if ($vsurname != '') {
		
		
		if ($vsurname == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}

$vemail = trim(strtolower($_POST['txtemail']));

	if ($vemail != '') {
		
		$vemail = filter_var($vemail, FILTER_SANITIZE_STRING);
		
		if ($vemail == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}


$vqstr = "?k1=f";
$vqstr .= "&k2=" . urlencode($vname);
$vqstr .= "&k3=" . urlencode($vsurname);
$vqstr .= "&k4=" . urlencode($vemail);


if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: ' . $_SESSION['svabsuri'] . 'cms/staff-view.php' . $vqstr);
		exit();
	
	} else {
		

		//UNSET SESSION
		/* The foreach loop works only on arrays and is used to loop through each key /value pair in an array. For every loop iteraction the value of the cuurent array element is assigned to the $val  and the array pointer parameter.
		
		*/

	foreach ($_SESSION as $key => $val){
		if ((substr($key, 0, 7) !== 'svadmin') && ($key !== 'svabsuri')){
			unset($_SESSION[$key]);
			}
		
		}
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_t = sprintf("INSERT INTO tblstaff (sdate, sname, ssurname, semail) VALUES (%s, %s, %s, %s)", 
		escapestring($vconntekiah, $vdate, 'text'),
		escapestring($vconntekiah, $vname, 'text'),
		escapestring($vconntekiah, $vsurname, 'text'),
		escapestring($vconntekiah, $vemail, 'text')
		);
	
$sql_t_result = mysqli_query($vconntekiah, $sql_t);
$last_id  = mysqli_insert_id($vconntekiah);
	
	if($sql_nl_result){
		
		header('Location:' . $_SESSION['svabsuri'] . 'cms/staff-view.php?kid=' . $last_id);
		
		exit();
		
		}else{
			header ('Location: ' . $_SESSION['svabsuri'] . '/staff-add-new.php');
			exit();
		
			}
		}
		
		/*. $_SESSION['svabsuri'] .*/
		} else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
