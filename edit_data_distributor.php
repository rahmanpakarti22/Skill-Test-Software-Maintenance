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
    $id = $_POST['id_distributor'];
    $distributor_name = $_POST['distributor_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE distributor SET distributor_name='$distributor_name', city='$city', state='$state', country='$country', phone='$phone', email='$email' WHERE id_distributor=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: distributor.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
