<?php require ('inc-functions.php'); ?>
<?php
//CHECK IF FORM WAS SUBMITTED
if(isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {
	
		$vimgthumb = $_POST['txtimgthumb'];
		$vimglarge = $_POST['txtimglarge'];
		$vimagelargecaption = $_POST['txtimglargecaption'];
	
	
	//EXTRACT VALUES WE NEED FROM THE $_FILES SYSTEM ARRAY CURRENTLY IN THE BROWSER'S TEMP MEMORY 
	$image_file = $_FILES['txtselfie']['name'];
	$file_name = strtolower(pathinfo($image_file, PATHINFO_BASENAME)); //GET THE BASENAME. USE BUILT IN FUNCTION WHERE POSSIBLE
	$file_ext = pathinfo($file_name, PATHINFO_EXTENSION); //USE BUILT IN FUNCTION WHERE POSSIBLE 
	$file_size = $_FILES['txtselfie']['size'];
	$file_tmp = $_FILES['txtselfie']['tmp_name']; //TMP NAME ALLOCATED WHILE FILE IS SITTING IN THE BROWSER TEMP MEMORY
	$file_error = $_FILES['txtselfie']['error'];

	if($file_name !== '') {
		//USE GETIMAGESIZE() FUNCTION TO VERIFY THAT IT IS INDEED AN IMAGE AS EXTENSIONS CAN BE EASILY CHANGED BY USER
		$imagesize = getimagesize($file_tmp);
		
		if(!$imagesize) { 
			
			header('Location: news-add-new.php?key=notanimage');
			exit();
		
			} else {
		
				//CALL THE IMAGEUPLOAD() TO PROCESS AND UPLOAD THE ORIGINAL IMAGE TO A SERVER LOCATION TO KEEP AS A GENERIC IMAGE
				$vimgoriginal = imageUpload($file_name, $file_ext, $file_size, $file_tmp, $file_error);
				
				//DEFINE THE ORIGINAL IMAGE PATH THAT HAS PASSED ALL THE TESTS FROM THE SERVER LOCATION SO WE CAN MANIPULATE IT 
				$vimgpathoriginal = 'uploaded-images/'.$vimgoriginal;
				
				if($file_ext === 'jpeg' || $file_ext === 'jpg') {
							
				//RESIZE AND SAVE IN SERVER FOLDER
				$jpegimagefrmsrc = imagecreatefromjpeg($vimgpathoriginal); //CREATE A NEW JPEG IMAGE FILE
				$newimg = imageResize($jpegimagefrmsrc); //WE CALL THE IMAGE RESIZE FUNCTION
				$newimgbasename = 'thumb_'.$vimgoriginal; //PREFIX OUR THUMBNAIL WITH THUMB_
				$vimgthumbfilepath = 'cms/uploaded-images/'.$newimgbasename; //DEFINE THE FILE PATH FOR OUR NEW JPEG IMAGE
				imagejpeg($newimg, $vimgthumbfilepath, 100);//THIS WRITES THE NEW JPEG IMAGE TO A FILE WITH 100% QUALITY 
				
				//CLEAN UP TMP FILES AND OBJECTS NO LONGER REQUIRED TO SAVE STORAGE SPACE
				imagedestroy($jpegimagefrmsrc);
				imagedestroy($thumb_tmp);
					
					} elseif ($file_ext === 'png') {
						
						$pngimagefrmsrc = imagecreatefrompng($vimgpathoriginal); //CREATE A NEW PNG FILE
						$newimg = imageResize($pngimagefrmsrc); //WE CALL THE IMAGE RESIZE FUNCTION
						$newimgbasename = 'thumb_'.$vimgoriginal; //PREFIX OUR THUMBNAIL WITH THUMB_
						$vimgthumbfilepath = 'cms/uploaded-images/'.$newimgbasename; //DEFINE THE FILE PATH FOR OUR NEW JPEG IMAGE
						imagepng($newimg, $vimgthumbfilepath);//THIS WRITES NEW PNG IMAGE TO A FILE 
						
						//CLEAN UP TMP FILES AND OBJECTS NO LONGER REQUIRED TO SAVE STORAGE SPACE
						imagedestroy($pngimagefrmsrc);
						imagedestroy($thumb_tmp);
						} 
				
				//CONNECT TO MYSQL DATABASE
				require ('inc-conntekiah.php'); 
			
				//INSERT STATEMENT
				$sql_insert = sprintf("INSERT INTO tblnews (nimgthumb, nimglarge, nimglargecaption) VALUES (%s, %s, %s)",
					escapestring($vconntekiah, $vimgthumb, 'text'),
					escapestring($vconntekiah, $vimglarge, 'text'),
					escapestring($vconntekiah, $vimglargecaption, 'text')
					);
				
				$insert_result = mysqli_query($vconntekiah, $sql_insert);
				
				$last_id = mysqli_insert_id($vconntekiah);
			
				if($insert_result) {
					
					header ('Location: news-preview.php?key=success&kid='.$last_id.'');
					exit();
					
					} else {
						echo 'database not updated';
						exit();
						}	
			} 
			
	} else { header('Location: news-add-new.php?key=nofileselected');
	
	}
	
} else {

	header ('Location: news-add-new.php?key=formnotsubmitted');
	exit();
	}
?>
