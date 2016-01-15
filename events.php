<?php require("inc-public-predoctype.php"); ?>
<?php 
//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblevents ORDER BY etitle ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_t = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_events = mysqli_fetch_assoc($rs_t);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-head-content.php"); ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Event",
  "name": <?php echo json_encode($rs_events_rows['etitle'], 64 | 128 | 256); ?>,
  "location": {
	  "@type": "cape town",
	  "name": "Hotel",
	  "address": "Loop Street"
  },
  "startDate": <?php echo json_encode($rs_events_rows['estartdate'], 64 | 128 | 256); ?>,
  "description": <?php echo json_encode($rs_events_rows['econtent'], 64 | 128 | 256); ?>
}
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
		<h1><strong>Events</strong></h1>  
        <?php do { ?>
        <div class="eventsblock">
        
        <h3>Tekiah Events | <?php echo $rs_events['etitle']; ?></h3>
        
        <h6><?php echo $rs_events['edate']; ?></h6>
        
        <?php echo $rs_events['econtent']; ?>
        </div>
        <hr>
        <?php } while ($rs_events = mysqli_fetch_assoc($rs_t))?>
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
