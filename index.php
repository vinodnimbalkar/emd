<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="icon" type="image/x-icon" href="img/mdictionary.ico">
<link rel="stylesheet" type="text/css" href="css/myheader.css">
<link rel="stylesheet" type="text/css" href="css/search.css">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link rel="stylesheet" type="text/css" href="css/feedback.css">
<script src="js/jquery-latest.min.js" type="text/javascript"></script>
<script src="js/script.js"></script>
<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "searchint.php?query=" + str, true);
        xmlhttp.send();
    }
}
</script>
<title>English Marathi Dictionary</title>
</head>
<body>

<div id='cssmenu'>
<ul>
	<li class='active'><a href="#">Home|स्वगृह</a>
	<li><a class="smooth-scroll" href="#about-scroll">About|विषयी</a></li>
	<li><a class="smooth-scroll" href="#help-scroll">Help|मदत</a></li>
	<li><a class="smooth-scroll" href="#feedback-scroll">Feedback|अभिप्राय</a></li>
	<li><a class="smooth-scroll" href="#contact-scroll">Contact|संपर्क</a></li>
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
<img src="img/logo3.jpg" class="img-responsive" alt="English-Marathi Dictionary" height="300" width="1310">
</div>

<table style="width:100%">
    <tr>
        <td align="center"> 
        
        <img src="img/wod.png" alt="Word Of the day" hspace="20" height="70" width="300">
    <section id="wod" class="pad-normal">
    <div class="page-wod">
<?php 
    function wordofday(){ 
        $filename = "words.txt"; 
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
     
    echo '<p>&nbsp;'.wordofday().'</p>'; 
?>
</div>
</section>
    </td>
        <td align="center">  
        <div class="loader_img">
        <a class="google-opt" href="javascript:(t13nb=window.t13nb||function(l){var t=t13nb,d=document,o=d.body,c='createElement',a='appendChild',w='clientWidth',i=d[c]('span'),s=i.style,x=o[a](d[c]('script'));
if(o){if(!t.l){t.l=x.id='t13ns';o[a](i).id='t13n';
i.innerHTML='Loading Transliteration';s.cssText='z-index:99;font-size:18px;background:#FFF1A8;top:0';s.position=d.all?'absolute':'fixed';s.left=((o[w]-i[w])/2)+'px';
x.src='js/marathi.js?l='+l}}else setTimeout(t,500)})('mr')"><img src="img/mtyping.png" alt="Marathi Keyboard" height="100" width="100"></a></div><br><br>

<section id="text"><p><img src="img/arrow.gif" width="18" height="10" align="absmiddle" />शेकडो मराठी शब्दांची माहिती देणारे संकेतस्थळ
<img src="img/back_arrow.gif" width="18" height="10" align="absmiddle" /></p></section>

    <form method="get" id="searchbox" action="logic.php">
    <input id="search" name="word" type="text" onkeyup="showHint(this.value)" placeholder="Type here...">
    <input id="submit" type="submit" value="Search-शोधा..">
</form>
</td>
	<td align="center">

     <section id="qod" class="pad-normal">

        <div class="row">
            <div class="large-12 columns text-center">
                <div class="page-qod">
                    <h3>Quote of the day...</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="large-10 large-centered columns">
                <p>
<marquee behavior="scroll" direction="up" onMouseOver="this.stop();" onMouseOut="this.start();" scrollamount="1" 
    style="font-size:14px; color:#ffffff;">
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quote_of_the_day";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$date = date("z"); 
$sql = "SELECT * FROM quotes WHERE day ='".$date."%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo '<p>&nbsp;'. $row["quote"] .'</p>';
     }
} 
else {
     echo "<center><br><br><h6>";
     echo "Sorry, No quote for Today.".'<br>';
     echo "Stay Connected, We will update it Soon.".'<br>';
     echo "माफ करा, आज कोणताही सुविचार उपलब्द नाहीये.".'<br>';
     echo "आम्ही लवकरात-लवकर तो शब्द आमच्या डेटाबेस मध्ये सामिविष्ट करू...धन्यवाद....".'<br>';
     echo "</h6>";
}

$conn->close();
?>  
</marquee>
</p>
  </div>
</div>
  </section>
      </td>  
  </tr>
</table>
<div id="txtHint"><b>Word Meaning will be listed here...</b></div>
<section id="quote" class="pad.large">
<div class="divider-hero">
    <p>Better than a thousand hollow words, is one word that brings peace. &mdash;
                        <em>Buddha</em>
                    </p>

</div>
    
</section>

