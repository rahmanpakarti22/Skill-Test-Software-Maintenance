<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffe_web_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM distributor WHERE id_distributor=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Distributor not found"]);
    }
} else {
    echo json_encode(["error" => "ID not provided"]);
}

$conn->close();
?>
