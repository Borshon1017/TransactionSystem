<?php
session_start();

$id = $_POST["id"];
$adminField = $_SESSION["username"];
$adminTransactionsFile = "admins/" . $adminField . "/".$adminField."_transactions.json";
$mainTransactionsFile = "transactions.json";

$adminTransactionsData = file_get_contents($adminTransactionsFile);
$adminTransactions = json_decode($adminTransactionsData, true);

if ($adminTransactions === null) {
    $adminTransactions = ["transactions" => []];
}

$mainTransactionsData = file_get_contents($mainTransactionsFile);
$mainTransactions = json_decode($mainTransactionsData, true);

$approvedTransaction = null;

foreach ($mainTransactions["transactions"] as &$transaction) {
    if ($transaction["id"] == $id) {
        $transaction[$adminField] = 1;
        $approvedTransaction = $transaction;
        break;
    }
}

if ($approvedTransaction !== null) {
    $adminTransactions["transactions"][] = $approvedTransaction;
    file_put_contents($adminTransactionsFile, json_encode($adminTransactions, JSON_PRETTY_PRINT));

    file_put_contents($mainTransactionsFile, json_encode($mainTransactions, JSON_PRETTY_PRINT));
    echo "Transaction approved successfully.";
} else {
    echo "Transaction not found.";
}
?>
