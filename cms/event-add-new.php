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
        <h2>Add new events</h2>
        <p>&nbsp;</p>
        <!--kval-->
        <?php if(isset($_GET['kvalidation']) && $_GET['kvalidation'] === 'failed') {?>
        <p>Please fill in the required fields</p>
        <?php } ?>
        <form method="post" action="event-add-new-process.php">
        <fieldset>
       		<legend><strong>Add an event</strong></legend>
            <br>
         	<label><strong>Title</strong></label>
             <?php echo valrequiredwarning('ktitle'); ?> 
        	<input type="text" name="txttitle" autofocus value="<?php echo valreturned('etitle'); ?>">
             <br><br>
         	<label><strong>Date</strong></label>
             <?php echo valrequiredwarning('kstartdate'); ?> 
        	<input type="date" name="txtstartdate" value="<?php echo valreturned('estartdate'); ?>"> 
            <br><br>
         	<label><strong>Event details</strong></label>
             <?php echo valrequiredwarning('kcontent'); ?> 
        	<textarea name="txtcontent"><?php echo valreturned('econtent'); ?></textarea>
            <script>toolbar('txtcontent');</script>
         
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
    		<br><br>
        <input type="submit" name="btnsave" value="Save">  
        </fieldset>
        </form>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
