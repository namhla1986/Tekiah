<?php require("inc-public-predoctype.php"); ?>
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

//CREATE SQL STATEMENT
$sql_volunteer = "SELECT * FROM tblvolunteers";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_volunteer = mysqli_query($vconntekiah, $sql_volunteer);

//CREATE AN ASSOCIATIVE ARRAY
$rs_volunteer_rows = mysqli_fetch_assoc($rs_volunteer);

$vvid = $rs_volunteer_rows['vid'];

$vmsg = $rs_volunteer_rows['vmsg'];
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-head-content.php"); ?>
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
<!-- WRAPPER -->
<section id="wrapper">

<!-- HEADER -->
<?php require('inc-header-content.php'); ?>

<!-- Appear only on tablet layout and higher. Replaces mobile nav bar -->
<!--Tablet and higher nav bar -->
<?php require('inc-navbar-desktop.php'); ?>

<!-- CONTENT -->
<section id="content_container">

<!-- MOBILE HEADER WITH NAV ICON -->
<?php require('inc-navbar-mobile.php'); ?>
<!-- NAV -->

<?php require('inc-navbar-mobile.php'); ?>

<!-- Appear on all layouts -->
<section id="content_left">

<!-- Appear on Desktop only -->
<article id="content_left_article_1">
<!-- SIGN IN HEADING AND FORM-->

	<h1>Volunteer With Us</h1>

        <form action="volunteer-form-process.php" method="post">
        
        	<!-- NAME CONTROL ELEMENT -->
        		<div>
        		<label for="txtname">Name<br>
                <input type="text" name="txtname" placeholder="Name" autofocus required>
                </label>
                </div>
        		<div>
                <!-- SURNAME CONTROL ELEMENT -->
                <label for="txtsurname">Surname<br>
                <input type="text" name="txtsurname" placeholder="Surname" autofocus required>
                </label>
                </div>
        		<div>
            	<!-- EMAIL CONTROL ELEMENT -->
                <label for="txtemail">Email<br>
                <input type="text" name="txtemail" placeholder="Email" required>
                </label>
                </div>
        		<div>
            	<!-- MESSAGE CONTROL ELEMENT -->
                <label for="txtmsg">Leave a message<br>
            	<textarea name="txtmsg" placeholder="Message(optional)" ></textarea>
                </label>
                </div>
        		<div>
            	<!-- NEWSLETTER CONTROL ELEMENT -->
                <label for="txtsubscribe">Subscribe to our newsletter<br>
                <input type="radio" name="txtbox" value="yes" required checked>yes<br>
                </label>
                </div>
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_volunteer_rows['vid']) && $rs_volunteer_rows['vid'] != '') {echo $rs_volunteer_rows['vid'];} ?>"> 
        
      <div class="g-recaptcha" data-sitekey="6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW"></div>
      
        <input type="submit" name="btnsubmit" value="Submit">  
        
                </form>
                
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
</article>

<article id="content_left_article_2">Content</article>

</section>

<!-- Appear only on tablet layout and higher -->
<section id="content_right">Content Right</section>

    <!-- CONTENT RIGHT -->
    <?php require('inc-right-column.php'); ?>

</section>

<footer id="my_footer">

<!-- FOOTER CONTENT -->
<?php require('inc-footer-content.php'); ?>

</footer>

<br class="clear_float" />

</section>

</body>
</html>
