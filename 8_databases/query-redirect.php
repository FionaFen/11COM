<!DOCTYPE html>

<?php
/*
Usage:

1. Modifying this script:
    - Change the values for username, password, dbname.
    - Program in your $tableSQL and $insertSQL commands.
    - Host this PHP script on the same server as your SQL.
2. Using the result:
    - Call this page from an HTML form using <form action="query-redirect.php">.
    - Fill in your remaining HTML, CSS, and JS for this page to appear as desired.
    - The result of the query has been made available as `result` in the script tag.
        - It will be an array of rows (each row has fieldnames and values).
*/

// Setup DB info.
$servername = "localhost";
$username = "???";
$password = "???";
$dbname = "???";

// Create connection.
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection.
if ($conn->connect_error) {
    http_response_code(400);
	die("Connection failed: " . $conn->connect_error);
}

// Query DB.
$sql = "SELECT * FROM Table;";
$resultObj = $conn->query($sql);

// Parse the query result.
if ($resultObj->num_rows > 0) {
	while ($row = $resultObj->fetch_assoc()) {
		$result[] = $row;
	}
}

// Close the connection.
$conn->close();
?>

<html>
  <head></head>
  <body>

    <script>
      // Pass the query result from PHP to JS.
      var result = <?php echo json_encode($result); ?>;
    </script>
  </body>
</html>
