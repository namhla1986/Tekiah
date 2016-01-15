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
$sql_about = "SELECT * FROM tblabout";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_about = mysqli_query($vconntekiah, $sql_about);

//CREATE AN ASSOCIATIVE ARRAY
$rs_about_rows = mysqli_fetch_assoc($rs_about);
$vaid = $rs_about_rows['aid'];
$vacontent = $rs_about_rows['acontent'];
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
        <h2>Edit About</h2>
        <p>&nbsp;</p>
        <!--kval-->
        
        <form method="post" action="about-view-edit-process.php">
       

        	<label><strong>Details</strong></label>
         <br><br>
        	<textarea name="txtcontent"><?php if($rs_about_rows['acontent'] == 'na'){echo '';} else {echo $rs_about_rows['acontent'];} ?></textarea>
            <script>toolbar('txtcontent');</script>
         
         <br><br>
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_about_rows['aid']) && $rs_about_rows['aid'] != '') {echo $rs_about_rows['aid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Update">  
           
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
