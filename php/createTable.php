<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Table</title>
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
    $conn = new PDO("mysql:host=$servername; dbname=$dbname",$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green'>Connected Successfully</p>";
  } catch (PDOException $err) {
    echo "<p style='color:red'>Connection Failed: " .$err->getMessage(). "</p>\r\n";
  }

  try {
    $sql = "CREATE TABLE Member(
      StudID INT,
      Saddress VARCHAR(100), 
      FName VARCHAR(15) NOT NULL, 
      LName VARCHAR(15) NOT NULL, 
      DoB DATE,
      email VARCHAR(30) UNIQUE, 
      PRIMARY KEY (StudID)
    );".
    "CREATE TABLE Student(
      StudID INT,
      Major VARCHAR(35) NOT NULL, 
      PRIMARY KEY (StudID),
      FOREIGN KEY (StudID) REFERENCES Member(StudID) ON DELETE CASCADE
    );";
    $stmnt = $conn->prepare($sql);
    $stmnt->execute();
    echo "<p style='color:green'>A table created successfully</p>";
  } catch (PDOException $err) {
    echo "<p style='color:red'>Failed to create a new table: " .$err->getMessage(). "</p>\r\n";
  }

  unset($conn);

  echo "<a href='../index.html'>Back to Home</a>";
  ?>
</body>
</html>