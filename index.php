	<?php
		require_once("include/head.php");
		$sql = "SELECT * FROM users";
		$userdata = $conn->query($sql);
		
	?>
	<fieldset>
	<legend>
	<h1 align="center">Users List:</h1>
	</legend>
	<div style="float:right"><a href="add.php" align="right"><button type="button" class="blue" align="right"><span>Add User</span></button></a></div>
	<table cellpadding="10px" cellspacing="0px" border="0" width="90%" align="center" bgcolor="white">
		<thead>
			<tr>
				<th align="center">
					Sr.no
				</th>
				<th align="center">
					Photo
				</th>
				<th align="center">
					Name
				</th>
				<th align="center">
					Actions
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
					$count=0;
					while($row = $userdata->fetch_assoc())
					{
						$count++;
						echo "<tr>";
						echo "<td align='center'>".$count."</td>";
						echo "<td align='center'><img src='./uploads/photo/".$row['photo']."' width='50px' height='50px'</td>";
						echo "<td align='center'>".ucwords($row['first_name']." ".$row['last_name'])."</td>";
						echo "<td align='center'><a href='view.php?id=".$row['id']."'><button>View</button></a>";
						echo "<a href='delete.php?id=".base64_encode($row['id'])."'><button type='button' class='red'>Delete</button></a></td>";
					}
				?>
			</tr>
		</tbody>
	</table>
	</fieldset>