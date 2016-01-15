<?php require("inc-public-predoctype.php"); ?>
<?php 
//CREATE SQL STATEMENT
$sql_n = "SELECT * FROM tblnews ORDER BY ntitle ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_n = mysqli_query($vconntekiah, $sql_n);

//CREATE AN ASSOCIATIVE ARRAY
$rs_news_rows = mysqli_fetch_assoc($rs_n);
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
		<h1><strong>News</strong></h1>  
        <?php do { ?>
        
        <article class="newspiece">
        
        		<figure class="smallimg">
				<img src="cms/uploaded-images/<?php echo $rs_news_rows['nimgthumb'] ?>">
                <figcaption>photo</figcaption>
                </figure>
                
                <div class="newsblock">
                <h2><a href="news-display.php?kid=<?php echo $rs_news_rows['nid']; ?>"> Tekiah News | <?php echo $rs_news_rows['ntitle']; ?></a></h2>
                <p><?php echo $rs_news_rows['ndatetime']; ?></p>
                <p><?php echo $rs_news_rows['nsummary']; ?></p>
                </div>
                
                
                
				<div class="clear_float"></div>
                
                <hr>
                
        </article>
        <?php } while ($rs_news_rows = mysqli_fetch_assoc($rs_n))?>
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
