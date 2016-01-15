<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
?>
<?php
$vid = $_REQUEST['kid'];

//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblprojects LEFT JOIN tblprojectimages
ON tblprojects.pid = tblprojectimages.pid WHERE tblprojects.pid = $vid";
 
//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_t = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_staff_rows = mysqli_fetch_assoc($rs_t);

$sql_current_project = "SELECT * FROM tblprojects WHERE pid = $vid";
$sql_current_project_query = mysqli_query($vconntekiah, $sql_current_project);
$sql_current_project_rows = mysqli_fetch_assoc($sql_current_project_query);


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
        <h2><strong><?php echo $sql_current_project_rows['ptitle']; ?></strong></h2>
        <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <tr>
        
        <td>
		<?php echo $sql_current_project_rows['pbody']; ?>
		</td>
        
        
        </tr>
        <?php do { ?>
        <tr>
            <td>
            <?php if(!$rs_staff_rows['piimage'] == 'na') { ?>
            	
                No Image
				
			<?php } else { ?>
					<img src="<?php echo  'http://localhost/tekiah/cms/uploaded-images/projects/' . str_replace(' ', '-', strtolower($rs_staff_rows['ptitle'])) . '/' . $rs_staff_rows['piimage']; ?>">
				<?php } ?>
            </td>
        <tr>
        
        <tr>
            <td>
            	<?php echo $rs_staff_rows['picaption']; ?>
            </td>
            
        </tr>
        
        <tr>
            <td>
                	<form method="post" action="projects-delete.php">
                    
                    	<input type="hidden" name="milk" value="<?php echo $sql_current_project_rows['pid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Delete">
                    </form>
            </td>
            
        	<td>
                	<form method="post" action="projects-edit.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_project_rows['pid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Edit">
                    </form>
        	</td>
        </tr>
        
        <?php } while ($rs_staff_rows = mysqli_fetch_assoc($rs_t))?>
        </tr>
        
        <tr>
        <td>&nbsp;</td>
        </tr>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
