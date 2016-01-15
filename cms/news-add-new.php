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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
        <h2>Add News</h2>
        <p>&nbsp;</p>
        <!--kval-->
        <?php if(isset($_GET['kvalidation']) && $_GET['kvalidation'] === 'failed') {?>
        <p>Please fill in the required fields</p>
        <?php } ?>
        <form method="post" action="news-add-new-process.php" enctype="multipart/form-data" >
        <fieldset>
       		<legend><strong>Add News</strong></legend>
            <br>
         	<label><strong>Title</strong></label>
             <?php echo valrequiredwarning('ktitle'); ?> 
        	<input type="text" name="txttitle" autofocus value="<?php echo valreturned('ktitle'); ?>">
            <br><br>
         	<label><strong>Date</strong></label>
             <?php echo valrequiredwarning('kdate'); ?> 
        	<input type="date" name="txtdatetime" value="<?php echo valreturned('kdate'); ?>"> 
            <br><br>
         	<label><strong>News Summary</strong></label>
             <?php echo valrequiredwarning('ksummary'); ?> 
        	<textarea name="txtsummary"><?php echo valreturned('ksummary'); ?></textarea>
            <script>toolbar('txtsummary');</script>
            <br><br>
         	<label><strong>News details</strong></label>
             <?php echo valrequiredwarning('kcontent'); ?> 
        	<textarea name="txtcontent"><?php echo valreturned('kcontent'); ?></textarea>
            <script>toolbar('txtcontent');</script>
    	<br><br>
            <label><strong>Upload Images</strong></label>
				<input type="file" name="txtselfie">
                
            <label><strong>Caption*</strong></label>
                <input type="text" name="txtcaption">
                
				<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                <br>
				<input id="btn_upload" type="submit" value="Upload"> 
                
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
    	<br><br>
        
        </fieldset>
        </form>
			</form>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
