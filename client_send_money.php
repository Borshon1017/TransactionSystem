<!DOCTYPE html>
<html>
<head>
    <title>Client Send Money</title>
</head>
<body>
    <h2>Send Money</h2>
    <form action="process_send_money.php" method="post">
        <label for="to">To:</label>
        <input type="text" id="to" name="to" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <input type="submit" value="Send">
    </form>
</body>
</html>
