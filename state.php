<?php
	require_once("include/head.php");
	$sql = "SELECT * FROM `states`";
	$state = $conn->query($sql);
	
	if(isset($_GET['id']))
	{
		if(isset($_GET['delete'])){
			$sql = "DELETE FROM `states` WHERE id ='".$_GET['id']."'";
			$delete = $conn->query($sql);
			header("Location:state.php");
		}
		$sql = "SELECT * FROM `states` WHERE id = ".$_GET['id'];
		$result = $conn->query($sql);
		$state_row = $result->fetch_assoc();
	}
?>
	<form method="POST">
		<h1 align="center">Add New State :</h1>
		<table align="center" cellspacing="0px" cellpadding="10px" width="90%">
			<tr>
				<td align="right">
					<label style="font-size:30px">Add State:</label>
				</td>
				<td>
					<input type="text" name="new_state" style="width:100%" autofocus="true" value="<?php echo isset($state_row['state_name'])?$state_row['state_name']:'' ?>">
				</td>
				<td align="left">
					<button type="submit" name="add_state" class="blue">Add</button>
				</td>
			</tr>
		</table>
	</form>
	<?php
	if(isset($_POST['add_state']))
	{
		if(isset($_POST['add_state'])&&!empty($_POST['new_state']))
		{
			if(isset($_GET['id']))
			{
				$sql = "SELECT * FROM `states` WHERE state_name = '".$_POST['new_state']."'";
				$compare = $conn->query($sql);
				if(mysqli_num_rows($compare)>0){
					echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
				}
				else{
					$sql = "UPDATE `states` SET `state_name` = '".$_POST['new_state']."'";
					$update = $conn->query($sql);
					header("Location:state.php");
				}
			}
			else{
					$sql = "SELECT * FROM `states` WHERE state_name = '".$_POST['new_state']."'";
					$compare = $conn->query($sql);
					if(mysqli_num_rows($compare)>0)
					{
						echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
					}
					else{
						$sql = "INSERT INTO `states`(`state_name`)"."VALUES('".$_POST['new_state']."')";
						$add = $conn->query($sql);
						header("Location:state.php");
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
		<h1 align="center">State List:</h1>
		</legend>
		<form method="POST">
			<table align="center" cellspacing="0px" cellpadding="10px" width="90%" bgcolor="white">
				<tr>
					<thead>
						<th>
							Sr.no
						</th>
						<th>
							State Name
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
							while($row = $state->fetch_assoc())
							{
								$count++;
								echo "<tr>";
								echo "<td align='center'>".$count."</td>";
								echo "<td align='center'>".ucwords($row['state_name'])."</td>";	
								echo "<td align='center'>
									<a href='state.php?id=".$row['id']."'><button type='button' name='edit_city' class='yellow'>Edit</button></a>
									<a href='state.php?delete=1&id=".$row['id']."'><button type='button' name='delete_city' class='red'>Delete</button></a>
								</td>";
							}
						?>
					</tr>
				</tbody>
			</table>
		</form>
	</fieldset>