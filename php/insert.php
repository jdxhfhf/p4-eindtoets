<?php
session_start();
include "database.php";
global $db;


$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['naam'] );
    $klas = intval($_POST['klas'] );

    if ( !$name || !$klas) {
        $message = "Vul alle correct in.";
    } else {
        try {
            $stmt = $db->prepare("INSERT INTO leerling (naam, klas) VALUES ( ?, ?)");
            $stmt->execute([$name, $klas]);
            $message =  "succesvol toegevoegd a niew student!";
        } catch (PDOException $e) {
            $message = "Fout bij het toevoegen van het leerling: " . htmlspecialchars($e->getMessage());
        }
    }
}

try {
    $stmt = $db->query("SELECT naam,klas  FROM leerling");
    $leerlings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $leerlings = [];
    $message = "Fout bij het ophalen van leerlingens.";
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nieuw Leerling Toevoegen</title>
</head>

<body>
<div class="container mt-5">
    <h1>Nieuw Leerling Toevoegen</h1>

    <?php if ($message): ?>
        <div"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="title" class="form-label">Name</label>
            <input type="text" class="form-control" id="title" name="naam" required />
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Class</label>
            <textarea class="form-control" id="content" name="klas" rows="1" required></textarea>
        </div>



        <button type="submit" >Toevoegen</button>
        <button type="button" onclick="window.location.href='index.php'">Terug naar leerlings</button>

    </form>
</div>

</body>

</html>