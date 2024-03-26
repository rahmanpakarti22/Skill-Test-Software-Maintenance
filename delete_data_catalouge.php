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

$id_katalog = $_GET['id_katalog'];

$sql = "DELETE FROM master_katalog WHERE id_katalog = $id_katalog";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: catalouge.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
