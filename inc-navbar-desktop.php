<?php 
//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblprojects ORDER BY ptitle ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_p = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_project_rows = mysqli_fetch_assoc($rs_p);
$ptitle = $rs_project_rows['ptitle'];
$pid = $rs_project_rows['pid'];
?>
<div id="nav">
<ul>
<li><a href="http://localhost/tekiah/home.php">Home</a></li>
<li><a href="http://localhost/tekiah/about.php">About Us</a>
<ul>
      <li><a href="http://localhost/tekiah/mission.php">Mission</a></li>
      <li><a href="#">NGO</a></li>
      <li><a href="http://localhost/tekiah/staff.php">Staff</a></li>
    </ul>
</li>
 <li><a href="#">Projects</a>
    <ul>
        <?php do { ?>
      <li><a href="http://localhost/tekiah/projects/<?php echo str_replace(' ', '-', strtolower($ptitle)) . '/index.php?pid=' . $pid; ?>"><?php echo $rs_project_rows['ptitle']; ?></a></li>
        <?php } while ($rs_project_rows = mysqli_fetch_assoc($rs_p))?>
    </ul>
  </li>
<li><a href="http://localhost/tekiah/support-us.php">Support Us</a>
    <ul>
      <li><a href="http://localhost/tekiah/volunteer-form-ajax.php">Volunteer</a></li>
      <li><a href="#">Partnerships</a></li>
      <li><a href="#">General Enquiries</a></li>
    </ul>
  </li>
 <li><a href="http://localhost/tekiah/news.php">News</a>
    <ul>
      <li><a href="#">General Inquiries</a></li>
      <li><a href="#">Ask me a Question</a></li>
    </ul>
  </li>
<li><a href="http://localhost/tekiah/events.php">Events</a>
    <ul>
      <li><a href="#">General Inquiries</a></li>
      <li><a href="#">Ask me a Question</a></li>
    </ul>
  </li>
<li><a href="http://localhost/tekiah/gallery.php">Gallery</a>
    <ul>
      <li><a href="#">General Inquiries</a></li>
      <li><a href="#">Ask me a Question</a></li>
    </ul>
  </li>  
<li><a href="http://localhost/tekiah/contact.php">Contact Us</a>
    <ul>
      <li><a href="#">General Inquiries</a></li>
      <li><a href="#">Ask me a Question</a></li>
    </ul>
  </li></ul>
</div>
