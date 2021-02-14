<?php
	require_once("include/head.php");
	 if(isset($_POST['delete_user']))
	 {
		$sql = "DELETE FROM users WHERE id = ".base64_decode($_GET['id']);
		$delete = $conn->query($sql);
		header("Location:index.php");
		echo $sql;
	 }
?>
	<h1 align="center">Are You Sure You Want To Delete The Records?</h1>
		<form method="POST">
		<div id="delete_page">
			<button type="submit" name="delete_user" class="red">Delete</button>
			<a href="index.php" ><button type="button" class="green">Cancel</button></a>
		</div>
		</form>