<?php
	require_once("include/head.php");
	$sql = "SELECT * FROM `hobbies`";
	$hobby = $conn->query($sql);
	
	if(isset($_GET['id']))
	{
		if(isset($_GET['delete'])){
			$sql = "DELETE FROM `hobbies` WHERE id ='".$_GET['id']."'";
			$delete = $conn->query($sql);
			header("Location:hobbies.php");
		}
		$sql = "SELECT * FROM `hobbies` WHERE id = ".$_GET['id'];
		$result = $conn->query($sql);
		$hobby_row = $result->fetch_assoc();
	}
?>
	<form method="POST">
		<h1 align="center">Add New Hobby :</h1>
		<table align="center" cellspacing="0px" cellpadding="10px" width="90%">
			<tr>
				<td align="right">
					<label style="font-size:30px">Add Hobby:</label>
				</td>
				<td>
					<input type="text" name="new_hobby" style="width:100%" autofocus="true" value="<?php echo isset($hobby_row['hobby_name'])?$hobby_row['hobby_name']:'' ?>">
				</td>
				<td align="left">
					<button type="submit" name="add_hobby" class="blue">Add</button>
				</td>
			</tr>
		</table>
	</form>
	<?php
	if(isset($_POST['add_hobby']))
	{
		if(isset($_POST['add_hobby'])&&!empty($_POST['new_hobby']))
		{
			if(isset($_GET['id']))
			{
				$sql = "SELECT * FROM `hobbies` WHERE hobby_name = '".$_POST['new_hobby']."'";
				$compare = $conn->query($sql);
				if(mysqli_num_rows($compare)>0){
					echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
				}
				else{
					$sql = "UPDATE `hobbies` SET `hobby_name` = '".$_POST['new_hobby']."'";
					$update = $conn->query($sql);
					header("Location:hobbies.php");
				}
			}
			else{
					$sql = "SELECT * FROM `hobbies` WHERE hobby_name = '".$_POST['new_hobby']."'";
					$compare = $conn->query($sql);
					if(mysqli_num_rows($compare)>0)
					{
						echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
					}
					else{
						$sql = "INSERT INTO `hobbies`(`hobby_name`)"."VALUES('".$_POST['new_hobby']."')";
						$add = $conn->query($sql);
						header("Location:hobbies.php");
					}
				}
		}
		else	
		{		
			echo "<h1 align='center' style='color:red'> Please Enter State Name..</h1>";
		}
	}
	?>
	<fieldset>
		<legend>
		<h1 align="center">Hobby List:</h1>
		</legend>
		<form method="POST">
			<table align="center" cellspacing="0px" cellpadding="10px" width="90%" bgcolor="white">
				<tr>
					<thead>
						<th>
							Sr.no
						</th>
						<th>
							Hobby Name
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
							while($row = $hobby->fetch_assoc())
							{
								$count++;
								echo "<tr>";
								echo "<td align='center'>".$count."</td>";
								echo "<td align='center'>".ucwords($row['hobby_name'])."</td>";	
								echo "<td align='center'>
									<a href='hobbies.php?id=".$row['id']."'><button type='button' name='edit_city' class='yellow'>Edit</button></a>
									<a href='hobbies.php?delete=1&id=".$row['id']."'><button type='button' name='delete_city' class='red'>Delete</button></a>
								</td>";
							}
						?>
					</tr>
				</tbody>
			</table>
		</form>
	</fieldset>