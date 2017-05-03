<?php
session_start();
$var = $_SESSION["rk"];
$urlnm = $_SESSION["urlname"];
?>

<?php
$servername = "localhost";
$username = "root";
$password = "reg3(03+14)";
$dbname = "urls";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query("SELECT MAX(Rank) FROM maindata");
$row = $result->fetch_array(MYSQLI_NUM);
$mRank = $row[0];

$dPercent = ($var/$mRank)*100;


?>
<!doctype html>
<html class="no-js" lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>WebSec</title>
    <link rel="stylesheet" href="stylesheets/app.css" />
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="bower_components/modernizr/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
    <script type='text/javascript' src='jquery.particleground.js'></script>
    <script type='text/javascript' src='js/script.js'></script>

    <script type="text/javascript">var val = "<?= $dPercent ?>";</script>
    <script src="js/script2.js"></script>
  </head>

  <body>
  
    <div class="header">
      <div class="row">
        <div class="medium-4 large-4 columns" style="position: absolute; display: inline-block;">
          <div class="logo-class">
            <img src="img/logo.png" id="logo-id" alt="WebSec" />
          </div>
        </div>
        <div class="medium-8 large-8 columns" style="position: absolute; display: inline-block;">
          <div class="navbar">
            <div class="row">
              <div class="medium-3 large-3 columns">
                <div class="home-class">
                  <div id="home-text"><a href="#" style="color: white;">Home</a></div>
                </div>
              </div>
              <div class="medium-3 large-3 columns">
                <div class="about-class">
                  <div id="about-text"><a href="#" style="color: white;">About</a></div>
                </div>
              </div>
              <div class="medium-3 large-3 columns">
                <div class="developers-class">
                  <div id="developers-text"><a href="#" style="color: white;">Developers</a></div>
                </div>
              </div>
              <div class="medium-3 large-3 columns">
                <div class="contact-class">
                  <div id="contact-text"><a href="#" style="color: white;">Contact</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="main-body-url" style="margin-left: 200px; margin-top: 100px; display: inline-block; font-size: 20px;"> 
    <!--<div class="search-box">
      <div class="row">
        <div class="small-12 medium-12 large-12 columns">
          <form id="search-form">
            <input type="text" name="urlis" id="url-id" value="<?php echo $var ?>" />
          </form>
        </div>
      </div>
      Rank: <?php echo $var; ?>
    </div>-->
    <form id="res-form-id" method="POST" action="search.php"> 
      URL : 
      <input type="text" class="url-box" name="urlis" style="width: 700px; height: 40px; background-color: white; color:#16a085; display: inline-block; border-radius: 5px; padding-top: 5px; padding-left: 10px; margin-left: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 20px;" value="<?php echo $urlnm; ?>" />
      <input type="submit" name="res-change-submit" value="Check URL" style="display: inline-block; width: 100px;
        height: 40px; margin-left: 20px; font-size: 14px; background-color: #000070; color: white; font-weight: bold; border-width: 1px;">
    </form>
  </div>

  <div class="result-boxes" style="margin-top: 100px; margin-left: 250px;">
    <div id="rank-div1" style="float: left; width: 200px; height: 200px; border: 4px; border-radius: 100px; background-color: white; padding-top: 50px; padding-left: 55px; color: #16a085; font-size: 30px; font-weight: bold; display: none;"><div id="rank-text">Rank</div><div id="rank-number" style="padding-left: 25px; padding-top: 10px;"><?php echo $var; ?></div>
    </div>
    <div id="bar" style="float: left; margin: 70px; border:1px solid black; border-radius: 10px; width:0px;background-color:red; height: 50px;">&nbsp;</div>
    <div id="msg" style="position: absolute; margin-left: 650px; width: 180px; height: 180px; background-color: white; border-radius: 10px; color: black; padding-left: 50px; padding-top: 70px; font-size: 24px; font-weight: bold;">
    </div>
    <script type="text/javascript">
      if(val<50){
        document.getElementById("msg").innerHTML = "Safe!";
        document.getElementById("msg").style.color = "green";
      }
      else{
        document.getElementById("msg").innerHTML = "Unsafe!";
        document.getElementById("msg").style.color = "red";
      }
    </script>
  </div>
    
    <script src="js/script1.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/foundation/js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>

</html>