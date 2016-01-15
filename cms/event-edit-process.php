<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
$veid = $_POST['txtid'];
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

$vtitle = trim($_POST['txttitle']);

	if ($vtitle != '') {
		
		
		if ($vtitle == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}

$vqstr = "?k1=f";
$vqstr .= "&k2=" . urlencode($vcontent);
$vqstr .= "&k3=" . urlencode($vtitle);

if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: ' . $_SESSION['svabsuri'] . 'cms/event-edit.php' . $vqstr);
		exit();
	
	} 
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_content = sprintf("UPDATE tblevents SET econtent = %s, etitle = %s WHERE eid = $veid",
		escapestring($vconntekiah, $vcontent, 'text'),
		escapestring($vconntekiah, $vtitle, 'text'),
		escapestring($vconntekiah, $veid, 'int')
		);
$sql_content_result = mysqli_query($vconntekiah, $sql_content);
	
	if($sql_content_result){
		
		header('Location:' . $_SESSION['svabsuri'] . 'cms/event-view.php?edit=success');
		
		exit();
		
		}else{
			
			header ('Location: ' . $_SESSION['svabsuri'] . 'cms/event-edit.php?edit=failed');
			exit();
		
			}
		}
		
		/*. $_SESSION['svabsuri'] .*/
		 else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
