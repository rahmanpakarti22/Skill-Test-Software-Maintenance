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
        /* Popup form */
        .popup-form {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
        }
        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            border-radius: 8px;
        }
        .popup-content h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .popup-content label {
            display: block;
            margin-bottom: 8px;
        }
        .popup-content input[type="text"],
        .popup-content input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .popup-content input[type="submit"],
        .popup-content button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .popup-content input[type="submit"]:hover,
        .popup-content button:hover {
            background-color: #555;
        }
        .action-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .action-button:hover {
            background-color: #df362d;
        }
    </style>
</head>
<body>

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

<div class="menu">
    <a href="dashboard.php">Home</a>
    <a href="catalouge.php">Catalogue</a>
    <a href="distributor.php">Distributor</a>
    <a href="#" class="active">Upload</a>
    <a href="?logout">Logout</a>
</div>

<div style="padding:20px; margin-top:100px;">
<button class="action-button" onclick="showForm()">Tambah Data</button>
    <table border="1" cellspacing="0" cellpadding="10" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>File</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "coffe_web_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM upload";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["judul"]."</td>";
                    echo "<td>".$row["file"]."</td>";
                    echo "<td>".$row["author"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data available</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<div class="popup-form" id="popupForm">
    <div class="popup-content">
        <h2>Tambah Data</h2>
        <form action="add_data_upload.php" method="post" enctype="multipart/form-data">
            <label for="judul">Title:</label><br>
            <input type="text" id="judul" name="judul" required><br>
            <label for="file">File:</label><br>
            <input type="file" id="file" name="file" required><br>
            <label for="author">Author:</label><br>
            <input type="text" id="author" name="author" required><br><br>
            <input type="submit" value="Submit">
        </form>
        <button onclick="hideForm()">Close</button>
    </div>
</div>


<div class="footer">
    Today's Date: <?php echo date("F j, Y"); ?>
</div>

<script>
    function showForm() {
        document.getElementById('popupForm').style.display = 'block';
    }

    function hideForm() {
        document.getElementById('popupForm').style.display = 'none';
    }
</script>

</body>
</html>
