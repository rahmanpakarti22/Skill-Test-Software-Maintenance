<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h1, .login-container h3 {
            margin: 10px 0;
        }
        form div {
            margin-bottom: 15px;
            text-align: center;
        }
        form div label {
            display: block;
            margin-bottom: 5px;
        }
        form div input[type="text"],
        form div input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        form div input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form div input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="coffee.png" alt="Coffee Valley Logo" width="100">
    <h1>Coffee Valley</h1>
    <h3>Taste the love in every cup</h3>
    <h3>One Alewife Center 3rd floor Cambridge, MA 02140</h3>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffe_web_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Terjadi kesalahan: " . $conn->connect_error);
        }

        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM master_user WHERE user_id = '$user_id' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: dashboard.php");
        } else {
            echo "<p>Invalid userid or password</p>";
        }

        $conn->close();
    }
    ?>

    <form action="" method="post">
        <div>
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</div>

</body>
</html>
