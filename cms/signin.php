<?php session_start(); ?>
<?php 
$_SESSION['svadminsecurity'] = md5(md5(rand()));
$vsecurity = $_SESSION['svadminsecurity'];
?>
<?php
$vhostlive='http://www.namhla-mankune.webportfolio.capetown/tekiah/';
$vhostlocal='localhost';

if($_SERVER['HTTP_HOST'] == 'localhost'){
	
	$_SESSION['svabsuri'] = 'http://localhost/tekiah/';
}else{
	$_SESSION['svabsuri'] ='http://www.namhla-mankune.webportfolio.capetown/tekiah/';
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<!-- This piece of valid code tells mobile devices not to zoom out as a default. -->
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Tekiah Foundation</title>

<!--#################### TEACHES OLDER BROWSERS HTML5 ######################## -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--#################### IE BUG FIX ######################## -->
<!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- 
Image resizer script.

The code doesn't work in IE6 or less, so I suggest the following
conditionally-commented code in your <head> be used to implement the
JavaScript on your RWD website
-->

<!--[if ! lte IE 6]><!-->
<script type="text/javascript" src="imgsizer.js"></script>
<script type="text/javascript">
addLoadEvent(function() {
if (document.getElementById && document.getElementsByTagName) {
var aImgs =
document.getElementById("content").getElementsByTagName("img");
imgSizer.collate(aImgs);
}
});
</script>
<!--<![endif]-->

<!-- 
The following script allows all browsers to support media queries in CSS.
-->

<!--[if lt IE 9]>
<script src="http://css3-mediaqueriesjs.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="stylesheets/cssmain.css">
</head>

<body>
<!-- WRAPPER -->
<section id="wrapper">

<!-- HEADER -->
<header id="header_container">
</header>

<!-- Appear only on tablet layout and higher. Replaces mobile nav bar -->
<!--Tablet and higher nav bar -->
<nav id="normal_nav">

        
          <div class="clear_float"></div>
    </ul>
</nav>
<!-- CONTENT -->
<section id="content_container">
        <!-- MOBILE HEADER WITH NAV ICON -->
      	<header id="mobile_header">
        
            <h1></h1>
                
            <nav></nav>
            
        	<div class="clear_float"></div>
            
		</header>
<!-- NAV -->
<nav id="mobile_nav">
</nav>
<!-- Appear on all layouts -->
<section id="content_left">

<!-- Appear on Desktop only -->
<article id="content_left_article_1">

<!-- Appear on Desktop only -->
<article id="content_left_article_1">

<article id="block">
<!-- SIGN IN HEADING AND FORM-->
	<img src="../sources/icons/flower.png" id="flower">
    <h1><strong>Tekiah Foundation</strong></h1>
    <div class="clear_float"></div>
	<h1>CMS Tekiah Admin Sign In</h1>


	<?php if((isset($_GET['ksignin']) && $_GET['ksignin'] === 'failed') || (isset($_GET['kvalidation']) && $_GET['kvalidation'] === 'failed')){ ?>
	
    <p>ERROR: Sign in failed. Please try again. <a href="signin-failed.php">Lost your password?</a></p>
    
    <?php } ?>

	<?php if((isset($_GET['ksf']) && $_GET['ksf'] === 'success')){?>
    
    <p class="msgwarning">Your email has been sent successfully</p>
    
    <p>&nbsp; </p>
    
	<?php } ?>
    
    
   <?php if(isset($_GET['kpwreset']) && $_GET['kpwreset'] === 'yes'){ ?>
   
   <div class="msgwarning">Your password was reset. Please sign in with your new password</div>
   
   <p>&nbsp;</p>
   
   
   <?php }?>
    

	<form method="post" action="signin-process.php">

    <input type="text" name="txtusername" autocomplete="on" required autofocus placeholder="Email address">
    
    <br><br>
    
    <input type="password" name="txtpassword" autocomplete="on" required autofocus placeholder="Password">
    
    <br><br>
    
    <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
    
    <input type="submit" name="btnsignin" value="sign in">
    
</form>
	
    <br><br>
	<p><a href="signin-failed.php" id="showchangepw">Forgot Password</a></p>
 </article>  
   
</article>






</article>
<article id="content_left_article_2"></article>

</section>

<!-- Appear only on tablet layout and higher -->
<section id="content_right"></section>



</section>
<footer id="my_footer">

    <!-- Appear only on tablet layout and higher -->
	<p> Copyright &copy; 2013. Test Responsive Template</p>

</footer>

<br class="clear_float" />

</section>

</body>
</html>
