<?php
include_once 'conn.php';
if(isset($_POST['name']))
{    
     
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
//    $file_loc = $_FILES['file']['tmp_name'];
//	$file_size = $_FILES['file']['size'];
//	$file_type = $_FILES['file']['type'];
	$folder="uploads/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO t_phonebook_det(file) VALUES('$final_file')";
		mysql_query($sql);
		?>
		<script>
		alert('successfully uploaded');
        window.location.href='index.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php
	}
}
?>