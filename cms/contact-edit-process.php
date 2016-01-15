<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
$vcid = $_POST['txtid'];
$vcontent = $_POST['txtcontent'];

//GENERAL - REQUIRED FIELDS
$vcontent = trim($_POST['txtcontent']);

	if ($vcontent != '') {
		
		
		if ($vcontent == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}



$vqstr = "?k1=f";
$vqstr .= "&k2=" . urlencode($vcontent);


if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: ' . $_SESSION['svabsuri'] . 'cms/contact-edit.php' . $vqstr);
		exit();
	
	} 
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_content = sprintf("UPDATE tblcontact SET ccontent = %s WHERE cid = $vcid",
		escapestring($vconntekiah, $vcontent, 'text'),
		escapestring($vconntekiah, $vcid, 'int')
		);
$sql_content_result = mysqli_query($vconntekiah, $sql_content);
	
	if($sql_content_result){
		
		header('Location:' . $_SESSION['svabsuri'] . 'cms/contact-view.php?edit=success');
		
		exit();
		
		}else{
			
			header ('Location: ' . $_SESSION['svabsuri'] . 'cms/contact-edit.php?edit=failed');
			exit();
		
			}
		}
		
		/*. $_SESSION['svabsuri'] .*/
		 else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
