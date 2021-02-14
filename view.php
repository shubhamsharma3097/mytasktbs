	<?php
		require_once("include/head.php");
		 $sql ="SELECT ct.cityname,st.state_name,country.country_name,u.* FROM users AS u INNER JOIN cities AS ct ON u.city_id = ct.id INNER JOIN states AS st ON u.state_id = st.id 
		 INNER JOIN countries AS country ON u.country_id = country.id WHERE u.id='".$_GET['id']."'";
		  echo $sql;
		 $joindata = $conn->query($sql);
		 $row = $joindata->fetch_assoc();
		 print_r($row);
		 // print_r($row['photo']);
	?>
	<fieldset>
	<legend>
		<?php echo "<img src='./uploads/photo/".$row['photo']."' width='150px' height='150px'>";?>
	</legend>
	<table cellpadding="10px" cellspacing="0px" border="0" width="90%" align="center">
		
			<tr>
				<?php
						echo "<tr>";
						echo "<td align='center'><span class='white'><b>Name :</b>".ucwords($row['first_name']." ".$row['last_name'])."</span></td>";
						echo "<td align='center'><span class='white'><b>Email :</b>".$row['email']."</span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align='center'><span class='white'><b>Address :</b>".$row['address']."</span></td>";
						echo "<td align='center'><span class='white'><b>Date of Birth :</b>".$row['dob']."</span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align='center'><span class='white'><b>Phone no :</b>".$row['phone_no']."</span></td>";
						echo "<td align='center'><span class='white'><b>Hobbies :</b>".$row['hobby_id']."</span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align='center'><span class='white'><b>City name :</b>".$row['cityname']."</span></td>";
						echo "<td align='center'><span class='white'><b>State :</b>".$row['state_name']."</span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align='center'><span class='white'><b>Country name :</b>".$row['country_name']."</span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align='center' colspan='2'><a href='edit.php?id=".base64_encode($row['id'])."'><button type='button' class='yellow'><span >Edit</span></button>
						<a href='index.php'><button type='button' class='blue'><span >Cancel</span></button>
						</td>";
						echo "</tr>";
				?>
			</tr>
		</tbody>
	</table>
	</fieldset>