<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #ffffff;
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header img {
            margin-right: 20px;
        }
        .header h1, .header h3 {
            margin: 10px 0;
        }
        .menu {
            background-color: #333;
            overflow: hidden;
            text-align: right;
        }
        .menu a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .menu a:hover {
            background-color: #ddd;
            color: black;
        }
        .menu a.active {
            background-color: #555;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<?php
session_start();

function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
if (isset($_GET['logout'])) {
    logout();
}
?>

<div class="header">
    <div class="header-left">
        <img src="coffee.png" alt="Coffee Valley Logo" width="100">
        <div>
            <h1>Coffee Valley</h1>
            <h3>Taste the love in every cup</h3>
            <h3>One Alewife Center 3rd floor Cambridge, MA 02140</h3>
        </div>
    </div>
</div>

<div class="menu">
    <a href="#" class="active">Home</a>
    <a href="catalouge.php">Catalogue</a>
    <a href="distributor.php">Distributor</a>
    <a href="upload.php">Upload</a>
    <a href="?logout">Logout</a>
</div>

<div style="padding:20px; margin-top:100px;">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "coffe_web_db";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM master_dailybean WHERE price >= 0.00 LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h1>Bean of the Day</h1>";
            echo "<h4>" . $row["bean_of_the_day"] . "</h4>";
            echo "<h1>Sale Price</h1>";
            echo "<h4>$" . $row["price"] . "</h4>";
            echo "<h1>Description</h1>";
            echo "<h4>" . $row["description"] . "</h4>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</div>

<div class="footer">
    Today's Date: <?php echo date("F j, Y"); ?>
</div>

</body>
</html>
