<?php require("inc-public-predoctype.php"); ?>
<?php 
//CREATE SQL STATEMENT
$sql_about = "SELECT * FROM tblabout ORDER BY acontent ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_a= mysqli_query($vconntekiah, $sql_about);

//CREATE AN ASSOCIATIVE ARRAY
$rs_about = mysqli_fetch_assoc($rs_a);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-head-content.php"); ?>

<script type='application/ld+json'> 
        {
          "@context": "http://www.schema.org",
          "@type": "about",
          "name": "Brian Keet",
          "jobTitle": "Director",
          "url": "http://tekiahfoundation.blogspot.co.za/",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "No 2 Greyland Rd, Ferness Estate, Ottery",
            "addressLocality": "Cape Town",
            "addressRegion": "Western Cape",
            "postalCode": "7800",
            "addressCountry": "South Africa"
          },
          "email": "briankeet@yahoo.com",
          "telephone": "+27766261024"
        }
        </script>
        
        <style>
        
		#content_left_article_1 img{
			padding: 20px 140px;
			}
        
        </style>
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
		<h1><strong>Support Us</strong></h1>  
        <article>
        
        <p>Theres a number a ways that you can show your support for our organization. We are currently in need of <a href="http://localhost/tekiah/volunteer-form-ajax.php">volunteers</a> and sponsors who are willing to lend a helping hand.</p>
        
        <p>Volunteering your time means not only do you give of your time but that you also make a meaningful contribution 				by putting a smile on our childrens faces. We welcome everyone from all walks of life to our lovely foundation.</p>
        </article>
        <img src="sources/images/volunteer_banner_02.jpg" width="360" height="200">
        
	</article>

</section>

<!-- Appear only on tablet layout and higher -->
<section id="content_right">

    <!-- CONTENT RIGHT -->
    <?php require('inc-right-column.php'); ?>
    
</section>
</section>

<footer id="my_footer">

<!-- FOOTER CONTENT -->
<?php require('inc-footer-content.php'); ?>

</footer>

<br class="clear_float" />

</section>

</body>
</html>
