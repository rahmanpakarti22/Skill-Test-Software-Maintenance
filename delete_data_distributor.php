<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffe_web_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_distributor = $_GET['id_distributor'];

$sql = "DELETE FROM distributor WHERE id_distributor = $id_distributor";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: distributor.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
