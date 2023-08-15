<?php
session_start();

$id = $_POST["id"];
$adminField = $_SESSION["username"];

$transactionsFile = "transactions.json";
$transactionsData = file_get_contents($transactionsFile);
$transactions = json_decode($transactionsData, true);

$totalTransactions = count($transactions["transactions"]);
for ($i = 0; $i < $totalTransactions; $i++) {
    if ($transactions["transactions"][$i]["id"] == $id) {
        $transactions["transactions"][$i][$adminField] = 1;
        break;
    }
}

file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT));

?>