<a id="about-scroll"></a>
    <section id="about" class="pad-normal">

        <div class="row">
            <div class="large-12 columns text-center">
                <div class="page-about">
                    <h3>About</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="large-10 large-centered columns">
                <p>
                    Howdy! English-Marathi Dictionary is Online Dictionary which can be useful for various types of people. 
                    Imagine that a vocabulary of <strong>Marathi</strong> word is always available on your PC or Laptop. You can find meaning of all words in just few seconds.
                    This dream comes true with this Online Dictionary. In this fast pace world we are mostly dependent on electronic media. 
                    Many times when we get some words which meaning is not known to us then the problem comes, but the problem is not that tuff now, 
                    meaning of these typical words is now in the gap of few clicks. 
        We open the <em>English-Marathi Dictionary</em> Website then type the words and answer is provided online. 
        Yes this Marathi Dictionary come with thousands of word with internet connectivity. 
        So whenever you wish to know meaning of words just click on our website and type words BINGO! Meaning is known.

                </p>
               
                </div>
            </div>
        </div>

    </section>
    <!--end of About section-->

    <a id="help-scroll" class="smooth-scroll"></a>
    <section id="help" class="pad-normal">

        <div class="row">
            <div class="large-12 columns text-center">
                <div class="page-help">
                    <h3>Help | मदत</h3>
                </div>
            </div>
            <ul>
            <li><p>For English to marathi word, type it in the search-box given and press search button.</p></li>
<li><p>Marathi to English word, You can type using your default marathi computer's keyboard or using the online keyboard.
<ul><li><p>To use the online keyboard, click on the small <img src="img/mtyping.png" alt="Marathi Keyboard" height="40" width="40"> image above the search box.</p></li>
<li><p>It will automatic convert your english keyboard to marathi keyboard which can be used for typing any marathi word with servel word option.</p></li></ul>
</p></li><br>

            <li><p>इग्लिशमधून मराठी शब्द शोधण्यासाठी ज्या शब्दाचा अर्थ हवा आहे तो शब्द सर्च बॉक्समध्ये लिहून 'शोधा' या बटनावर क्लिक करा.</p></li>
<li><p>मराठी शब्द लिहिण्यासाठी आपल्या संगणकाचा कीबोर्ड वापरावा किंवा या पानावर असलेला ऑनलाईन कीबोर्ड वापरावा.</p></li>
<ul><li><p>या पानावरील ऑनलाईन मराठी हवा असेल तर सर्च बॉक्स वरील <img src="img/mtyping.png" alt="Marathi Keyboard" height="40" width="40">या चित्रा वर क्लिक करा.</p></li>
<li><p>चित्रावर क्लिक केल्यास आपोआप आपला कीबोर्ड मराठी शब्द टाईप करू शकेल, याचा वापर करून आपण मराठी शब्दचा इंग्रजी अर्थ शोधू शकता.</p></li></ul>
</p></li>
       </div>

            </section>
    <!--end of Help section-->
    
    <a id="feedback-scroll"></a>
    <section id="feedback" class="pad-normal">
    <div class="large-12 columns text-center">
                <div class="page-feedback">
    <h3>Feedback</h3>
    </div>
    </div>
        <form style="background-color:#ffffff" method="post" action="feedback.php">
<ul class="form-feedback">
    <li><label>Full Name <span class="required">*</span></label><input type="text" name="field1" class="field-divided" placeholder="First" />
    &nbsp;<input type="text" name="field2" class="field-divided" placeholder="Last" /></li>
    <li>
        <label>Email <span class="required">*</span></label>
        <input type="email" name="field3" class="field-long" />
    </li>
    <li>
         <label>Word </label>
        <input type="text" name="field4" class="field-divided" />
         <label>Meaning </label>
        <input type="text" name="field5" class="field-divided" />
         <label>Other Meaning </label>
        <input type="text" name="field6" class="field-divided" />
    </li>
    <li>
        <label>Your Message <span class="required">*</span></label>
        <textarea name="field7" class="field-long field-textarea"></textarea>
    </li>
    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>
</section>

<a id="contact-scroll" class="smooth-scroll"></a>
    <section id="contact" class="pad-normal">

        <div class="row">
            <div class="large-12 columns text-center">
                <div class="page-contact">
                    <h3>Contact | संपर्क</h3>
                </div>
            </div>
            </div>
            <h5><address>
                <strong> Vinod Nimbalkar <a href="mailto:omvinod@yahoo.com">Send Mail</a></strong><br>
        FYMCA, BVIMIT, Sec-8<br>
        Belapur, Navi Mumbai<br>
        MH
  </address>
  <address>
                //Other Project Partner name would be here...
        FYMCA, BVIMIT, Sec-8<br>
        Belapur, Navi Mumbai<br>
        MH
  </address><h5></section> 
           <section id="contact" class="pad-normal"> <p>
<img src="img/arrow.gif" width="21" height="12" align="absmiddle" /> या संकेतस्थळाचे हक्क राखिव नाहित आपण यातील माहिती कुठेही वापरु शकता. - <strong>विनोद आणि मयूर</strong>
            
            </p></section>
                   
</body>
</html>
