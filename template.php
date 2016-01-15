<?php require('inc-public-predoctype'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- This piece of valid code tells mobile devices not to zoom out as a default. -->
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Tekiah Foundation</title>

<!-- HEAD CONTENT -->
<?php require('inc-head-content.php'); ?>

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
<h1>Heading H1</h1>
<h2>Heading H2</h2>
<h3>Heading H3</h3>
<h4>Heading H4</h4>
<h5>Heading H5</h5>
<h6>Heading H6</h6>
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
<!-- jQUERY LIBRARY AND CUSTOM CODE -->
<?php require('inc-jquery-post-closing-body.php'); ?>
</html>
