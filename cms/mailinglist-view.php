<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
 
?>
<?php 
//CREATE SQL STATEMENT
$sql_ml = "SELECT * FROM tblmailinglist ORDER BY memail ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_ml = mysqli_query($vconntekiah, $sql_ml);

//CREATE AN ASSOCIATIVE ARRAY
$rs_ml_rows = mysqli_fetch_assoc($rs_ml);
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
        <h2>Mailing List</h2>
      <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        
        <tr>
          <td style=""><strong>Email Address</strong></td>
          <td align="center"><strong>Delete</strong></td>
        </tr>
        
        <?php do { ?>
        
        <tr>
        
                <td><?php echo $rs_ml_rows['memail']; ?></td>
        

                
				<td align="center">
                
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_ml_rows['mid'] )) { ?>                
                	<form method="post" action="mailinglist-delete.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_ml_rows['mid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                </td>
                
                
         </tr>
         
        
        <?php } while ($rs_ml_rows = mysqli_fetch_assoc($rs_ml))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
