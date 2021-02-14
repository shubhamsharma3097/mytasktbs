<?php 
if(isset($_GET['id'])){
	//Call Config File
	require_once("includes/config.php");
	$id = base64_decode($_GET['id']);
	$data = mysqli_query($conn, "select users.*, cities.id as cityid, cities.cityname from cities inner join users on users.city_id=cities.id where users.id='".$id."'");
	if(mysqli_num_rows($data))
	{
		$row = mysqli_fetch_assoc($data);
	}
	else
	{
		echo "Your Data is not available against request";
	}
}
else
{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Form</title>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<table cellpadding="10px" cellspacing="0px" border="1" align="center" width="600px">
			<tr>
				<td><label>Name : </label></td>
				<td><?php echo $row['name'];?></td>
			</tr>
			<tr>
				<td><label>Address : </label></td>
				<td><?php echo $row['address'];?></td>
			</tr>
			<tr>
				<td><label>Gender : </label></td>
				<td><?php echo $row['gender'];?></td>
			</tr>
			<tr>
				<td><label>Hobbies : </label></td>
				<td>
				<?php 
					$hobbies = explode(", ",$row['hobby_id']);
					foreach($hobbies as $hobrow=>$value){
						$hobbytitle = mysqli_fetch_assoc(mysqli_query($conn,"Select id,title from hobbies where id='".$value."'"));
						echo $hobbytitle['title']. ", ";
					} 
				?>
				</td>
			</tr>	
			<tr>
				<td><label>City : </label></td>
				<td><?php echo $row['cityname'];?></td>
			</tr>
			
			<tr>
				<td><label>Photo : </label></td>
				<td><img width="50px" src="uploads/photo/<?php echo $row['photo'];?>" alt="Photo"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="button" onclick="window.location='index.php'">Cancel</button>
				</td>
			</tr>
		</table>
	</body>
</html>



