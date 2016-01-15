<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
$veid = $_POST['txtid'];
$vbody = $_POST['txtbody'];

//GENERAL - REQUIRED FIELDS
$vbody = trim($_POST['txtbody']);

	if ($vbody  != '') {
		
		
		if ($vbody  == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}

$vqstr = "?k1=f";
$vqstr .= "&k2=" . urlencode($vbody );

if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: ' . $_SESSION['svabsuri'] . 'cms/projects-edit.php' . $vqstr);
		exit();
	
	} 
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_content = sprintf("UPDATE tblprojects SET pbody = %s WHERE pid = $veid",
		escapestring($vconntekiah, $vbody , 'text'),
		escapestring($vconntekiah, $veid, 'int')
		);
$sql_content_result = mysqli_query($vconntekiah, $sql_content);
	
	if($sql_content_result){
		
		header('Location:' . $_SESSION['svabsuri'] . 'cms/projects-view.php?edit=success');
		
		exit();
		
		}else{
			
			header ('Location: ' . $_SESSION['svabsuri'] . 'cms/projects-edit.php?edit=failed');
			exit();
		
			}
		}
		
		/*. $_SESSION['svabsuri'] .*/
		 else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
