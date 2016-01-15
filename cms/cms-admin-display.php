<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
 
?>
<?php 
//CREATE SQL STATEMENT
$sql_nl = "SELECT * FROM tbladministrator ORDER BY aname ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_nl = mysqli_query($vconntekiah, $sql_nl);

//CREATE AN ASSOCIATIVE ARRAY
$rs_nl_rows = mysqli_fetch_assoc($rs_nl);
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
        <h2>List of Administrators</h2>
      <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        
        <tr>
          <td><strong>Name</strong></td>
          <td><strong>Email</strong></td>
          <td><strong>Info</strong></td>
          <td><strong>Access</strong></td>
          <td align="center"><strong>Edit</strong></td>
          <td align="center"><strong>Delete</strong></td>
          <td align="center"><strong>Status</strong></td>
        </tr>
        
        <?php do { ?>
     <script>
     
	 	$(document).ready(function(){
			$('#admin_details_<?php echo $rs_nl_rows['aid']; ?>').hide();
			
			$('#btndetails_<?php echo $rs_nl_rows['aid']; ?>').on('click', function(){			
				$('#admin_details_<?php echo $rs_nl_rows['aid']; ?>').stop().slideToggle(150);
			});
		});
	 

     
     </script>   
        
        
        <tr>
        
                <td><?php echo $rs_nl_rows['asurname'].' '.$rs_nl_rows['aname']; ?></td>
        
                <td><?php echo $rs_nl_rows['aemail']; ?></td>

				<td align="center">
                        <button id="btndetails_<?php echo $rs_nl_rows['aid']; ?>">Info</button>
                        
                </td>
                
                <td align="center">
				<?php if ($rs_nl_rows['aaccess'] === 'a') {echo 'godmode';} else {echo 'pleb';} ?>  

</td>                
              
				<td align="center">
                
                              
                	<form method="post" action="cms-admin-edit.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_nl_rows['aid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Edit">
                    </form>
                </td>
                
				<td align="center">
                
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_nl_rows['aid'] )) { ?>                
                	<form method="post" action="cms-admin-delete.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_nl_rows['aid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                </td>
                
				<td align="center">
                
				<?php if(($_SESSION['svadminaccess'] === 'a')) { ?>                
                	<form method="post" action="cms-admin-status-update-process.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_nl_rows['aid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="hidden" name="txtstatus" value="<?php echo $rs_nl_rows['astatus']; ?>">
                        
                        <input type="submit" value="<?php if($rs_nl_rows['astatus'] === 'i') {echo 'Activate';} else {echo 'Deactivate';}?>">
                    </form>
                    
                <?php } ?>
                
                </td>
                
                <td>
                <?php if(($_SESSION['svadminid'] === $rs_nl_rows['aid'] )) {                 
					echo 'logged in';
					} else { echo '';
				 } ?>
            
                </td>
         </tr>
         
        <tr id="admin_details_<?php echo $rs_nl_rows['aid']; ?>">          
          <td colspan="7">
          	<p>Admin Details:</p>
            <p>Admin Details:<?php echo $rs_nl_rows['aname']; ?></p>
            <p>Admin Details:<?php echo $rs_nl_rows['asurname']; ?></p>
          </td>        
        </tr>        
        
        <?php } while ($rs_nl_rows = mysqli_fetch_assoc($rs_nl))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
