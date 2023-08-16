
?>
<!DOCTYPE html>
<html>
<head>
    <title>Client Send Money</title>
</head>
<body>
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
            background-color: #d9faee;
        }
        
    </style>
    <font face="Yu Gothic Light">
<div class="container">
    <h2>Send Money</h2>
    <form action="process_send_money.php" method="post">
        <label for="to">To:</label>
        <input type="text" id="to" name="to" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <input type="submit" value="Send">
    </form>
    </div>
    </font>
</body>
</html>
