<?php 
//CREATE SQL STATEMENT
$sql_t = "SELECT * FROM tblprojects ORDER BY ptitle ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_p = mysqli_query($vconntekiah, $sql_t);

//CREATE AN ASSOCIATIVE ARRAY
$rs_project_rows = mysqli_fetch_assoc($rs_p);
?>
<div class="applemenu">

<!-- ADMIN STAFF STARTS -->
  <div class="silverheader">
		<a href="#">Administrators</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="cms-admin-display.php">Display</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="cms-admin-add-new.php">Add new</a></td>
  </tr>
    </table>
  </div>
<!-- ADMIN STAFF ENDS -->



<!-- ABOUT STARTS -->
  <div class="silverheader">
		<a href="#">About</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="about-view.php">View</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="about-view-edit.php">Edit</a></td>
  </tr>
    </table>
  </div>
<!-- ABOUT ENDS -->

<!-- VOLUNTEER LIST STARTS -->
  <div class="silverheader">
		<a href="#">Volunteers</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="volunteer-view.php">Archive</a></td>
  </tr>
    </table>
  </div>
<!--VOLUNTEER LIST ENDS -->

<!-- MAILING LIST STARTS -->
  <div class="silverheader">
		<a href="#">Mailing List</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="mailinglist-view.php">Archive</a></td>
  </tr>
    </table>
  </div>
<!-- MAILING LIST ENDS -->

<!-- NEWS STARTS -->
  <div class="silverheader">
		<a href="#">News</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="news-view.php">Archive</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="news-add-new.php">Post news</a></td>
  </tr>
    </table>
  </div>
<!-- NEWS ENDS -->


<!-- EVENTS STARTS -->
  <div class="silverheader">
		<a href="#">Events</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="event-view.php">View</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="event-add-new.php">Add New Events</a></td>
  </tr>
    </table>
  </div>
<!-- EVENTS ENDS -->

<!-- STAFF STARTS -->
  <div class="silverheader">
		<a href="#">Staff</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="staff-view.php">Display</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="staff-add-new.php">Add new</a></td>
  </tr>
    </table>
  </div>
<!-- STAFF ENDS -->

<!-- CONTACT MESSAGES STARTS -->
  <div class="silverheader">
		<a href="#">Contact Messages</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="contact-msg-view.php">Display</a></td>
  </tr>
    </table>
  </div>
<!-- CONTACT MESSAGES ENDS -->

<!-- CONTACT STARTS -->
  <div class="silverheader">
		<a href="#">Contact</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="contact-view.php">Display</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="contact-edit.php">Edit</a></td>
  </tr>
    </table>
  </div>
<!-- CONTACT ENDS -->

<!-- PROJECTS STARTS -->
  <div class="silverheader">
		<a href="#">Projects</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
    
        <?php do { ?>
          <tr>
                <td align="left" class="accmenu">
                <a href="projects-view.php?kid=<?php echo $rs_project_rows['pid'] ?>"><?php echo $rs_project_rows['ptitle'] ?>
                </a>
                </td>
          </tr>
        <?php } while ($rs_project_rows = mysqli_fetch_assoc($rs_p))?>
          <tr>
                <td align="left" class="accmenu">
                <a href="projects-add-new.php">Add new  
                </a>
                </td>
          </tr>
    </table>
  </div>
<!-- PROJECTS ENDS -->
</div>
