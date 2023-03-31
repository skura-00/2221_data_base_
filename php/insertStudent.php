<!doctype html>
<html>
<head>
	<title>Insert Data</title>
  <style>
    a {
			position: absolute;
      text-decoration: none;
      color: white;
      font-weight: bold;
      font-size: 20px;
      padding: 20px;
      background-color: black;
			margin-top: 30px;
    }
  </style>
</head>
<body>

<?php
$servername ="localhost";
$dbname = "ClubDB";
$username = "root";
$password = "";

/* Try MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password).
If the connection was tried and it was successful the code between braces after try is executed, if any error happened while running the code in try-block, 
the code in catch-block is executed. */
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets the error mode of PHP engine to Exception to display all the errors
	echo "<p style='color:green'>Successfully connected</p>";
}
catch (PDOException $err) {
	echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
}

try {
	$sql="INSERT INTO $dbname.Member ( StudID, Saddress,	FName,	LName,DoB,	email) VALUES (:stdID, :address, :f_name, :l_name, :DoB, :Email);";
  
	$stmnt = $conn->prepare($sql);   
	$stmnt->bindParam(':stdID', $_POST['stdId']); 
	$stmnt->bindParam(':address', $_POST['Saddress']);
	$stmnt->bindParam(':f_name', $_POST['fname']);
	$stmnt->bindParam(':l_name', $_POST['lname']);
	$stmnt->bindParam(':DoB', $_POST['dob']);
  $stmnt->bindParam(':Email', $_POST['email']);

	$stmnt->execute();

	$sql2 = "INSERT INTO $dbname.Student (StudID, Major) VALUES (:stdID, :major);";  

	$stmnt2 = $conn->prepare($sql2);

	$stmnt2->bindParam(':stdID', $_POST['stdId']); 
	$stmnt2->bindParam(':major', $_POST['mjr']);

	$stmnt2->execute();

	echo "<p style='color:green'>Data Inserted Into Table Successfully</p>";
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Insertion Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close the connection
unset($conn);

echo "<a style='margin-bottom:30px;' href='../insert.html'>Insert More Values</a> <br />";
echo "<br/><br/><br/>";
echo "<a href='../index.html'>Back to Home</a>";

?>

</body>
</html>