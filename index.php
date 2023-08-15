<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];




    $conn = mysqli_connect('localhost', 'root', '', 'iMBD');


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
<html>
<head>
    <title>Money Transfer System</title>
</head>
<body>
    <h1>Welcome to Money Transfer System</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
   
</body>
</html>
