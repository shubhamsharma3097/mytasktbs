<?php 
//Call Config File
if(iseet($_GET['id'])){
	require_once("includes/config.php");
	// Get name of photo against id
	
	// fire delete query & Execute query
	
	// if query get execute then only remove file from folder
}
else
{
	header("location:index.php");
}
?>