<?php
		require_once("include/head.php");
		// exit();
		$sql = "SELECT * FROM cities";
		$city = $conn->query($sql);
		$sql = "SELECT * FROM `users` WHERE id ='".base64_decode($_GET['id'])."'";
		$userdata = $conn->query($sql);
		// $row = $userdata->fetch_assoc();
		// $citydata = $city->fetch_assoc();
		echo $citydata['id'];
		print_r($citydata);
		echo $row['city'];
		print_r($row);
		$sql = "SELECT * FROM states";
		$state = $conn->query($sql);
		$sql = "SELECT * FROM countries";
		$country = $conn->query($sql);
		$sql = "SELECT * FROM hobbies";
		$hobby = $conn->query($sql);
		
?>

<h1 align="center">Edit Your Details:</h1>
		<form method ="POST" action="#" enctype="multipart/form-data"> 
			<table cellpadding="10px" cellspacing="10px" align="center" width="75%" bgcolor="white">
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Full Name:</span></label></td>
					<td align=""><input type="text" name="first_name" value="<?php echo isset($row['first_name'])?$row['first_name']:'';?>"><br> First Name</td>
					<td align="left"><input type="text" name="last_name" value="<?php echo isset($row['last_name'])?$row['last_name']:'';?>"><br> Last Name</td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Email</span></label></td>
					<td colspan="2"><input type="text" name="email" value="<?php echo isset($row['email'])?$row['email']:'';?>"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Address</span></label></td>
					<td colspan="2"><textarea name="address" rows="8" cols="100"><?php echo isset($row['address'])?$row['address']:'';?></textarea></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Date of Birth</span></label></td>
					<td colspan="2"><input type="date" name="dob" value="<?php echo isset($row['dob'])?$row['dob']:'';?>"></td>
				</tr>
				<tr>
					<td align="center"><label><span class="bold">Phone Number</span></label></td>
					<td colspan="2"><input type="number" name="phone_no" value="<?php echo isset($row['phone_no'])?$row['phone_no']:'';?>"></td>
				</tr>
				<tr>
				<tr>
					<td align="center"><label><span class="bold">City</span></label></td>
					<td colspan="2">
						<select name="city">
							<option>Select</option>
							<?php while($citydata = $city->fetch_assoc()){?>
								<option value = "<?php echo $citydata['id'];?>" <?php echo(isset($row['city'])&&$row['city']==$citydata['id']?'selected':'');?>> <?php echo $citydata['cityname'];?></option>
							<?php } ?>
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
							<button type="submit" name="save">Save</button>
							<span class="cancel_btn"><a href="index.php"><button type="button" name="cancel">Back</button></a></span>
						</td>
					</tr>
			</table>
	</form>
</body>
</html>