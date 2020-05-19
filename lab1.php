=
<?php

	include_once 'DBConnector.php';
	include_once 'user.php';

	$con = new DBConnector;

	if(isset($_POST['btn-save'])){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username = $_POST['name'];
		$password = $_POST['password'];
		$file = $_POST['fileToUpload'];
		
		$utc_timestamp = $_POST['utc_timestamp'];
		$offset = $_POST['time_zone_offset'];

		$user = new User($first_name,$last_name,$city,$username,$password,$utc_timestamp,$time_zone_effect);
		//create object for file uploading
		$uploader = new FileUploader;
		if(!$user->validateForm()){
			$user->createFormErrorSessions();
			header("Refresh:0");
			die();
		}
		$res = $user->save();
		//call uploadFile() function, which returns
		$file_upload_response = $uploader->uploadFile();
		if($res && $file_upload_response){
			echo "Save operation was successful";
		}else{
			echo "An error occured";
		}
		$con->closeDatabase();
	
	}
?>

<html>
<head>
	<title>Sign UP</title>
	<script type ="text/javascript" src = "validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<!--include jquery here. I decide to get it from a cnd network, Google-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!--your new js file comes after including your jquery-->
	<script type="text/javasccript" src="timezone.js"></script>
</head>
<body>
<form method="POST"  name = "user_details" id = "user_details" onsubmit="return validateForm()" action ="<?php echo $_SERVER['PHP_SELF'];?>">
	<table align="center">
	<tr>
	<td>
		<div id = "form-errors">
		<?php
			session_start();
			if(!empty($_SESSION['form_errors'])){
					echo " " . $_SESSION['form_errors'];
					unset($_SESSION['form_errors']);
			}
			?>
		</div>
	</td>
	</tr>
		<tr>
			<td><input type="text" name="first_name"required placeholder="First Name"></td>
		</tr>
		<tr>
			<td><input type="text" name="last_name"required placeholder="Last Name"></td>
		</tr>
		<tr>
			<td><input type="text" name="city_name"required placeholder="City"></td>
		</tr>
		<tr>
			<td><input type="text" name="name"required placeholder="Username"></td>
		</tr>
		<tr>
			<td><input type="password" name="password"required placeholder="Password"></td>
		</tr>
		<tr>
		<tr>
			<td>Profile image :<input type="file" name="fileToUpload" id="fileToUpload"></td>
		</tr>
		<tr>
			<td><button type="submit" name="btn-save"<strong>SAVE</strong></button></td>
		</tr>
	
		<input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
		<input type="hidden" name="time_zone_offset" id="time_zone_offset" value="/">
		
		<tr>
			<td><a href="login.php">Login</a></td>
		</tr>
	</table>
</form>
</body>
</html>