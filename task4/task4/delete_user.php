<?php 
//Call Config File
if(isset($_GET['id'])){
	require_once("includes/config.php");
	
	// Get name of photo against id
	$getphoto = mysqli_fetch_assoc(mysqli_query($conn,"select photo from users where id='".base64_decode($_GET['id'])."'"));
	
	//print_r($getphoto['photo']);exit;
	// fire delete query & Execute query
	$deletedata = "delete from users where id='".base64_decode($_GET['id'])."'";
	if(mysqli_query($conn,$deletedata)){
		// if query get execute then only remove file from folder
		unlink("uploads/photo/".$getphoto['photo']);
		header("location:index.php");
	}
	else
	{
		header("location:index.php");
	}
}
else
{
	header("location:index.php");
}
?>