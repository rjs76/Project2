<?php
$connect= mysqli_connect('sql1.njit.edu', 'rjs76', 'Dualshock77');
mysqli_select_db($connect, 'rjs76');
 $email = $_POST['Email'];
 $password = $_POST['Password'];
 #echo "Email is ". $email . " password is ". $password;
$query = "SELECT * FROM accounts WHERE email = "."'".$email ."' AND password = "."'".$password."'";
#echo $query;
$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	#echo "Email is ". $row['email'] . " password is ". $row['password'];
	if ($row['email'] == $email && $row['password'] == $password ) {
		echo "Welcome '.$email'";
		$_SESSION['log']=1;
		header("refresh:2;url=WELCOME.php");
	} else {
		echo "please fill proper details";
		header("refresh:2;url=login.php");
	}
?>