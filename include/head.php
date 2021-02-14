<!DOCTYPE html>
<html>
<head>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body id="grad1">
<?php
		$server = "localhost";
		$username ="root";
		$password ="";
		$dbname ="mytasktbs";
		
		$conn = mysqli_connect($server,$username,$password,$dbname);
		
		if(!$conn){
			die("Unable to connect with server. please check credentials" .mysqli_connect_error());
		}else{
			// echo " Connection Successfull";
			
		}
?>
	<div class="nav">
		<ul>
			<li>
				<a href="index.php">Users</a>
			</li>
			<li>
				<a href="city.php">City</a>
			</li>
			<li>
				<a href="state.php">State</a>
			</li>
			<li>
				<a href="country.php">Country</a>
			</li>
			<li>
				<a href="hobbies.php">Hobbies</a>
			</li>
		</ul>
	</div>