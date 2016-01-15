<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
$_SESSION['svadminsecurity'] = md5(md5(rand()));
$vsecurity = $_SESSION['svadminsecurity'];
?>
<?php 
//FUNCTION FOR DISPLAYING RETURNED VALUES SHOULD VALIDATION FAIL
function valreturned($vkey){
	if(isset($_GET[$vkey]) && $_GET[$vkey] != '') {
		return $_POST[$vkey];
		}
	}
?>
<?php 
//GET VALUE OF THE kid FROM GET ARRAY
$vid = $_REQUEST['kid'];

//CREATE SQL STATEMENT
$sql_events = "SELECT * FROM tblevents WHERE eid = $vid";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_events = mysqli_query($vconntekiah, $sql_events);

//CREATE AN ASSOCIATIVE ARRAY
$rs_events_rows = mysqli_fetch_assoc($rs_events);
$veid = $rs_events_rows['eid'];
$vcontent = $rs_events_rows['econtent'];
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function toolbar(x){
CKEDITOR.replace(x,{
	on :
	{
		instanceReady : function(ev)
		{
			//Output paragraphs as <p>Text</p>
			this.dataProcessor.writer.setRules('p',
			{
				indent : false,
				breakBeforeOpen : false,
				breakAfterOpen : false,
				breakBeforeClose : false,
				breakAfterClose : false
					});
				}
			}
		}
	)};


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
        <h2>Edit Events</h2>
        <p>&nbsp;</p>
        <!--kval-->
        
        <form method="post" action="event-edit-process.php">
       
         	<label>Title</label>
        	<input type="text" name="txttitle" autofocus value="<?php if($rs_events_rows['etitle'] == 'na'){echo '';} else {echo $rs_events_rows['etitle'];} ?>">
       
         	<legend><!-- REMEMBER TO ADD REQUIRED -->
        	<textarea name="txtcontent"><?php if($rs_events_rows['econtent'] == 'na'){echo '';} else {echo $rs_events_rows['econtent'];} ?></textarea>
            <script>toolbar('txtcontent');</script>
            </legend>
         
         
         
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_events_rows['eid']) && $rs_events_rows['eid'] != '') {echo $rs_events_rows['eid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Update">  
           
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
