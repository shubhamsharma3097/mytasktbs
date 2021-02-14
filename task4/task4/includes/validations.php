<?php 
function validate_form()
{
	$errors = array();
	if(isset($_POST['name']) && empty(trim($_POST['name'])))
	{
		$errors['name'] = "Please Enter Your Name";
	}
	if(isset($_POST['email_address']) && empty(trim($_POST['email_address'])))
	{
		$errors['email_address'] = "Please Enter Your Email Address";
	}
	if(isset($_POST['password']) && empty(trim($_POST['password'])))
	{
		$errors['password'] = "Please Enter Password";
	}
	if(empty($_POST['intersts']))
	{
		$errors['intersts'] = "Please select intersts";
	}
	return $errors;
}	
?>