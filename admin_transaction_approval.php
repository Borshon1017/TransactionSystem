<?php
session_start();
$transactionsFile = "transactions.json";
$transactionsData = file_get_contents($transactionsFile);
$transactions = json_decode($transactionsData, true);

if ($transactions === null) {
    $transactions = ["transactions" => []];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Transaction Approval</title>
</head>
<body>
    <style>
        button[type="submit"] {
            background-color: green;
            border: none;
            color: white;
            width: 100px;
            height: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

       
        button[type="submit"]:hover {
            background-color: white;
            color: black;
        }
        </style>
    <h2 align="center">Admin Transaction Approval</h2>

    <div style="display: flex;">
        <div style="flex: 1;">
            <h3>Pending Transactions</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                <?php
                $pendingTransactions = $transactions["transactions"];
                $totalPending = count($pendingTransactions);

                for ($index = 0; $index < $totalPending; $index++) {
                    $transaction = $pendingTransactions[$index];
                    if ($transaction[$_SESSION["username"]] == 0) {
                        echo "<tr>";
                        echo "<td>{$transaction['id']}</td>";
                        echo "<td>{$transaction['from']}</td>";
                        echo "<td>{$transaction['to']}</td>";
                        echo "<td>{$transaction['amount']}</td>";
                        echo "<td><button  type=\"submit\" onclick=\"approveTransaction({$transaction['id']})\">Approve</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>

        <div style="flex: 1;">
            <h3>Approved Transactions</h3>
            <ul>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                    for ($index = 0; $index < $totalPending; $index++) {
                        $transaction = $pendingTransactions[$index];
                        if ($transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'] > 1 || $transaction[$_SESSION["username"]]==1 ) {
                            echo "<tr>";
                            echo "<td>{$transaction['id']}</td>";
                            echo "<td>{$transaction['from']}</td>";
                            echo "<td>{$transaction['to']}</td>";
                            echo "<td>{$transaction['amount']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </ul>
        </div>
    </div>

    <script>
    function approveTransaction(id) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_approve_transaction.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    location.reload(); 
                } else {
                    console.error("Error approving transaction.");
                }
            }
        };
        xhr.send("id=" + encodeURIComponent(id));
    }
</script>
</body>
</html>
