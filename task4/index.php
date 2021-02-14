<?php 
//Call Config File
require_once("includes/config.php");
$getallusers = mysqli_query($conn, "SELECT id, name,gender,photo,created FROM users where status='Active' order by name");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage / List of Users</title>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<table cellpadding="10px" cellspacing="0px" border="1" align="center" width="90%">
			<tr>
				<td><button type="button" onclick="window.location='create_user.php'">CREATE USER</button></td>
			</tr>
		</table>	
		<table cellpadding="10px" cellspacing="0px" border="1" align="center" width="90%">
			<tr>
				<th>Sr</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Photo</th>
				<th>Reg. On</th>
				<th>Action</th>
			</tr>
			<?php $sr = 1; while($userrow = mysqli_fetch_array($getallusers)){?>
			<tr>
				<td><?php echo $sr;?></td>
				<td><?php echo $userrow['name'];?></td>
				<td><?php echo $userrow['gender'];?></td>
				<td><img width="50px" src="uploads/photo/<?php echo $userrow['photo'];?>" alt="<?php echo $userrow['name'];?>"/></td>
				<td><?php echo date("d M Y", strtotime($userrow['created']));?></td>
				<td>
				<a href="show_user.php?id=<?php echo base64_encode($userrow['id']);?>">Show</a> | 
				<a href="update_user.php?id=<?php echo base64_encode($userrow['id']);?>">Edit</a> | 
				<a href="delete_user.php?id=<?php echo base64_encode($userrow['id']);?>" onclick="return confirm('Do you really want to remove this record?')">Delete</a></td>
			</tr>
			<?php $sr++;} ?>
		</table>
	</body>
</html>



