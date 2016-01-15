<?php require("inc-public-predoctype.php"); ?>
<?php 
$_SESSION['svadminsecurity'] = md5(md5(rand()));
$vsecurity = $_SESSION['svadminsecurity'];
?>
<?php 
//CREATE SQL STATEMENT
$sql_contact = "SELECT * FROM tblcontact";
//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_c = mysqli_query($vconntekiah, $sql_contact);

//CREATE AN ASSOCIATIVE ARRAY
$rs_contact_rows = mysqli_fetch_assoc($rs_c);

?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-head-content.php"); ?>
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
		<article>
		<h1><strong>Contact Us</strong></h1>  
        
        <p>
        <?php echo $rs_contact_rows['ccontent']; ?>
        </p>
        </article>
        <br>
<div id="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6621.405615035143!2d18.417757180015997!3d-33.92304769519432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sza!4v1444895021875" width="80%" height="60%" frameborder="0" style="border:0" allowfullscreen></iframe>  
      
</div>
        
		<div id="form">
	<h3>Write to Us</h3>

        <form action="contact-form-process.php" method="post">
        
        	<!-- NAME CONTROL ELEMENT -->
        		<div>
        		<label for="txtname">Name<br>
                <input type="text" name="txtname" placeholder="Name" autofocus required>
                </label>
                </div>
                <br>
        		<div>
                <!-- SURNAME CONTROL ELEMENT -->
                <label for="txtsurname">Surname<br>
                <input type="text" name="txtsurname" placeholder="Surname" autofocus required>
                </label>
                </div>
                <br>
        		<div>
            	<!-- EMAIL CONTROL ELEMENT -->
                <label for="txtemail">Email<br>
                <input type="text" name="txtemail" placeholder="Email" required>
                </label>
                </div>
                <br>
        		<div>
            	<!-- MESSAGE CONTROL ELEMENT -->
                <label for="txtmsg">Leave a message<br>
            	<textarea name="txtmsg" placeholder="Message(optional)" ></textarea>
                </label>
                </div>
                <br>
    	<input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
        
        <input type="hidden" name="txtid" value="<?php if(isset($rs_contact_rows['cfid']) && $rs_contact_rows['cfid'] != '') {echo $rs_contact_rows['cfid'];} ?>"> 
        
      <div class="g-recaptcha" data-sitekey="6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW"></div>
      
        <input type="submit" name="btnsubmit" value="Submit">  
        
                </form>
                
    <script src='https://www.google.com/recaptcha/api.js'></script>
<br class="clear_float" />
</div>

	</article>

</section>

<!-- Appear only on tablet layout and higher -->
<section id="content_right">

    <!-- CONTENT RIGHT -->
    <?php require('inc-right-column.php'); ?>
</section></section>

<footer id="my_footer">

<!-- FOOTER CONTENT -->
<?php require('inc-footer-content.php'); ?>

</footer>

<br class="clear_float" />

</section>

</body>
</html>
