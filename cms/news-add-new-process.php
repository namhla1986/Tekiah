<?php require("inc-cms-pre-doctype.php"); ?>
<?php 
//CHECK IF THE FORM SUBMITTED
if (isset($_POST['txtsecurity']) && $_POST['txtsecurity'] === $_SESSION['svadminsecurity']) {

//FUNCTION FOR UPLOADING IMAGE TO A SERVER LOCATION FROM TEMP LOCATION
function imageUpload($file_name, $file_ext, $file_size, $file_tmp, $file_error) {
		
	$extensions = array("jpeg", "jpg", "png"); //DEFINE AN ARRAY OF PERMITTED FILE EXTENSIONS
		
	//CHECK IF THERE IS A VALUE AND TEST FOR ANY ERRORS
	if($file_error == 0) {
		
		$file_name = filter_var($file_name, FILTER_SANITIZE_STRING);//STRIPS TAGS
		//IF FILE EXTENSION IS JPEG EXCLUDE LAST 5 CHARACTERS IN STRING REPLACEMENT
		if ($file_ext == 'jpeg') { 
			//REMOVE UNWANTED CHARACTERS AND REAPLACE STRING WITH A UNIQUE ID GENERATED BASE ON CURRENT MICRO TIME 
			$file_name = substr_replace(preg_replace("/[-_ ()]/", " ", $file_name), uniqid(), 0, -5); 
			
			} else {
					$file_name = substr_replace(preg_replace("/[-_ ()]/", " ", $file_name), uniqid(), 0, -4); 
					}
		
		//THEN COMPARE FILE EXTENSION CORRESPOND WITH OUR ARRAY
		if(in_array($file_ext, $extensions) === true) {

			//THEN CHECK THAT FILE SIZE DOES NOT EXCEED 2MB//CHECK IF FORMAT IS VALID AND SIZE DOES NOT EXCEED MAX FILE SIZE
			if($file_size < 2000000) {
				
				//SAVE IMAGE TO DIRECTORY
				$upload_directory = 'uploaded-images/';
				$image_path = $upload_directory.$file_name; 
				
				//THIS IS WHERE THE IMAGE IS ACTUALLY SAVED INTO DIRECTORY
				$fileuploadresult = move_uploaded_file($file_tmp, $image_path);
				
				return $file_name;
				
				} else {
					
					header('Location: news-add-new.php?key=filesizeexceeded');
					exit();
					}

			} else {
				
				header('Location: news-add-new.php?key=filenotsupported');
				exit();
				}
				
		} else {
			
			header('Location: news-add-new.php?key=fileerror');
			exit();
			}	
}
?>
<?php 
//FUNCTION FOR RESIZING IMAGE
function imageResize($image) {
	//GET ORIGINAL DIMESIONS FOR SOURCE IMAGE AND SPECIFY NEW DESIRED DIMENSIONS
	$oldwidth = imagesx($image); 
	$oldheight = imagesy($image);
	$newwidth = 100;
	$newheight = ($oldheight/$oldwidth) * $newwidth; //CALCULATE RATIO OF OLD IMAGE AND APPLY TO NEW WIDTH TO GET A PROPORTIONAL HEIGHT
	$thumb_tmp = imagecreatetruecolor($newwidth, $newheight); //CREATE TEMP BLANK IMAGE CANVAS WITH NEW DIMENSIONS
	
	imagecopyresampled($thumb_tmp, $image, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);//COPY SOURCE IMAGE INTO AN TMP IMG
	
	return $thumb_tmp;
	}
	
		//$vimgthumb = $_POST['nimgthumb'];
		//$vimglarge = $_POST['nimglarge'];
		//$vimglargecaption = $_POST['nimglargecaption'];

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
				$vimgthumbfilepath = 'uploaded-images/'.$newimgbasename; //DEFINE THE FILE PATH FOR OUR NEW JPEG IMAGE
				imagejpeg($newimg, $vimgthumbfilepath, 100);//THIS WRITES THE NEW JPEG IMAGE TO A FILE WITH 100% QUALITY 
				
				//CLEAN UP TMP FILES AND OBJECTS NO LONGER REQUIRED TO SAVE STORAGE SPACE
				imagedestroy($jpegimagefrmsrc);
				imagedestroy($thumb_tmp);
					
					} elseif ($file_ext === 'png') {
						
						$pngimagefrmsrc = imagecreatefrompng($vimgpathoriginal); //CREATE A NEW PNG FILE
						$newimg = imageResize($pngimagefrmsrc); //WE CALL THE IMAGE RESIZE FUNCTION
						$newimgbasename = 'thumb_'.$vimgoriginal; //PREFIX OUR THUMBNAIL WITH THUMB_
						$vimgthumbfilepath = 'uploaded-images/'.$newimgbasename; //DEFINE THE FILE PATH FOR OUR NEW JPEG IMAGE
						imagepng($newimg, $vimgthumbfilepath);//THIS WRITES NEW PNG IMAGE TO A FILE 
						
						//CLEAN UP TMP FILES AND OBJECTS NO LONGER REQUIRED TO SAVE STORAGE SPACE
						imagedestroy($pngimagefrmsrc);
						imagedestroy($thumb_tmp);
						} 
			}
			}
