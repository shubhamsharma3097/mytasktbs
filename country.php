<?php
	require_once("include/head.php");
	$sql = "SELECT * FROM `countries`";
	$country = $conn->query($sql);
	
	if(isset($_GET['id']))
	{
		if(isset($_GET['delete'])){
			$sql = "DELETE FROM `countries` WHERE id ='".$_GET['id']."'";
			$delete = $conn->query($sql);
			header("Location:country.php");
		}
		$sql = "SELECT * FROM `countries` WHERE id = ".$_GET['id'];
		$result = $conn->query($sql);
		$country_row = $result->fetch_assoc();
	}
?>
	<form method="POST">
		<h1 align="center">Add New Country:</h1>
		<table align="center" cellspacing="0px" cellpadding="10px" width="90%">
			<tr>
				<td align="right">
					<label style="font-size:30px">Add Country:</label>
				</td>
				<td>
					<input type="text" name="new_country" style="width:100%" autofocus="true" value="<?php echo isset($country_row['country_name'])?$country_row['country_name']:'' ?>">
				</td>
				<td align="left">
					<button type="submit" name="add_country" class="blue">Add</button>
				</td>
			</tr>
		</table>
	</form>
	<?php
	if(isset($_POST['add_country']))
	{
		if(isset($_POST['add_country'])&&!empty($_POST['new_country']))
		{
			if(isset($_GET['id']))
			{
				$sql = "SELECT * FROM `countries` WHERE country_name = '".$_POST['new_country']."'";
				$compare = $conn->query($sql);
				if(mysqli_num_rows($compare)>0){
					echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
				}
				else{
					$sql = "UPDATE `countries` SET `country_name` = '".$_POST['new_country']."'";
					$update = $conn->query($sql);
					header("Location:country.php");
				}
			}
			else{
					$sql = "SELECT * FROM `countries` WHERE country_name = '".$_POST['new_country']."'";
					$compare = $conn->query($sql);
					if(mysqli_num_rows($compare)>0)
					{
						echo "<h1 align='center' style='color:red'> Allready Exist..</h1>";
					}
					else{
						$sql = "INSERT INTO `countries`(`country_name`)"."VALUES('".$_POST['new_country']."')";
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
		<h1 align="center">Country List:</h1>
		</legend>
		<form method="POST">
			<table align="center" cellspacing="0px" cellpadding="10px" width="90%" bgcolor="white">
				<tr>
					<thead>
						<th>
							Sr.no
						</th>
						<th>
							Country Name
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
							while($row = $country->fetch_assoc())
							{
								$count++;
								echo "<tr>";
								echo "<td align='center'>".$count."</td>";
								echo "<td align='center'>".ucwords($row['country_name'])."</td>";	
								echo "<td align='center'>
									<a href='country.php?id=".$row['id']."'><button type='button' name='edit_city' class='yellow'>Edit</button></a>
									<a href='country.php?delete=1&id=".$row['id']."'><button type='button' name='delete_city' class='red'>Delete</button></a>
								</td>";
							}
						?>
					</tr>
				</tbody>
			</table>
		</form>
	</fieldset>