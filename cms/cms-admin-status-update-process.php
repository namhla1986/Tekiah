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
		$sql_update = sprintf("UPDATE tbladministrator SET astatus = %s WHERE aid = %u",
		escapestring($vconntekiah, $vstatus, 'text'),
		escapestring($vconntekiah, $vid, 'int')
		);


		$update_result = mysqli_query($vconntekiah, $sql_update);
		
		if ($update_result){
			header('Location: ' . $_SESSION['svabsuri'] . 'cms/news-view.php?kid=' . $vid . '&kupdate=true&');
			exit();
			}else{
			header('Location: ' . $_SESSION['svabsuri'] . 'cms/news-view.php?kid=' . $vid . '&kupdate=false&');
			exit();
				}
	
		}else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
