<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
$_SESSION['svadminsecurity'] = md5(md5(rand()));
$vsecurity = $_SESSION['svadminsecurity'];
?>
<?php
//CREATE SQL STATEMENT
$sql_selectedproject = "SELECT alid, altitle FROM tblalbums";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_selectedproject = mysqli_query($vconntekiah, $sql_selectedproject);

//CREATE AN ASSOCIATIVE ARRAY
$rs_selectedproject_rows = mysqli_fetch_assoc($rs_selectedproject);
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
        <h2><?php echo $rs_selectedproject_rows['altitle']; ?></h2>
        <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <tr>
        <td>
        <form method="post" action="album-add-new-process.php"enctype="multipart/form-data">
        <?php do { ?>
        	<br><br>
            Caption:<br><input type="text" name="txtcaption"><br><br>
            Image:<br><input type="file" name="txtimage">
            <br><br> 
				<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                
            <input type="submit" value="Add">
        <?php } while ($rs_selectedproject_rows = mysqli_fetch_assoc($rs_selectedproject))?>
        </form>
        </td>
        
        </tr>
        
        <tr>
    
				<td align="right">
                
                </td>
      
        </tr>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
