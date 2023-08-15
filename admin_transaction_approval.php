<!DOCTYPE html>
<html>
<head>
    <title>Admin Transaction Approval</title>
</head>
<body>
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
                    if ($transaction['admin1'] == 0) {
                        echo "<tr>";
                        echo "<td>{$transaction['id']}</td>";
                        echo "<td>{$transaction['from']}</td>";
                        echo "<td>{$transaction['to']}</td>";
                        echo "<td>{$transaction['amount']}</td>";
                        echo "<td><button onclick=\"approveTransaction({$transaction['id']})\">Approve</button></td>";
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
                        if ($transaction['admin1'] + $transaction['admin2'] + $transaction['admin3'] > 0) {
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
       
        fetch("process_approve_transaction.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + encodeURIComponent(id),
        })
        .then(response => {
            if (response.ok) {
               
                location.reload();
            } 
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
    </script>
</body>
</html>
