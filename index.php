<?php
require_once('database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];




    $conn = dbConnection();


    $query = "SELECT * FROM userinfo WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];
        
        if ($row["role"] === "Client") {
            header("Location: client.php");
            
        } elseif ($row["role"] === "Admin") {
            header("Location: admin.php");
          
        }
    } 


}
?>
<!DOCTYPE html>

<style>
    body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
      
        input[type="submit"] {
            background-color: green;
            border: none;
            color: white;
            width: 100px;
            height: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

       
        input[type="submit"]:hover {
            background-color: white;
            color: black;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 50px;
            background-color: #f8f8f8;
        }
    </style>
<html>
<head>
    <title>Money Transfer System</title>
</head>
<body>
<font face="Yu Gothic Light">
<div class="container">
    <h1>Money Transfer System</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
    </div>
    </font>
</body>
</html>
