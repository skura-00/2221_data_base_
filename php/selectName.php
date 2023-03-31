<!DOCTYPE html>
<html lang="en">
<head>
  <title>Select some Student from their name</title>

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
    $sql = "SELECT StudID,Fname,Lname FROM $dbname.Member WHERE Fname LIKE '$_POST[Sname]%'";
    $stmnt = $conn->prepare($sql);

    $stmnt->execute();

    $row = $stmnt->fetch();
    if($row) {
      echo '<table>';
      echo '<tr> <th>StudentID</th> <th>First Name</th> <th>Last Name</th>  </tr>';
      do {
        echo "<tr><td>$row[StudID]</td><td>$row[Fname]</td><td>$row[Lname]</td></tr>";
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