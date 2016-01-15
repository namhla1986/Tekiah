<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
?>
<?php 
//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblstaff ORDER BY ssurname ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_t = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_staff_rows = mysqli_fetch_assoc($rs_t);
?>
<?php 
		
		echo str_replace('@', '&#64;', $rs_staff_rows['semail']);
		
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
        <h2>Archive</h2>
        <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <?php do { ?>
        <tr>
        <td>&nbsp;</td>
        <td><strong>Name and surname</strong></td>
        </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td>
		<?php echo $rs_staff_rows['sname']; ?>
        <?php echo $rs_staff_rows['ssurname']; ?>
        </td>
        </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td><strong>Email</strong></td>
        </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td><?php echo $rs_staff_rows['semail']; ?></td>
        </tr>
        </td>
				<td align="center">
                	<form method="post" action="staff-edit-process.php">
                    	<input type="hidden" name="sid" value="<?php echo $rs_staff_rows['sid']; ?>">
                        <input type="submit" value="Update">
                    </form>
                </td>
                
				<!--<td align="center">
                <?php //if($rs_staff_rows['ssentout'] == '0000-00-00 00:00:00') {?>
                	<form method="post" action="cms-nl-email-process.php">
                    	<input type="hidden" name="txtid" value="<?php //echo $rs_staff_rows['sid']; ?>">
                    	<input type="hidden" name="txtsecurity" value="<?php //echo $vsecurity; ?>">
                        <input type="submit" value="Mail now">
                    </form>
                    <?php //} else {echo '&nbsp;';}?>
                </td>-->
				<td align="center">
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_staff_rows['sid'] )) { ?>                
                	<form method="post" action="staff-delete.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_staff_rows['sid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                </td>
            </tr>
        
        <?php } while ($rs_staff_rows = mysqli_fetch_assoc($rs_t))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
