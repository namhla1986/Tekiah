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
	
$vid = $_REQUEST['milk'];

$sql = "DELETE FROM tblprojectimages WHERE pid = $vid";

$retval = mysqli_query($vconntekiah, $sql);
}


if(! $retval )
{
  die('Could not delete data: ' . mysqli_error($vconntekiah));
}

	else
		
		header('Location: ' . $_SESSION['svabsuri']  . 'projects-view.php?delete=true&kid='.$vid);
		exit();


mysqli_close($vconntekiah);


?>
