
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>attendance</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <script src='main.js'></script>

</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "students_db";
$conn = new mysqli($servername, $username, $password,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}
?>
<div class="header">
  <a href="index.php" class="name">Face Recognition System for Attendance Monitoring</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>


<div class="main">
<div class="container-contact100">
<div class="wrap-contact100">
  <form class="contact100-form validate-form"  action="index.php" method="post">
    <span class="contact100-form-title">
      Enter USN
    </span>
    <div class="wrap-input100 validate-input">
      <input class="input100" type="text" name="USN" placeholder="ex:1ga16ec010">
      <span class="focus-input100"></span>
    </div>
    <div class="container-contact100-form-btn">
      <button class="contact100-form-btn" type="submit" value="Submit" >
        <span>
          <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
          Submit
        </span>
      </button>
    </div>
  </form>
</div>
</div>
<?php
    $u = $_POST["USN"];
    ?>
<div class="sa">
<div class="columns">
<p class="header1">Student information</p>
  <ul class="students">
    <?php
 $stmt = prepared_query($conn,"SELECT * FROM students WHERE usn=?",[$u]);
 $student_details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 foreach ($student_details as $row)
 {
  echo "<li>Name  :  ".$row['name']."</li><li>USN  :  ".$row['usn']."</li><li>Date of Birth  :  ".$row['dob']."</li><li>Blood group  :  ".$row['bg']."</li>";
  
 }
    ?>
  </ul>
</div>

<div class="columns">
<p class="header2">Attendance Information</p>
<table id="attendance">
      <?php
      $stmt = prepared_query($conn,"SELECT * FROM attendance WHERE usn=?",[$u]);
      $student_details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      echo "<tr><th>Dates</th><th>Period number</th><th>Status</th></tr>";
      foreach ($student_details as $row)
      {
          echo "<tr><td>". $row['all_dates'] ."</td><td>".$row['period_no'] ."</td><td>".$row['attendance_status'] ."</td></tr>";
      }
      ?>
    </table>  
</div>
    </div>
    </div>

    <footer>
      <div class="credits">
      <ul >
        <li><h3>Project by:</h3></li>
        <li>Akash R Kashyap</li>
        <li>Adithya S</li>
        <li>Bharathesh Gowda SM</li>
        <li>Chandrashekar A</li>
        <li><h4>Under the guidance of Bindu k (asst. prof)</h4></li>
      </ul>
      </div>
      <div class="college">
      <ul>
      <li><h3>Global Academy Of Technology</h3></li>
        <li>Bangalore</li>
        <li>India</li>
      </ul>  
    </div>
    </footer>
</body>
</html>