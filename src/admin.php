<?php
$servername = "db";  // Use environment variable for the hostname
$username = "root";     // Use environment variable for username
$password = "password"; // Use environment variable for password
$dbname = "voting_app";        // Use environment variable for database name


//make sure that the database is running
sleep(5);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query("SELECT option_name, count FROM votes"); // Query to get voting results

// Check if the query was successful
if (!$result) {
    die("Error retrieving voting results: " . $conn->error);
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
</head>
<body>
  <h1>Voting Results</h1>
  <table border="1">
    <tr>
      <th>Option</th>
      <th>Votes</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['option_name']; ?></td>
        <td><?php echo $row['count']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
