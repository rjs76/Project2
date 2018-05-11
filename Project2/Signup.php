 <?php
$connect= mysqli_connect('sql1.njit.edu', 'rjs76', 'Dualshock77');
if(!$connect){
	echo "not connect to sever";
}
if (!mysqli_select_db($connect, 'rjs76')) {
	echo "database not selected";
}
 $fname = $_POST['Fname'];
 $lname = $_POST['Lname'];
 $email = $_POST['Email'];
 $phone = $_POST['Phone'];
 $birthday = $_POST['Birthday'];
 $gender = $_POST['Gender'];
 $password = $_POST['Password'];
$query = "INSERT INTO accounts (fname, lname,email, phone, birthday, gender, password) VALUES ('$fname', '$lname', '$email', $phone', '$birthday','$gender', '$password')";
if(mysqli_query($connect, $query))
 {
header('Location: https://web.njit.edu/~rjs76/PROJECT2/Signup/Login.php');
}
else
 {
 echo "<script>alert('FAILED TO INSERT');</script>";
 }
mysql_close($connect);
?>

