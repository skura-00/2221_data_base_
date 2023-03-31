<!DOCTYPE html>
<html lang="en">
<head>
  <title>Select Student Data from Major</title>

  <style>
    a {
			position: absolute;
      text-decoration: none;
      color: white;
      font-weight: bold;
      font-size: 20px;
      padding: 20px;
      background-color: black;
    }
  </style>
</head>
<body>
  <?php 
  $servername = "localhost";
  $dbname = "ClubDB";
  $username = "root";
  $password = "";

  try {
    $conn = new PDO("mysql:host=$servername; dbname = $dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green'>Successfully connected</p>";
  } catch (PDOException $err) {
    echo "<p style='color:red'>Connection Failed: ". $err->getMessage() ."</p>\r\n";
  }

  try {
    $sql = "SELECT Student.Major,Member.StudID,Fname,Lname,DoB FROM $dbname.Member INNER JOIN $dbname.Student ON Student.StudID = Member.StudID WHERE Student.Major = '$_POST[major]'";
    $stmnt = $conn->prepare($sql);

    $stmnt->execute();

    $row = $stmnt->fetch();
    if($row) {
      echo '<table>';
      echo '<tr><th>Major</th> <th>StudentID</th> <th>First Name</th> <th>Last Name</th> <th>ate of Birth</th> </tr>';
      do {
        echo "<tr><td>$row[Major]</td><td>$row[StudID]</td><td>$row[Fname]</td><td>$row[Lname]</td><td>$row[DoB]</td></tr>";
      }while ($row = $stmnt->fetch());
      echo '</table>';
    }
    else {
      echo "<p>No record found!</p>";
    }
  } catch (PDOException $err) {
    echo "<p style='color:red'>Failed to retrieve record: " . $err->getMessage() . "</p>\r\n";
  }

  unset($conn);
  echo "<a href='../index.html'>Back to Home</a>";
  ?>
</body>
</html>