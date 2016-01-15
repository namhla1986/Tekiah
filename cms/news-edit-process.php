<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;
$vnid = $_POST['txtid'];
$vcontent = $_POST['txtcontent'];
$vtitle = $_POST['txttitle'];
$vimglargecaption = $_POST['txtimglargecaption'];

//GENERAL - REQUIRED FIELDS
$vsummary = trim($_POST['txtsummary']);

	if ($vsummary != '') {
		
		
		if ($vsummary == ''){
			$vvalidate++;
			
			}
		}else{
			
			$vvalidate++;
			
			}

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
$vqstr .= "&k2=" . urlencode($vsummary);
$vqstr .= "&k3=" . urlencode($vcontent);
$vqstr .= "&k4=" . urlencode($vtitle);
$vqstr .= "&kid=" . urlencode($vnid);

$vimg1old = $_POST['txt'.$vdptname.'img1old'];
$vimg2old = $_POST['txt'.$vdptname.'img2old'];

if (($_FILES['txt'.$vdptname.'img1']['name'] == '') && ($vimg1old != '')) {
	$vimg1 = $vimg1old;
	} elseif (($_FILES['txt'.$vdptname.'img1']['name'] != '') && ($vimg1old == 'na')){
		$vimg1 = imguri($_FILES['txt'.$vdptname.'img1']['name'], $_FILES['txt'.$vdptname.'img1']['size'], 'txt'.$vdptname.'img1');
	}else{
		$vimg1 = imguri($_FILES['txt'.$vdptname.'img1']['name'], $_FILES['txt'.$vdptname.'img1']['size'], 'txt'.$vdptname.'img1');
		unlink('../uploaded-images/'.$vimg1old);
		}

if (($_FILES['txt'.$vdptname.'img2']['name'] == '') && ($vimg2old != '')) {
	$vimg2 = $vimg2old;
	} elseif (($_FILES['txt'.$vdptname.'img2']['name'] != '') && ($vimg2old == 'na')){
		$vimg2 = imguri($_FILES['txt'.$vdptname.'img2']['name'], $_FILES['txt'.$vdptname.'img2']['size'], 'txt'.$vdptname.'img2');
	}else{
		$vimg2 = imguri($_FILES['txt'.$vdptname.'img2']['name'], $_FILES['txt'.$vdptname.'img2']['size'], 'txt'.$vdptname.'img2');
		unlink('../uploaded-images/'.$vimg1old);
		}

if($vvalidate !== 0){
	
	//ENCODE QUERYSTRING
	header ('Location: ' . $_SESSION['svabsuri'] . 'cms/news-edit.php' . $vqstr);
		exit();
	
	} 
	
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_content = sprintf("UPDATE tblnews SET nsummary = %s, ncontent = %s, ntitle = %s WHERE nid = $vnid",
		escapestring($vconntekiah, $vsummary, 'text'),
		escapestring($vconntekiah, $vcontent, 'text'),
		escapestring($vconntekiah, $vtitle, 'text'),
		escapestring($vconntekiah, $vnid, 'int')
		);
$sql_content_result = mysqli_query($vconntekiah, $sql_content);
	
	if($sql_content_result){

		header('Location:' . $_SESSION['svabsuri'] . 'cms/news-view.php?edit=success');
		
		exit();
		
		}else{
			
			header ('Location: ' . $_SESSION['svabsuri'] . 'cms/news-edit.php?edit=failed');
			exit();
		
			}
		}
		
		/*. $_SESSION['svabsuri'] .*/
		 else{
		
		header('Location: ' . $_SESSION['svabsuri'] . 'cms/signout.php');
		exit();
		}
?>