//SET A BASE LINE VALUEFOR VALIDATION CHECK
$vvalidate = 0;

//COLLECT ALL THE VALUES FROM THE FORM FIELDS AND ASSIGN THEM TO SESSION VARIABLES


//GENERAL - REQUIRED FIELDS

		$vtitle = filter_var(trim($_POST['txttitle']), FILTER_SANITIZE_STRING);
		
		if ($vtitle === ''){
			$vvalidate++;
			
			}
		
		$vdatetime = filter_var(trim($_POST['txtdatetime']), FILTER_SANITIZE_STRING);
		
		if ($vdatetime=== ''){
			$vvalidate++;
			
			}
			

		$vsummary = filter_var(trim($_POST['txtsummary']), FILTER_SANITIZE_STRING);
		
		if ($vsummary === ''){
			$vvalidate++;
			
			}
			

		$vcontent = trim($_POST['txtcontent']);
		
		if ($vcontent === ''){
			$vvalidate++;
			
			}
		$vcaption = trim($_POST['txtcaption']);
		
		if ($vcaption === ''){
			$vvalidate++;
			
			}


$vqstr = "?kvalidation=failed";
$vqstr .= "&ktitle=" . urlencode($vtitle);
$vqstr .= "&kdate=" . urlencode($vdatetime);
$vqstr .= "&ksummary=" . urlencode($vsummary);
$vqstr .= "&kcontent=" . urlencode($vcontent);
$vqstr .= "&kcaption=" . urlencode($vcaption);
if($vvalidate !== 0){

	//ENCODE QUERYSTRING
	header ('Location: news-add-new.php' . $vqstr);
		exit();
	
	} else {
		
		
		//CONNECT TO THE MYSQL SERVER
		require('inc-conntekiah.php');
		
		//CALL IN THE FUNCTION escapestring
		require('inc-function-escape-string.php');
		
		//FORMULATE THE INSERT STATEMENT
		$sql_news = sprintf("INSERT INTO tblnews (ntitle, ndatetime, nsummary, ncontent, nimgthumb, nimglarge, nimglargecaption) VALUES (%s, %s, %s, %s, %s, %s, %s)",
					escapestring($vconntekiah, $vtitle, 'text'),
					escapestring($vconntekiah, $vdatetime, 'date'),
					escapestring($vconntekiah, $vsummary, 'text'),
					escapestring($vconntekiah, $vcontent, 'text'),
					escapestring($vconntekiah, $newimgbasename, 'text'),
					escapestring($vconntekiah, $vimgoriginal, 'text'),
					escapestring($vconntekiah, $vcaption, 'text')
		
		);
$sql_news_result = mysqli_query($vconntekiah, $sql_news);

	if($sql_news_result){
		
		header('Location: news-view.php');
		exit();
		
		}else{
			
		header ('Location: news-add-new.php?kinsert=failed');
		
			exit();

			}
		}
		
		} else{
		
		header('Location: signout.php');
		exit();
		}
?>
