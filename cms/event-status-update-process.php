<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {	

$vid = $_POST['kid'];
$vstatus = $_POST['txtstatus'];


	if($vstatus === 'i'){
		$vstatus = 'a';
	} elseif ($vstatus === 'a'){
		$vstatus = 'i';
		}
		
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');

		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_update = sprintf("UPDATE tblevents SET estatus = %s WHERE eid = %u",
		escapestring($vconntekiah, $vstatus, 'text'),
		escapestring($vconntekiah, $vid, 'int')
		);


		$update_result = mysqli_query($vconntekiah, $sql_update);
		
		echo 'active'; 
		
		
			}else {
		echo 'inactive';
				
				}
?>
