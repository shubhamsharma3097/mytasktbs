<?php
	require_once("include/head.php");
	$sql = "SELECT * FROM `cities`";
	$cities = $conn->query($sql);
	
	if(isset($_GET['id']))
	{
		if(isset($_GET['delete'])){
			$sql = "DELETE FROM `cities` WHERE id ='".$_GET['id']."'";
			$delete = $conn->query($sql);
			header("Location:city.php");
		}
		$sql = "SELECT * FROM `cities` WHERE id = ".$_GET['id'];
		$result = $conn->query($sql);
		$city_row = $result->fetch_assoc();
	}
?>
	<form method="POST">
		<h1 align="center">Add New City:</h1>
		<table align="center" cellspacing="0px" cellpadding="10px" width="90%">
			<tr>
				<td align="right">
					<label style="font-size:30px">Add City:</label>
				</td>
				<td>
					<input type="text" name="new_city" style="width:100%" autofocus="true" value="<?php echo isset($city_row['cityname'])?$city_row['cityname']:'' ?>">
				</td>
				<td align="left">
					<button type="submit" name="add_city" class="blue">Add</button>
				</td>
			</tr>
		</table>
	</form>
	<?php
	if(isset($_POST['add_city']))
	{
		if(isset($_POST['add_city'])&&!empty($_POST['new_city']))
		{
			if(isset($_GET['id']))
			{
				$sql = "SELECT * FROM `cities` WHERE cityname = '".$_POST['new_city']."'";
				$compare = $conn->query($sql);
				if(mysqli_num_rows($compare)>0){
					echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
				}
				else{
					$sql = "UPDATE `cities` SET `cityname` = '".$_POST['new_city']."'";
					$update = $conn->query($sql);
					header("Location:city.php");
				}
			}
			else{
					$sql = "SELECT * FROM `cities` WHERE cityname = '".$_POST['new_city']."'";
					$compare = $conn->query($sql);
					if(mysqli_num_rows($compare)>0)
					{
						echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
					}
					else{
						$sql = "INSERT INTO `cities`(`cityname`)"."VALUES('".$_POST['new_city']."')";
						$add = $conn->query($sql);
						header("Location:city.php");
					}
				}
		}
		else	
		{		
			echo "<h1 align='center' style='color:red'> Please Enter City Name..</h1>";
		}
	}
	?>
	<fieldset>
		<legend>
		<h1 align="center">City List:</h1>
		</legend>
		<form method="POST">
			<table align="center" cellspacing="0px" cellpadding="10px" width="90%" bgcolor="white">
				<tr>
					<thead>
						<th>
							Sr.no
						</th>
						<th>
							City Name
						</th>
						<th>
							Actions
						</th>   
					</thead>
				</tr>
				<tbody>
					<tr>
						<?php 
						$count=0;
							while($row = $cities->fetch_assoc())
							{
								$count++;
								echo "<tr>";
								echo "<td align='center'>".$count."</td>";
								echo "<td align='center'>".ucwords($row['cityname'])."</td>";	
								echo "<td align='center'>
									<a href='city.php?id=".$row['id']."'><button type='button' name='edit_city' class='yellow'>Edit</button></a>
									<a href='city.php?delete=1&id=".$row['id']."'><button type='button' name='delete_city' class='red'>Delete</button></a>
								</td>";
							}
						?>
					</tr>
				</tbody>
			</table>
		</form>
	</fieldset>