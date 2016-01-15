<?php 
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
				$upload_directory = 'cms/uploaded-images/';
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
?>
<?php
//ESCAPESTRING FUNCTION
if (!function_exists('escapestring')) {
	
	function escapestring($vconntekiah, $value, $datatype) { 
	
	  $value = function_exists('mysqli_real_escape_string') ? mysqli_real_escape_string($vconntekiah, $value) : mysqli_escape_string($vconntekiah, $value);
	
	  switch ($datatype) { 
		case 'text':
		  $value = ($value != '') ? "'" . $value . "'" : "'na'";
		  break;      
		case 'int':
		  $value = ($value != '') ? intval($value) : "'na'";
		  break;  
		case 'float':
		  $value = ($value != '') ? floatval($value) : "'na'";
		  break;
		case 'date':
		  $value = ($value != '') ? "'" . $value . "'" : "'na'";
		  break; 
	  	}
	  	return $value;
		}
	}
?>
<?php 
 
?>
