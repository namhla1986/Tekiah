<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
?>
<?php 
//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblabout ORDER BY acontent ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_t = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_t_rows = mysqli_fetch_assoc($rs_t);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>

</head>

<body>

<div id="main_container">

<div id="branding_bar">
<?php require("inc-cms-branding-bar.php"); ?>
</div>

<div id="body_column_left_container">

    <div id="body_column_left">
        <?php require("inc-cms-accordion_menu.php"); ?>
    </div>
    
</div>

<div id="body_column_right_container">
    
    <div id="body_column_right">
        <h2>About</h2>
 
        <p><?php echo $rs_t_rows['acontent']; ?></p>

    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
