<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
 
?>
<?php 
//PAGINATION!!!!!/

$per_page = 4;

if(isset($_GET['page'])){
	
	$page = $_GET['page'];
	
	}else{
		
		$page = 1;
		
		}

//pAGE WILL START FROM  0 and multiply by per page
$start_from = ($page-1) * $per_page;

//CREATE SQL STATEMENT
$sql_events = "SELECT * FROM tblevents ORDER BY estatus ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_events = mysqli_query($vconntekiah, $sql_events);

//CREATE AN ASSOCIATIVE ARRAY
$rs_events_rows = mysqli_fetch_assoc($rs_events);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>
<script>
function changestatus(vid) {
	var xmlhttp = new XMLHttpRequest();
      
    if(window.XMLHttpRequest) {
        //code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
        
        } else {  //code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
    
    xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             if(xmlhttp.responseText == "deactive") {
                 
                 document.getElementById("btnstatus" + vid).value = "Activate";
                 document.getElementById("txtstatus").value = "i";
                 
             } else if(xmlhttp.responseText == "active"){
				 
                 document.getElementById("btnstatus" + vid).value = "Deactivate";
                 document.getElementById("txtstatus").value = "a";
				 }
            }
        }
			
	vemail = document.getElementById('txtstatus').value;
			
	xmlhttp.open("GET", "event-status-update-process.php?txtemail="+vemail,true);
	xmlhttp.send();
	
}
</script>  
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
        <h2>List of Events</h2>
      <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <?php do { ?>
        <tr>
          <td style=""><strong>Event Title</strong></td>
          <td style=""><strong>Event Date</strong></td>
        </tr>
           
        
                <td><?php echo $rs_events_rows['etitle']; ?></td>
                <td><?php echo $rs_events_rows['estartdate']; ?></td>
                
        <tr>

				<td align="center" colspan="2">
                
                              
                	<form method="post" action="event-preview.php" class="buttonsstyle">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_events_rows['eid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Preview">
                    </form>
              
                
                              
                	<form method="post" action="event-edit.php" class="buttonsstyle">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_events_rows['eid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Edit">
                    </form>
               
                
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_events_rows['eid'] )) { ?>                
                	<form method="post" action="event-delete.php" class="buttonsstyle">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_events_rows['eid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                    
                <input type="hidden" id="txtstatus" value="<?php echo $rs_events_rows['estatus']; ?>">  
                    
                <input type="button" class="btnstatus" id="btnstatus<?php echo $rs_events_rows['eid'];?>" onclick="insertstatus('<?php echo $rs_events_rows['eid'];?>')" value="<?php if($rs_events_rows['estatus'] == 'a'){echo 'Deactivate';}else{ echo 'Activate';} ?>">
                
                    
                   
                </td>
                
         </tr>
         
         <tr>
         
         <td></td>
         
         </tr>
        <?php } while ($rs_events_rows = mysqli_fetch_assoc($rs_events))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
