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
$sql_events = "SELECT * FROM tblevents ORDER BY estartdate ASC LIMIT $start_from, $per_page";

//CONNECT TO MYSQL SERVER
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
    
vstatus = document.getElementById('txtstatus').value;

xmlhttp.open("GET", "cms-events-status-update-process.php?txtid="+vid+"&txtstatus="+vstatus,true);

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
      <h2>Events</h2>
        <table cellspacing="0" class="tbldatadisplay">
          <?php do{?>  
            <tr>
                <td><strong>Name of event</strong></td>
                <td><strong>Date of event</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
			<tr>
			  <td><?php echo $rs_events_rows['etitle'];?></td>
              <td><?php echo $rs_events_rows['estartdate'];?></td>  
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
			</tr>
            
			<tr>	
              <td ><strong>Details</strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              
			</tr>
              
			    
            <tr><td colspan="4"><?php echo $rs_events_rows['econtent']; ?></td></tr>
			
            <tr>
                <td colspan="4" style="border-bottom:solid 1px #06F;"> 
                
                <input type="hidden" id="txtstatus" value="<?php echo $rs_events_rows['estatus']; ?>">  
                    
                <input type="button" class="btnstatus" id="btnstatus<?php echo $rs_events_rows['eid'];?>" onclick="changestatus('<?php echo $rs_events_rows['eid'];?>')" value="<?php if($rs_events_rows['estatus'] == 'a'){echo 'Deactivate';}else{ echo 'Activate';} ?>">
              
              
                <form method="post" action="events-edit.php" class="events_button">
                    <input type="hidden" name="txtid" value="<?php echo $rs_events_rows['eid'];?>">
                    <input type="submit" value="Edit">
                 </form>
              
                <form method="post" action="events-delete-process.php" onsubmit="return choose()" class="events_button">
                    <input type="hidden" name="txtid" value="<?php echo $rs_events_rows['eid'];?>">
                    <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">   
                    <input type="submit" value="Delete">
                </form>
                
                <div class="clear_float"></div>
               </td> 
              
            </tr>
            
            
		<?php } while($rs_events_rows = mysqli_fetch_assoc($rs_events))?>


        </table>
        
        <div id="page_num_display">
			<?php
            $query = "SELECT * FROM tblevents";
			
			$result = mysqli_query($vconntekiah, $query);
			
			//COUNT TOTAL NUMBER OF RECORDS
			$total_records = mysqli_num_rows($result);
			
			//USING CEIL FUNCTIO TO DIVIDE TOTAL NUMBER OF RECORS ON PAGE AND ROUND UP TO NEAREST WHOLE NUMBER
			$total_pages = ceil($total_records / $per_page);
			
            //GPING TO FIRST PAGE
			echo "<center><a href='events-view.php?page=1'>First Page</a>";
			
			for($i=1; $i<=$total_pages; $i++){
				
				echo "<a href='events-view.php?page=".$i."'>".$i."</a>";
				
				}
				
				echo "<a href='events-view.php?page=$total_pages'>Last Page</a>";
		
            ?>
        </div>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>
<script>
function choose(){
	return confirm("Are you sure you want to delete this?");
	}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>
