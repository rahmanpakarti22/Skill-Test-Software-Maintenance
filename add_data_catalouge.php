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

$bean_name = $_POST['bean_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$sql = "INSERT INTO master_katalog (bean_name, description, price) VALUES ('$bean_name', '$description', '$price')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: catalouge.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
