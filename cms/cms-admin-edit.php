<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
$_SESSION['svadminsecurity'] = md5(md5(rand()));
$vsecurity = $_SESSION['svadminsecurity'];
?>
<?php 
//FUNCTION FOR DISPLAYING GENERAL VALIDATION WARNING MESSAGE: Value required
function valrequiredwarning($vkey){
	if(isset($_GET[$vkey]) && $_GET[$vkey] == '') {
		return '<div class="warning_msg">Value required</div>';
		}
	}
?>
<?php 
//FUNCTION FOR DISPLAYING RETURNED VALUES SHOULD VALIDATION FAIL
function valreturned($vkey){
	if(isset($_GET[$vkey]) && $_GET[$vkey] != '') {
		return $_GET[$vkey];
		}
	}
?>
<?php 
//GET VALUE OF THE kid FROM GET ARRAY
$vaid = $_POST['kid'];

//CREATE SQL STATEMENT
$sql_nl = "SELECT * FROM tbladministrator WHERE aid = $vaid";

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
        <h2>Update staff details</h2>
        <p>&nbsp;</p>
        
        <?php if(isset($_GET['k1']) && $_GET['k1'] === 'f') {?>
        <div class="warning_msg">Please fill in the required fields</div>
        <?php }?>
        
        
        <form method="post" action="cms-admin-add-new-process.php" id="frmnewsletter">
        
        <fieldset>
        
         <legend>General</legend>
         
        	<label>Name*</label>
             <?php echo valrequiredwarning('k2'); ?> 
             <!-- REMEMBER TO ADD REQUIRED -->
        	<input type="text" name="txtname" autofocus value="<?php echo valreturned('aname'); ?>">
            
            
            <label>Surname*</label>
            <?php echo valrequiredwarning('k3'); ?>  
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtsurname" autofocus value="<?php echo valreturned('asurname'); ?>">
           
          	
            <label>Email*</label>
            <?php echo valrequiredwarning('k4'); ?> 
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtemail" autofocus value="<?php echo valreturned('aemail'); ?>">
            
            <label>Username*</label>
            <?php echo valrequiredwarning('k5'); ?> 
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtusername" autofocus value="<?php echo valreturned('ausername'); ?>">
            
            <label>Password*</label>
            <?php echo valrequiredwarning('k6'); ?> 
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtpassword" autofocus value="<?php echo valreturned('apassword'); ?>">
         </fieldset>  
         
     
           
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rsnl_rows['aid']) && $rsnl_rows['aid'] != '') {echo $rsnl_rows['aid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Save">  
           
        
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
