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
    <a href="dashboard.php">Home</a>
    <a href="catalouge.php">Catalogue</a>
    <a href="#" class="active">Distributor</a>
    <a href="upload.php" >Upload</a>
    <a href="?logout">Logout</a>
</div>

<div style="padding:20px; margin-top:100px;">
<button class="action-button" onclick="showForm()">Tambah Data</button>
    <table border="1" cellspacing="0" cellpadding="10" width="100%">
        <thead>
            <tr>
                <th>Ditributor Name</th>
                <th>City</th>
                <th>Action</th>
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

            $sql = "SELECT * FROM distributor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["distributor_name"]."</td>";
                    echo "<td>".$row["city"]."</td>";
                    echo "<td>
                            <a href='delete_data_distributor.php?id_distributor=".$row["id_distributor"]."' onclick='return confirm(\"Are you sure?\")'>Delete</a> |
                            <a href='#' onclick='showForm(\"edit\", ".$row["id_distributor"].")'>Edit</a>
                          </td>";
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
        <form action="add_data_distributor.php" method="post">
            <label for="distributor_name">Distributor name:</label><br>
            <input type="text" id="distributor_name" name="distributor_name" required><br>
            <label for="city">City:</label><br>
            <input type="text" id="city" name="city" required><br>
            <label for="state">State:</label><br>
            <input type="text" id="state" name="state" required><br>
            <label for="country">Country/Region:</label><br>
            <select id="country" name="country" required>
                <option value="Indonesia">Indonesia</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Singapore">Singapore</option>
                <option value="Thailand">Thailand</option>
                <option value="Philippines">Philippines</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Laos">Laos</option>
                <option value="Brunei">Brunei</option>
                <option value="Timor-Leste">Timor-Leste</option>
                <option value="China">China</option>
                <option value="Japan">Japan</option>
                <option value="South Korea">South Korea</option>
                <option value="North Korea">North Korea</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Macau">Macau</option>
                <option value="Mongolia">Mongolia</option>
                <option value="India">India</option>
            </select><br><br>
            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" required><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<div class="footer">
    Today's Date: <?php echo date("F j, Y"); ?>
</div>


<div class="popup-form" id="editPopupForm">
    <div class="popup-content">
        <h2 id="formTitle">Edit Data</h2>
        <form id="editDataForm" method="post" action="edit_data_distributor.php">
            <input type="hidden" id="editId" name="id_distributor">
            <label for="edit_distributor_name">Distributor name:</label><br>
            <input type="text" id="edit_distributor_name" name="distributor_name" required><br>
            <label for="edit_city">City:</label><br>
            <input type="text" id="edit_city" name="city" required><br>
            <label for="edit_state">State:</label><br>
            <input type="text" id="edit_state" name="state" required><br>
            <label for="edit_country">Country/Region:</label><br>
            <select id="edit_country" name="country" required>
                <option value="Indonesia">Indonesia</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Singapore">Singapore</option>
                <option value="Thailand">Thailand</option>
                <option value="Philippines">Philippines</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Laos">Laos</option>
                <option value="Brunei">Brunei</option>
                <option value="Timor-Leste">Timor-Leste</option>
                <option value="China">China</option>
                <option value="Japan">Japan</option>
                <option value="South Korea">South Korea</option>
                <option value="North Korea">North Korea</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Macau">Macau</option>
                <option value="Mongolia">Mongolia</option>
                <option value="India">India</option>
            </select><br><br>
            <label for="edit_phone">Phone:</label><br>
            <input type="text" id="edit_phone" name="phone" required><br>
            <label for="edit_email">Email:</label><br>
            <input type="text" id="edit_email" name="email" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<script>
    function showForm(type, id = null) {
    if (type === 'add') {
        document.getElementById('popupForm').style.display = 'block';
        document.getElementById('editPopupForm').style.display = 'none';
    } else if (type === 'edit' && id !== null) {
        document.getElementById('popupForm').style.display = 'none';
        document.getElementById('editPopupForm').style.display = 'block';

        fetch(`get_data_distributor_by_id.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editId').value = data.id_distributor;
            document.getElementById('edit_distributor_name').value = data.distributor_name;
            document.getElementById('edit_city').value = data.city;
            document.getElementById('edit_state').value = data.state;
            document.getElementById('edit_country').value = data.country;
            document.getElementById('edit_phone').value = data.phone;
            document.getElementById('edit_email').value = data.email;
        });
    }

    document.querySelector('.popup-form').style.display = 'block';
}

</script>

</body>
</html>
