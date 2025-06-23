<?php
session_start();
include "database.php";
global $db;


$stmtCat = $db->prepare("SELECT vak FROM toets WHERE id = :id");
$stmtCat->bindParam(':id', $leerling_id, PDO::PARAM_INT);
$stmtCat->execute();
$toets = $stmtCat->fetch(PDO::FETCH_ASSOC);

if (!$toets) {
    echo "toets niet gevonden.";
    exit;
}


$stmt = $db->prepare("SELECT naam FROM leeerlings WHERE leerling_id = :leerling_id");
$stmt->bindParam(':leerling_id', $leerling_id, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<button type="button"  onclick="window.location.href='index.php'">Terug naar overzicht</button>
</body>
</html>
