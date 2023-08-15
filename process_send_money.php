<?php
session_start();

$to = $_POST["to"];
$amount = $_POST["amount"];
$initvalue = 0;

$transactionsFile = "transactions.json";
$transactionsData = file_get_contents($transactionsFile);
$transactions = json_decode($transactionsData, true);


$highestId = 0;
for ($i = 0; $i < count($transactions["transactions"]); $i++) {
    $transaction = $transactions["transactions"][$i];
    if ($transaction["id"] > $highestId) {
        $highestId = $transaction["id"];
    }
}
$newId = $highestId + 1;

$newTransaction = [
    "id" => $newId,
    "from" => $_SESSION["username"],
    "to" => $to,
    "date" => date("d-m-Y"),
    "amount" => $amount,
    "admin1" => $initvalue,
    "admin2" => $initvalue,
    "admin3" => $initvalue
];
$transactions["transactions"][] = $newTransaction;

file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT));

header("Location: client_send_money.php?success=true");

?>
