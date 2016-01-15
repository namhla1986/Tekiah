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
//$vsid = $_REQUEST['sid'];

//CREATE SQL STATEMENT
$sql_contact = "SELECT * FROM tblcontact";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_contact = mysqli_query($vconntekiah, $sql_contact);

//CREATE AN ASSOCIATIVE ARRAY
$rs_contact_rows = mysqli_fetch_assoc($rs_contact);
$vcid = $rs_contact_rows['cid'];
$vccontent = $rs_contact_rows['ccontent'];
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
        <h2>Edit Contact Details</h2>
        <p>&nbsp;</p>
        <!--kval-->
        
        <form method="post" action="contact-edit-process.php">
       
         	
         	<legend><!-- REMEMBER TO ADD REQUIRED -->
        	<textarea name="txtcontent"><?php if($rs_contact_rows['ccontent'] == 'na'){echo '';} else {echo $rs_contact_rows['ccontent'];} ?></textarea>
            <script>toolbar('txtcontent');</script>
            </legend>
         
         
         
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_contact_rows['cid']) && $rs_contact_rows['cid'] != '') {echo $rs_contact_rows['cid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Update">  
           
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
