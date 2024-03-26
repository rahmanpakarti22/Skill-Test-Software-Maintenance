<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffe_web_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $distributor_name = $_POST['distributor_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO distributor (distributor_name, city, state, country, phone, email) VALUES ('$distributor_name', '$city', '$state', '$country', '$phone', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: distributor.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
