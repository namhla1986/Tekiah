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
<?php require("inc-cms-branding-bar.php");  ?>
</div>

<div id="body_column_left_container">

    <div id="body_column_left">
        <?php require("inc-cms-accordion_menu.php"); ?>
    </div>
    
</div>

<div id="body_column_right_container">
    
    <div id="body_column_right">
        <h2>Add new staff member</h2>
        <p>&nbsp;</p>
        <!--kval-->
        <?php if(isset($_GET['k1']) && $_GET['k1'] === 'f') {?>
        <p>Please fill in the required fields</p>
        <?php } ?>
        
        <form method="post" action="staff-add-new-process.php" id="frmnewsletter">
        
        <fieldset>
        
         <legend><strong>General Details</strong></legend>
         
            <br><br>
            <label><strong>Name*</strong></label>
            <?php echo valrequiredwarning('k3'); ?>  
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtname" value="<?php echo valreturned('k3'); ?>">
           <br><br>
            <label><strong>Surname*</strong></label>
            <?php echo valrequiredwarning('k3'); ?>  
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtsurname" value="<?php echo valreturned('k3'); ?>">
            <br><br>
            <label><strong>Email*</strong></label>
            <?php echo valrequiredwarning('k3'); ?>  
            <!-- REMEMBER TO ADD REQUIRED -->
     		<input type="text" name="txtemail" value="<?php echo valreturned('k3'); ?>">
            <br><br>
         </fieldset>  
         
         <br>
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rsnl_rows['sid']) && $rsnl_rows['sid'] != '') {echo $rsnl_rows['sid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Save">  
           
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
