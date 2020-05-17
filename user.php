<?php

	include "Crud.php";
	include "authenticator.php";
	include_once 'DBConnector.php';
	class User implements Crud{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;
		private $username;
		private $password;
		function __construct($first_name,$last_name,$city_name,$username,$password)
		{
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;
			$this->username = $username;
			$this->password = $password;
		}
		public static function create() {
			$instance = new ReflectionClass(__CLASS__);
			return $instance->newInstanceWithoutConstructor();
		}

		public function setUsername($username)
		{
			$this->username = $username;
		}
		public function setUserId($user_id)
		{
			$this->user_id = $user_id;
		}
		public function setPassword($password)
		{
			$this->password = $password;
		}
		public function getUserId(){
			return $this->user_id;
		}
		public function getUsername(){
			return $this->username;
		}
		public function getPassword(){
			return $this->password;
		}
		public function initConnection(){
			$conn = new DBConnector();
			return $conn->__construct();
		}
		public function closeConnection(){
			$conn = new DBConnector();
			return $conn->closeDatabase();
		}

		public function save()
		{
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$uname = $this->username;
			$this->hashPassword();
			$pass =$this->password;
			$sql = $this->initConnection();
			$query = "INSERT INTO user( first_name,last_name,user_city,username,password ) VALUES('$fn','$ln','$city','$uname','$pass')";
			$res = mysqli_query($sql,$query) or die("Error: " .mysqli_error($sql));
			$this->closeConnection();
			return $res;
			
		}
		public function readAll(){
			return null;
		}
		public function readUnique(){
			return null;
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}
		public function validateForm(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			if ($fn == null || $ln == "" || $city == ""){
					return false;
			}
			return true;
		}
		public function hashPassword(){
			$this->password = password_hash($this->password,PASSWORD_DEFAULT);
		}
		public function isPasswordCorrect(){
			$con = new DBConnector;
			$found =false;
			$res = mysqli_query($con,"SELECT * FROM user") or die("Error ". mysqli_error($this->con));
			return $res;

			while($row = mysqli_fetch_array($res)){
				if(password_verify($this->getpassword(), $row['password']) && $this->getUsername() == $row['username']){
					$found = true;
				}
			}
			$con->closeDatabase();
			return $found;
		}
		public function login(){
			if($this->isPasswordCorrect()){
				header("Location:private_page.php");
			}
		}
		public function createUserSession(){
			session_start();
			$_SESSION['username'] = $this->getUsername();
		}
		public function logout(){
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}
		public function createFormErrorSessions(){
				session_start();
				$_SESSION['form_errors'] = "All fields are required";
		}


	}
?>