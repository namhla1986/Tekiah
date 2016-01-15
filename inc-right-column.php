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
<script>
function insertemail(){
	
	
	if (window.XMLHttpRequest){
		//code for IE, Firefox, Chrome, Opera, Safari
		var xmlhttp = new XMLHttpRequest();
		} else {//code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (xmlhttp.responseText == "success_ml"){
					
					document.getElementById("frmmailinglist").style.display = "none";
					document.getElementById("msg_success_mail").innerHTML = "Thank you.<br> You have also been subscribed to our mailing list.";
					
					}
				}
			}	
			
	vemail = document.getElementById('txtemail').value;
			if (vemail === '') {
				document.getElementById('warning_email').innerHTML = 'email required';
				return false;
				} 
				
	xmlhttp.open("GET", "inc-right-column-mail-process.php?txtemail="+vemail,true);
	xmlhttp.send();
	
}
</script>  
<!-- Appear only on tablet layout and higher -->
<section id="">

<div id="msg_success_mail"></div>

		<div class="subscribe">
        
        <h1><strong>Subscribe to our newsletter</strong></h1><br>
        
        <form id="frmmailinglist">
        <br>
		<strong>Email address</strong><br>
        <div id="warning_email" class="warning_msg"></div>
        <input type="email" id="txtemail"><br><br>
        <input type="button" value="subscribe" onclick="insertemail()">
        </form>
        </div>
        		<h1><strong>Top Stories</strong><h1>
        <?php do { ?>
        
                <div class="newsclips">
                <h2><a href="news-display.php?kid=<?php echo $rs_news_rows['nid']; ?>"> Tekiah News | <?php echo $rs_news_rows['ntitle']; ?></a></h2>
                <p><?php echo $rs_news_rows['ndatetime']; ?></p>
                </div>
                
        <?php } while ($rs_news_rows = mysqli_fetch_assoc($rs_n))?>
        
        <a href="http://localhost/tekiah/volunteer-form-ajax.php"><img src="sources/images/volunteer.png" width="300" height="61"/></a>
        
</section>
