<!doctype html>
<html>
<head>
	<title>Connect to a Database</title>
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
	$username = "root"; 
	$password = "";	

	try {
		$conn = new PDO("mysql:host=$servername", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<p style='color:green'>Successfully connected!</p>";    // generates HTML code to display success message
	} catch (PDOException $err) {
		echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";   // displays message for the error that has happened
	}

	unset($conn);  // Always close the connection, when not needed any more.

	echo "<a href='../index.html'>Back to Home</a>";
	?>

</body>

</html>