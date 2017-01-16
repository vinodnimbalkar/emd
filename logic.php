<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf8"></meta>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="icon" type="image/x-icon" href="img/mdictionary.ico">
<link rel="stylesheet" type="text/css" href="css/myheader.css">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<script src="js/jquery-latest.min.js" type="text/javascript"></script>
<script src="js/script.js"></script>
<title>English Marathi Dictionary</title>
	<style>
table, th, td {
     border: 1px solid black;
  	text-align: center;
    margin-left: 30%;
    margin-right: 30%;
  	background: #f1f1f1;
  	box-shadow: 5px 5px 5px #ccc; 
}
th {
	background: #000000; color: #ffffff;
    font-size: 1.5em;
}
h6{
    background-color: #f1f1f1;
    font-size: 1.3em;
    border: 1px solid black;
}
</style>
</head>
<body>

<div id='cssmenu'>
<ul>
	<li class='active'><a href="index.php">Home|स्वगृह</a>
	<li><a class="smooth-scroll" href="index.php#about-scroll">About|विषयी</a></li>
	<li><a href="index.php#help-scroll">Help|मदत</a></li>
	<li><a href="index.php#feedback-scroll">Feedback|अभिप्राय</a></li>
	<li><a href="index.php#contact-scroll">Contact|संपर्क</a></li>
    <li><marquee behavior="scroll" direction="left" onMouseOver="this.stop();" onMouseOut="this.start();" scrollamount="4" 
    style="font-size:14px; color:#ffffff;">
    
     <?php 
function dat(){ 
        $filename = "dates.txt"; 
        $handle = fopen($filename, "r"); 
        $contents = fread($handle, filesize($filename)); 
        fclose($handle); 
        $array = explode("\n",$contents); 
        $date = date("z"); 
        if($date > count($array)){ 
            return $array[0]; 
        }else{ 
            return $array[$date]; 
        } 
    } 
     
    echo '<p>&nbsp;'."Today is " . date("Y/m/d ") . date("l |").dat().'</p>'; 
    ?>
</marquee></li>
</ul>
</div>
 
<div class="img">
<img src="img/bg.jpg" alt="English-Marathi Dictionary" height="300" width="1310">
</div>

<?php
$query = $_REQUEST['word'];

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
	echo "<table><tr><th>&nbsp; Word &nbsp; </th><th>&nbsp; Meaning &nbsp; </th><th> &nbsp; Meaning &nbsp; </th><th> &nbsp; Meaning &nbsp; </th></tr>";
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
</center>
</body>
</html>