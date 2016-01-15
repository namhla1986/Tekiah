<?php 
		$vid = $_GET['txtid'];
		
		$vstatus = $_GET['txtstatus'];	
		
		if($vstatus == 'i'){
			$vstatus = 'a';
			}else{
				$vstatus = 'i';
				}
		
			//CONNECT TO THE MYSQL SERVER
			require('inc-conntekiah.php');
			
			//CALL IN THE FUNCTION ESCAPE STRING()
			require('inc-function-escapestring.php');
			
			//FORMULATE SQL STATEMENT
			$sql_delete = sprintf("UPDATE tblevents SET estatus = %s WHERE eid = %u",
						escapestring($vconntekiah, $vstatus, 'text'), 
						escapestring($vconntekiah, $vid, 'int')
						);
				
				$delete_result = mysqli_query($vconntekiah, $sql_delete);
				
				if($vstatus === 'i'){
					echo 'deactive';
					}else{
						echo'active';
						}
					

?>
