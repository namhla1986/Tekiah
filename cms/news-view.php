<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//GENERATE ENCRYPTED SESSION VARIABLE
 $_SESSION['svadminsecurity'] = md5(md5(rand()));
 $vsecurity = $_SESSION['svadminsecurity'];
 
?>
<?php 
//CREATE SQL STATEMENT
$sql_news = "SELECT * FROM tblnews ORDER BY ntitle ASC";

//CONNECT TO THE MYSQL SERVER 
require('inc-conntekiah.php');

//EXECUTE SQL STATEMENT
$rs_news = mysqli_query($vconntekiah, $sql_news);

//CREATE AN ASSOCIATIVE ARRAY
$rs_news_rows = mysqli_fetch_assoc($rs_news);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>

</head>

<body>

<div id="main_container">

<div id="branding_bar">
<?php require("inc-cms-branding-bar.php"); ?>
</div>

<div id="body_column_left_container">

    <div id="body_column_left">
        <?php require("inc-cms-accordion_menu.php"); ?>
    </div>
    
</div>

<div id="body_column_right_container">
    
    <div id="body_column_right">
        <h2>List of News</h2>
      <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <?php do { ?>
        
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "headline": <?php echo json_encode($rs_news_rows['ntitle'], 64 | 128 | 256); ?>,
  "Image": {
	  "@type": "ImageObject",
	  "thumbnail": 
	  	[
		<?php echo json_encode(
		"https://namhla-mankune.webportfolio.capetown/tekiah/uploaded-images/" . $rs_news_rows['nimglarge']); ?> 
		],
		
	"caption": <?php echo json_encode($rs_news_rows['nimglargecaption']); ?>
  },
  "datePublished": <?php echo json_encode($rs_news_rows['nmodified'], 64 | 128 | 256); ?>,
  "description": <?php echo json_encode($rs_news_rows['ncontent'], 64 | 128 | 256); ?>,
}
</script>
        
        <tr>
        
        	<td>&nbsp;</td>
          	<td style=""><strong>News Title</strong></td>
        </tr>
        
        
       
        		<td><img src="uploaded-images/<?php echo $rs_news_rows['nimgthumb'] ?>"></td>
                <td><?php echo $rs_news_rows['ntitle']; ?>
         			<p><?php echo $rs_news_rows['nsummary']; ?></p>
                </td>

				<tr>
				<td align="right" style="float:right;">
                
                              
                	<form method="post" action="news-preview.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_news_rows['nid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Preview">
                    </form>
                </td>
                
				<td align="right">
                
                              
                	<form method="post" action="news-edit.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_news_rows['nid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Edit">
                    </form>
                </td>
                
				<td align="right">
                
				<?php if(($_SESSION['svadminaccess'] === 'a') && ($_SESSION['svadminid'] != $rs_news_rows['nid'] )) { ?>                
                	<form method="post" action="news-delete.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_news_rows['nid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="submit" value="Delete">
                    </form>
                    <?php } else {echo '&nbsp;'; }?>
                </td>
                
				<td align="right">
                
				<?php if(($_SESSION['svadminaccess'] === 'a')) { ?>                
                	<form method="post" action="news-status-update-process.php">
                    
                    	<input type="hidden" name="kid" value="<?php echo $rs_news_rows['nid']; ?>">
                        
                        <input type="hidden" name="txtsecurity" value="<?php echo $vsecurity; ?>">
                        
                        <input type="hidden" name="txtstatus" value="<?php echo $rs_news_rows['nstatus']; ?>">
                        
                        <input type="submit" value="<?php if($rs_news_rows['nstatus'] === 'i') {echo 'active';} else {echo 'inactive';}?>">
                    </form>
                    
                <?php } ?>
                
                </td>
         <td></td>
         </tr>
         
         <tr>
         
         
         </tr>

        <?php } while ($rs_news_rows = mysqli_fetch_assoc($rs_news))?>
        
        </table>
    </div>
        
</div>

<div class="clearfloat_both"></div>
                
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</html>
