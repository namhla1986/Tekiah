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
$sql_n = "SELECT * FROM tblnews WHERE nid = $vid";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_news = mysqli_query($vconntekiah, $sql_n);

//CREATE AN ASSOCIATIVE ARRAY
$rs_news_rows = mysqli_fetch_assoc($rs_news);
$vnid = $rs_news_rows['nid'];
$vcontent = $rs_news_rows['ncontent'];
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
        <h2>Edit News</h2>
        <p>&nbsp;</p>
        <!--kval-->
        
        <form method="post" action="news-edit-process.php">
       
         	<label><strong>Title</strong></label>
        	<input type="text" name="txttitle" autofocus value="<?php if($rs_news_rows['ntitle'] == 'na'){echo '';} else {echo $rs_news_rows['ntitle'];} ?>">
            <br><br>
         	<legend><!-- REMEMBER TO ADD REQUIRED -->
         	<label><strong>News Summary</strong></label>
        	<textarea name="txtsummary"><?php if($rs_news_rows['nsummary'] == 'na'){echo '';} else {echo $rs_news_rows['nsummary'];} ?></textarea>
            <script>toolbar('txtsummary');</script>
            </legend>
            <br><br>
         	<legend><!-- REMEMBER TO ADD REQUIRED -->
         	<label><strong>News Article</strong></label>
        	<textarea name="txtcontent"><?php if($rs_news_rows['ncontent'] == 'na'){echo '';} else {echo $rs_news_rows['ncontent'];} ?></textarea>
            <script>toolbar('txtcontent');</script>
            </legend>
            
            <br>
            
            <label><strong>Uploaded Images</strong></label>
            <br><br>
            <?php if($rs_news_rows['nimgthumb'] != 'na') {?>
            <img src="<?php echo $_SESSION['svabsuri'] . 'cms/uploaded-images/' . $rs_news_rows['nimgthumb']; ?>" width="100" height="100">
            <?php }?>
            
        	<input type="file" name="txtimglarge">
            <input type="text" name="txtimglargecaption" placeholder="Image 1 caption" value"<?php if($rs_news_rows['nimglargecaption'] == 'na'){echo '';} else {echo $rs_news_rows['nimglargecaption'];} ?>">
         
         
    	<input type="hidden" name="oldimgthumb" value="<?php echo 'nimgthumb'; ?>">
    	<input type="hidden" name="oldimglarge" value="<?php echo 'nimglarge'; ?>">
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_news_rows['nid']) && $rs_news_rows['nid'] != '') {echo $rs_news_rows['nid'];} ?>"> 
    
        <input type="submit" name="btnsave" value="Update">  
           
        </form>
        
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
</html>
