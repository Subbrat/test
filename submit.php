<?php
$servername = "localhost";
$username = "id20250442_minad";
$password = "sp^a@PcWruXXxJ77JqhL";
$dbname = "id20250442_ctx";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$text = $_POST['text'];

$sql = "INSERT INTO messages (text)
VALUES ('$text')";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
