<?php session_start(); ?>
<?php
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	//SET A BASE LINE VALUEFOR VALIDATION CHECK
	$vvalidate = 0;
	$vstatus = 'a';
	
	//EXTRACT ALL THE VALUES FROM FORM THE GET SUPER GLOBAL ARRAY AND ASSIGN THEM TO THE GLOBAL VARIABLES
	$vusername = trim($_POST['txtusername']);
		
		if ($vusername != ' '){
			
			$vusername = filter_var($vusername, FILTER_SANITIZE_EMAIL);
			
			if ($vusername != ' '){
				
				if (filter_var($vusername, FILTER_VALIDATE_EMAIL)){
					
					$vusername = sha1($vusername);
					} else {
						
						$vvalidate++;
						
						}
				
				}
			
			}
	
		//EXTRACT ALL THE VALUES FROM FORM THE GET SUPER GLOBAL ARRAY AND ASSIGN THEM TO THE GLOBAL VARIABLES
	$vpassword = trim($_POST['txtpassword']);
		
		if ($vpassword != ''){
			
			$vpassword = filter_var($vpassword, FILTER_SANITIZE_STRING);
			
			if ($vpassword != ''){
									
					$vpassword = sha1($vpassword);
					} else {
						
						$vvalidate++;
						
						}
				
				}
			
			if ($vvalidate > 0){
					session_destroy();			
					header('Location: signin.php?kvalidation=failed');
					exit();
					
					} else {
	
	//EXTRACT ALL THE VALUES FROM THE GET SUPER GLOBAL ARRAY AND ASSIGN THEM TO THE VARIABLES
	$vusername = sha1(trim($_POST['txtusername']));
	$vpassword = sha1(trim($_POST['txtpassword']));	
	
	//CONNECT TO THE MYSQL SERVER
	require('inc-conntekiah.php');
	
	//CALL  IN THE FUNCTION escapestring
	require('inc-function-escape-string.php');
	
	//FORMULATE A SQL STATEMENT AND ASSIGN THE OUTCOME TO THE VARIABLE %s string formatting %u for intergers. sprintf string printe in a formated structure

	$sql_signin = sprintf("SELECT * FROM tbladministrator WHERE ausername = %s AND apassword = %s AND astatus = %s",
	escapestring($vconntekiah, $vusername, 'text'),
	escapestring($vconntekiah, $vpassword, 'text'),
	escapestring($vconntekiah, $vstatus, 'text')
	);
	//EXECUTE THE SQL STATEMENT
	$rssignin = mysqli_query($vconntekiah, $sql_signin);
	
	//CREATE AN ASSOCIATIVE ARRAY OF THE RECORD SET
	$rssignin_rows = mysqli_fetch_assoc($rssignin);
	
	//CLOSE CONNECTION
	mysqli_close($vconntekiah);
	
	//COUNT THE NUMBER OF RECORDS RETURNED BY THE RECORD GET
	$rssignin_total_records = mysqli_num_rows($rssignin);
	
	if ($rssignin_total_records == 1){
		
		//echo $rssignin_total_records; exit();
		
		//EXTRACT FROM THE ASSOCIATIVE ARRAY THE VALUE ASSOCIATED WITH THE KEY aname
		$_SESSION['svadminid'] = $rssignin_rows['aid'];
		$_SESSION['svadminname'] = $rssignin_rows['aname'];
		$_SESSION['svadminsurname'] = $rssignin_rows['asurname'];
		$_SESSION['svadminemail'] = $rssignin_rows['aemail'];
		$_SESSION['svadminaccess'] = $rssignin_rows['aaccess'];

		
		header('Location: cms-homepage.php');
		exit();
		
	} else{
		
		header('Location: signin.php?ksignin=failed');
		exit();
		}
	}
	} else{
		
		header('Location: signout.php');
		exit();
		
		}
?>
