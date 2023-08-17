<?php
session_start();

$approvedId = $_POST["aid"];
$rejectedId = $_POST["rid"];

$adminField = $_SESSION["username"];

$mainTransactionsFile = "transactions.json";

$admin1TransactionsFile = "admins/admin1/admin1_transactions.json";
$admin2TransactionsFile = "admins/admin2/admin2_transactions.json";
$admin3TransactionsFile = "admins/admin3/admin3_transactions.json";


$admin1TransactionsData = file_get_contents($admin1TransactionsFile);
$admin2TransactionsData = file_get_contents($admin2TransactionsFile);
$admin3TransactionsData = file_get_contents($admin3TransactionsFile);


$admin1Transactions = json_decode($admin1TransactionsData, true);
$admin2Transactions = json_decode($admin2TransactionsData, true);
$admin3Transactions = json_decode($admin3TransactionsData, true);



$mainTransactionsData = file_get_contents($mainTransactionsFile);
$mainTransactions = json_decode($mainTransactionsData, true);

$approvedTransaction = null;

for ($i = 0; $i < count($mainTransactions["transactions"]); $i++) {
    $transaction = &$mainTransactions["transactions"][$i];
    
    if ($transaction["id"] == $approvedId) {
        $transaction[$adminField] = 1;
        $approvedTransaction = $transaction;
        break;
    } elseif ($transaction["id"] == $rejectedId) {
        $transaction[$adminField] = 10; 
        $approvedTransaction = $transaction;
        break;
    }
}

if ($approvedTransaction !== null) {
    $admin1Transactions["transactions"][] = $approvedTransaction;
    $admin2Transactions["transactions"][] = $approvedTransaction;
    $admin3Transactions["transactions"][] = $approvedTransaction;
    file_put_contents($admin1TransactionsFile, json_encode($admin1Transactions, JSON_PRETTY_PRINT));
    file_put_contents($admin2TransactionsFile, json_encode($admin2Transactions, JSON_PRETTY_PRINT));
    file_put_contents($admin3TransactionsFile, json_encode($admin3Transactions, JSON_PRETTY_PRINT));
    file_put_contents($mainTransactionsFile, json_encode($mainTransactions, JSON_PRETTY_PRINT));
    echo "Transaction processed successfully.";
} else {
    echo "Transaction not found.";
}
?>
