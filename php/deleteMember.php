<!doctype html>
<html>
<head>
    <title>Delete data</title>
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
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets the error mode of PHP engine to Exception to display all the errors
        echo "<p style='color:green'>Successfully connected</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $sql = "DELETE FROM $dbname.Member WHERE StudID = '$_POST[stdId]'";
        $stmnt = $conn->prepare($sql);     // read about prepared statements here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmnt->bindParam(':stdId', $_POST['StudID']);   // :stdId is the variable that we used in $sql, there must be a colon (:) in front of it.
        //  stdId in $_POST['stdId'] is the name of the element in HTML Form. Make sure it matches exactly the name of the form element in HTML 

        $stmnt->execute();
        echo "<p style='color:green'>Record Deleted Successfully</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Delete Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>

</body>

</html>