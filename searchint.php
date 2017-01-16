<?php
$query = $_REQUEST['query'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eng_mar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM english_marathi WHERE word LIKE '".$query."%' OR meaning1 LIKE '".$query."%' LIMIT 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<center><table><tr><th>&nbsp; Word &nbsp; </th><th>&nbsp; Meaning &nbsp; </th><th> &nbsp; Meaning &nbsp; </th><th> &nbsp; Meaning &nbsp; </th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>". $row["word"]. "</td><td>". $row["meaning1"]. "</td><td>" . $row["meaning2"] ."</td><td>". $row["meaning3"] ."</td></tr>". "<br>";
     }
} 
else {
     echo "<center><br><br><h6>";
     echo "Sorry, No such word found in our Marathi Dictionary Database.".'<br>';
     echo "Stay Connected, We will update it Soon.".'<br>';
     echo "माफ करा, आपण शोधत असलेला शब्द सध्या आमच्या डेटाबेसमध्ये नाहीये.".'<br>';
     echo "आम्ही लवकरात-लवकर तो शब्द आमच्या डेटाबेस मध्ये सामिविष्ट करू...धन्यवाद....".'<br>';
     echo "</h6>";
}

$conn->close();
?>  