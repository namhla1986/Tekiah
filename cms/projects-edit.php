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
$sql_p = "SELECT * FROM tblprojects WHERE pid = $vid";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_project = mysqli_query($vconntekiah, $sql_p);

//CREATE AN ASSOCIATIVE ARRAY
$rs_project_rows = mysqli_fetch_assoc($rs_project);
$vnid = $rs_project_rows['pid'];
$vcontent = $rs_project_rows['pbody'];
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
        <h2>Edit Projects</h2>
        <p>&nbsp;</p>
        <!--kval-->
        
        <form method="post" action="projects-edit-process.php">
       
         	<legend><!-- REMEMBER TO ADD REQUIRED -->
         	<label><strong>News Article</strong></label>
        	<textarea name="txtbody"><?php if($rs_project_rows['pbody'] == 'na'){echo '';} else {echo $rs_project_rows['pbody'];} ?></textarea>
            <script>toolbar('txtbody');</script>
            </legend>
            
        <input type="hidden" name="txtid" value="<?php if(isset($rs_project_rows['pid']) && $rs_project_rows['pid'] != '') {echo $rs_project_rows['pid'];} ?>"> 
        <br>
        <input type="submit" name="btnsave" value="Update">  
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
