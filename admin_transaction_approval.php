<?php
session_start();

$transactionsFile = "transactions.json";
$transactionsData = file_get_contents($transactionsFile);
$transactions = json_decode($transactionsData, true);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Transaction Approval</title>
</head>
<body>
    <style>
        button[type="submit"] {
            background-color: Black;
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
        table {
  border-spacing: 0px;
}
th, td {
  padding: 10px;
}
        </style>
        <font face="Yu Gothic Light">
    <h2 align="center">Admin Transaction Approval</h2>

    <div style="display: flex;">
        <div >
            <h3>Pending Transactions</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>Vote Count</th>
                    <th>Accept</th>
                    <th>Reject</th>
                </tr>
                <?php
                $pendingTransactions = $transactions["transactions"];
                $totalPending = count($pendingTransactions);

                for ($index = 0; $index < $totalPending; $index++) {
                    $transaction = $pendingTransactions[$index];
                    if ($transaction[$_SESSION["username"]] == 0 && ($transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'] < 2) ) {
                        echo "<tr>";
                        echo "<td>{$transaction['id']}</td>";
                        echo "<td>{$transaction['from']}</td>";
                        echo "<td>{$transaction['to']}</td>";
                        echo "<td>{$transaction['amount']}</td>";
                        $TotalCount=$transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'];
                        if ($TotalCount==0)
                        {
                            echo "<td>🚫 </td>";
                        }
                        if ($TotalCount==1)
                        {
                            echo "<td>👤 </td>";
                        }
                        if ($TotalCount==2)
                        {
                            echo "<td> 👤👤</td>";
                        }
                        
                        echo "<td><button  type=\"submit\" onclick=\"approveTransaction({$transaction['id']})\">Approve</button></td>";
                        echo "<td><button  type=\"submit\" onclick=\"rejectTransaction({$transaction['id']})\">Reject</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>

        <div >
            <h3> &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Approved Transactions</h3>
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
                        if ($transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'] > 1 && ($transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'] < 9) || $transaction[$_SESSION["username"]]==1 ) {
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
        let xhr = new XMLHttpRequest();
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
        xhr.send("aid=" + encodeURIComponent(id));
    }
    function rejectTransaction(id) {
        let xhr = new XMLHttpRequest();
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
        xhr.send("rid=" + encodeURIComponent(id));
    }
</script>
<font face="Yu Gothic Light">
</body>
</html>
