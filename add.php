<?php
		require_once("include/head.php");
		$sql = "SELECT * FROM cities";
		$city = $conn->query($sql);
		$sql = "SELECT * FROM states";
		$state = $conn->query($sql);
		$sql = "SELECT * FROM countries";
		$country = $conn->query($sql);
		$sql = "SELECT * FROM hobbies";
		$hobby = $conn->query($sql);
		// print_r($_POST);
		if(isset($_POST['save']))
		{
			 print_r($_FILES);
			 print_r($_POST);
			 
			 if($_FILES['photo']['error']==0)
			 {
			 $filename = time().$_FILES['photo']['name'];
			 $src=$_FILES['photo']['tmp_name'];
			 $dest="uploads/photo/".$filename;
				 if(move_uploaded_file($src,$dest))
				 {
				 $_POST['photo'] = $filename;
				 }
			 }
					$sql = "INSERT INTO `users`(`first_name`,`last_name`,`email`,`password`,`address`,`dob`,`phone_no`,`city_id`,`state_id`,`country_id`,`hobby_id`,`photo`)"
					."VALUES('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."','".$_POST['password']."','".$_POST['address']."','".$_POST['dob']."','".$_POST['phone_no']."',
					'".$_POST['city']."','".$_POST['state']."','".$_POST['country']."','".implode(", ",$_POST['hobby_id'])."','".$_POST['photo']."')";
					echo $sql;
					if($conn->query($sql)==TRUE)
					{
						echo "New Record Created Successfully";
						header ("Location:index.php");
					}
					else{
						echo "Error :" .$sql ."<br>" .$conn->error;
					}
		}
?>

<h1 align="center">Please Fill Your Details:</h1>
		<form method ="POST" action="#" enctype="multipart/form-data"> 
			<table cellpadding="10px" cellspacing="10px" align="center" width="75%" bgcolor="white">
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Full Name:</span></label></td>
					<td align=""><input type="text" name="first_name"><br> First Name</td>
					<td align="left"><input type="text" name="last_name"><br> Last Name</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Email</span></label></td>
					<td colspan="2"><input type="text" name="email"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Password</span></label></td>
					<td colspan="2"><input type="password" name="password"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Address</span></label></td>
					<td colspan="2"><textarea name="address" rows="8" cols="100"></textarea></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Date of Birth</span></label></td>
					<td colspan="2"><input type="date" name="dob"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Phone Number</span></label></td>
					<td colspan="2"><input type="number" name="phone_no"></td>
				</tr>
				<tr>
				<tr>
					<td align="center"><label><span class="bold">City</span></label></td>
					<td colspan="2">
						<select name="city">
							<option>Select</option>
							<?php
									while($row = $city->fetch_assoc())
									{
										echo "<option value = ".$row['id'].">".$row['cityname']."</option>";
									}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">State</span></label></td>
					<td colspan="2">
						<select name="state">
							<option>Select</option>
							<?php
									while($row = $state->fetch_assoc())
									{
										echo "<option value = ".$row['id'].">".$row['state_name']."</option>";
									}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Country</span></label></td>
					<td colspan="2">
						<select name="country">
							<option>Select</option>
							<?php
									while($row = $country->fetch_assoc())
									{
										echo "<option value = ".$row['id'].">".$row['country_name']."</option>";
									}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Hobbies</span></label></td>
					<td colspan="2">
							<?php
									while($row = $hobby->fetch_assoc())
									{
										echo "<div class='mydiv'><input type='checkbox' name='hobby_id[]' value=".$row['id'].">".$row['hobby_name']."</div>";
									}
							?>
					</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Photo</span></label></td>
							<td colspan="2"><input type="file" name="photo"/></td>
							
					</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<button type="submit" name="save">Submit</button>
							<span class="cancel_btn"><a href="index.php"><button type="button" name="cancel">Cancel</button></a></span>
						</td>
					</tr>
			</table>
	</form>
</body>
</html>