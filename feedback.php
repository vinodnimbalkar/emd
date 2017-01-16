<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

$fname=$_POST["field1"];
$lname=$_POST["field2"];
$email=$_POST["field3"];
$word=$_POST["field4"];
$meaning1=isset($_POST['field5']) ? $_POST["field5"] : NULL;
$meaning2=isset($_POST['field6']) ? $_POST["field6"] : NULL;
$msg=$_POST["field7"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="INSERT INTO `suggest`(`fname`, `lname`, `email`, `word`, `meaning1`, `meaning2`, `message`) VALUES ('". $fname . "','" . $lname ."','" . $email .
 "','" . $word . "','" . $meaning1 . "','" . $meaning2 . "','" . $msg ."')";

if ($conn->query($sql) === TRUE) {
    echo "We got your valuable suggestion successfully";
    echo "<br><br>Yor Name is :".$fname. " " .$lname. "<br>";
    echo "Your E-mail Id is :" .$email. "<br>";
    echo "Your Mesaages for us is :".$msg;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 

$conn->close();
?>