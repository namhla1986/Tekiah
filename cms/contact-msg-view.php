<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
 
?>
<?php 
//CREATE SQL STATEMENT
$sql_contact = "SELECT * FROM tblcontactform ORDER BY cfname ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_contact= mysqli_query($vconntekiah, $sql_contact);

//CREATE AN ASSOCIATIVE ARRAY
$rs_contact_rows = mysqli_fetch_assoc($rs_contact);
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
        <h2>List of messages</h2>
      <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <tr>
          <td style=""><strong>Name</strong></td>
          <td style=""><strong>Surname</strong></td>
          <td style=""><strong>Email</strong></td>
          <td style=""><strong>Message</strong></td>
          <td align="center"><strong>Delete</strong></td>
        </tr>
        
        <?php do { ?>
        
        <tr>
        
                <td><?php echo $rs_contact_rows['cfname']; ?></td>
                <td><?php echo $rs_contact_rows['cfsurname']; ?></td>
                <td><?php echo $rs_contact_rows['cfemail']; ?></td>
                <td><?php echo $rs_contact_rows['cfmsg']; ?></td>
                
				<td align="center">
                
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_contact_rows['cfid'] )) { ?>                
                	<form method="post" action="contact-msg-delete.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_contact_rows['cfid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                </td>
                
                
         </tr>
         
        
        <?php } while ($rs_contact_rows = mysqli_fetch_assoc($rs_contact))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
