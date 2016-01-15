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
<script>
function insertrecord(){
	
	
	if (window.XMLHttpRequest){
		//code for IE, Firefox, Chrome, Opera, Safari
		var xmlhttp = new XMLHttpRequest();
		} else {//code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (xmlhttp.responseText == "success_ml"){
					
					document.getElementById("frmvolunteer").style.display = "none";
					document.getElementById("msg_success").innerHTML = "Thank you for wanting to volunteer your services.<br> We will contact you shortly.<br> You have also been subscribed to our mailing list.";
					
					} else if (xmlhttp.responseText == "success"){
				
					document.getElementById("frmvolunteer").style.display = "none";
					document.getElementById("msg_success").innerHTML = "Thank you for wanting to volunteer your services.<br> We will contact you shortly.";				
					}
				}
			}	
			
	vname = document.getElementById('txtname').value;
	vsurname = document.getElementById('txtsurname').value;
	vemail = document.getElementById('txtemail').value;
	vmailinglist = document.getElementById('txtmailinglist').value;
	vmsg = document.getElementById('txtmsg').value;
	
		if (vname === ''){
			document.getElementById('warning_name').innerHTML = 'name required';
			return false;
			}else if(vsurname === ''){
				document.getElementById('warning_surname').innerHTML = 'surname required';
				}else if(vemail === ''){
				document.getElementById('warning_email').innerHTML = 'email required';
				}	else if (vemail != ''){
					var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					if(!vemail.match(mailformat)){
					document.getElementById('warning_email').innerHTML = 'email required';
					
						return false;
						}else if(vmsg === ''){
							
					document.getElementById('warning_msg').innerHTML = 'message required';
						return false;
							}else {
					
						
			
	xmlhttp.open("GET", "volunteer-insert-process.php?txtname="+vname+"&txtsurname="+vsurname+"&txtemail="+vemail+"&txtmailinglist="+vmailinglist+"&txtmsg="+vmsg,true);
	xmlhttp.send();
							}
}
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
<h1>Volunteer form</h1>
        <div id="msg_success"></div>

        <form id="frmvolunteer">
        name<br>
        <div id="warning_name" class="warning_msg"></div>
        <input type="text" id="txtname"><br>
        surname<br>
        <div id="warning_surname" class="warning_msg"></div>
        <input type="text" id="txtsurname"><br>
		email<br>
        <div id="warning_email" class="warning_msg"></div>
        <input type="email" id="txtemail"><br>
        message<br><br>
        <div id="warning_message" class="warning_msg"></div>
        <textarea id="txtmsg"></textarea><br><br>
        subscribe me to your mailinglist<br><br>
        <select id="txtmailinglist">
        	<option value="yes">Yes</option>
        	<option value="no">No</option>
        </select>
        <br><br>
        <input type="button" value="send" onclick="insertrecord()">
        </form>
        
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

<br class="clear_float"/>

</section>

</body>
</html>
