<?php session_start(); ?>
<?php
if (empty($_SESSION['svadminid'])) {
	header("Location: signout.php");
	exit();
}
?>
