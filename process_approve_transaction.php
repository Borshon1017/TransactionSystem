<?php
// Process the approve transaction request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["index"])) {
    $index = $_POST["index"];

    // Load and update the transactions
    $transactionsFile = "transactions.json";
    $transactionsData = file_get_contents($transactionsFile);
    $transactions = json_decode($transactionsData, true);

    // Check if the transaction index is valid
    if ($index >= 0 && $index < count($transactions["transactions"])) {
        $transactions["transactions"][$index]["vote"]++;

        // If the vote count reaches 2, move the transaction to the approved list
        if ($transactions["transactions"][$index]["vote"] >= 2) {
            $approvedTransaction = $transactions["transactions"][$index];
            $transactions["approved"][] = $approvedTransaction;

            // Remove the transaction from the pending list
            array_splice($transactions["transactions"], $index, 1);
        }

        // Save the updated transactions
        file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT));

        // Return a success response
        echo json_encode(["success" => true]);
    } else {
        // Return an error response
        echo json_encode(["success" => false]);
    }
} else {
    // Return an error response
    echo json_encode(["success" => false]);
}
?>
