<?php 
//Call Config File
require_once("includes/config.php");
//Get All Active cities from table
$getallcities =mysqli_query($conn,"select id,cityname from cities where status='Active' order by cityname");

//Get All Active Hobbies from table
$getallhobbies =mysqli_query($conn,"select id,title from hobbies where status='Active' order by title");

// Check button Click or Not
if(isset($_POST['save']))
{
	if($_FILES['photo']['error']==0)
	{
			$filename = time().$_FILES['photo']['name'];
			$src=$_FILES['photo']['tmp_name'];	//Find Source
			$dest="uploads/photo/".$filename;	//Set Destination
			if(move_uploaded_file($src,$dest))
			{
				$_POST['photo'] = $filename;
				
				// Fire insert query
				$insetuser = "INSERT INTO users SET 
				name='".ucwords($_POST['name'])."', 
				password='".md5($_POST['password'])."',
				address='".$_POST['address']."',
				gender='".$_POST['gender']."',
				city_id='".$_POST['city_id']."',
				hobby_id='".implode(", ",$_POST['hobby_id'])."',
				photo='".$_POST['photo']."',
				created=now()";
			    if(mysqli_query($conn,$insetuser))
				{
					//echo "User has been registered Successfully";
					unset($_POST);
					header("location: index.php");
					
				}
				else
				{
					echo "Unable to Register Please try again";
				}
			}
			else
			{
				echo "Unable to Upload file";
			}
	}
	else
	{
		
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Form</title>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
	<form method="post" action="#" enctype="multipart/form-data">
		<table cellpadding="10px" cellspacing="0px" border="1" align="center" width="600px">
			<tr>
				<td>
					<label>Name : </label><br/>
					<input type="text" name="name" value="<?php echo isset($_POST['name'])?ucwords($_POST['name']):'';?>"/>
				</td>
			</tr>
			
			<tr>
				<td>
					<label>Password : </label><br/>
					<input type="password" name="password"/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Address : </label><br/>
					<textarea rows="5" col="30" name="address"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label>Gender : </label><br/>
					<input type="radio" name="gender" value="Male"/> Male
					<input type="radio" name="gender" value="Female"/> Female
					<input type="radio" name="gender" value="Other"/> Other
				</td>
			</tr>
			<tr>
				<td>
					<label>Hobbies : </label><br/>
					<?php while($hobbyrow = mysqli_fetch_array($getallhobbies)){?>
					<input type="checkbox" name="hobby_id[]" value="<?php echo $hobbyrow['id'];?>" <?php echo (isset($_POST['hobby_id']) && in_array($hobbyrow['title'],$_POST['hobby_id']))?'checked':'';?> /><?php echo $hobbyrow['title'];?>
					<?php } ?>
				</td>
			</tr>	
			<tr>
				<td>
					<label>City : </label><br/>
					<select name="city_id">
						<option>-- Select City--</option>
						<?php while($cityrow = mysqli_fetch_array($getallcities)){?>
						<option value="<?php echo $cityrow['id'];?>"><?php echo $cityrow['cityname'];?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>
					<label>Photo : </label><br/>
					<input type="file" name="photo"/>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="save">Submit</button>
					<button type="button" onclick="window.location='index.php'">Cancel</button>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>



