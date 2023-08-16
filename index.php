
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
    <form method="post" action="login_code.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="submit" value="🔑 Login ">
    </form>
    </div>
    </font>
</body>
</html>
