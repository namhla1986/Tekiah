<?php 
$vmysqlserver = 'localhost';
$vconnusername = 'brian';
$vconnpassword = 'brian';
$vconndb = 'dbtekiah';

// CONNECT TO MYSQL SERVER

$vconntekiah = mysqli_connect($vmysqlserver, $vconnusername, $vconnpassword, $vconndb);
if (!$vconntekiah){

  die('Could not connect: ' . mysqli_error());
}

else{
	
$vid = $_POST['kid'];

$sql = "DELETE FROM tblstaff WHERE sid = $vid";

		mysqli_select_db($vconntekiah, $vconndb);

$retval = mysqli_query($vconntekiah, $sql);
}

if(! $retval )
{
  die('Could not delete data: ' . mysqli_error($vconntekiah));
}

	else
		
		header('Location: ' . $_SESSION['svabsuri']  . 'staff-view.php?');
		print "Deleted data successfully\n";

		exit();


mysqli_close($vconntekiah);


?>
