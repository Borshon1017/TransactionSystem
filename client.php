<!DOCTYPE html>
<html>
<head>
    <title>Money Transfer System</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .buttonOut {
            display: inline-block;
            background-color: black;
            border: none;
            color: white;
            width: 100px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        
        .buttonOut:hover {
            background-color: white;
            color: red;
        }
        .buttonSend {
            display: inline-block;
            background-color: black;
            border: none;
            color: white;
            width: 150px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        
        .buttonSend:hover {
            background-color: white;
            color: green;
        }
    </style>
</head>
<body>
<font face="Yu Gothic Light">
    <div>
        <h1>Client Dashboard</h1>
        <a href="client_send_money.php" class="buttonSend">৳ Send Money</a>
        <a href="Logout.php" class="buttonOut">⎋ Logout</a>
    </div>
    <font face="Yu Gothic Light">
</body>
</html>
