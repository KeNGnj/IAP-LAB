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


		$user = new User($first_name,$last_name,$city,$username,$password);
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
	</table>
</form>
</body>
</html>