<?php
$servername = "db";  
$username = "root";
$password = "password";
$dbname = "voting_app";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vote = $_POST['vote'];
    
    // Insert or update the vote count
    $stmt = $conn->prepare("INSERT INTO votes (option_name, count) VALUES (?, 1) ON DUPLICATE KEY UPDATE count = count + 1");
    $stmt->bind_param("s", $vote);
    
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();
}

// Retrieve vote counts
$result = $conn->query("SELECT option_name, count FROM votes");

if (!$result) {
    die("Error in query: " . $conn->error);
}

$votes = [];
while ($row = $result->fetch_assoc()) {
    $votes[$row['option_name']] = $row['count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Simple Voting App</title>
</head>
<body>
  <h1>Vote for your favorite option</h1>
  <form method="post">
    <button type="submit" name="vote" value="option1">Vote Option 1</button>
    <button type="submit" name="vote" value="option2">Vote Option 2</button>
  </form>

  <h2>Results:</h2>
  <p>Option 1: <?php echo $votes['option1'] ?? 0; ?> votes</p>
  <p>Option 2: <?php echo $votes['option2'] ?? 0; ?> votes</p>
</body>
</html>
