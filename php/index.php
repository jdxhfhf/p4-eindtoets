<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>School</title>
</head>

<body>

<?php
include "database.php";
global $db;

try {
    $query = $db->query("SELECT id, naam, klas FROM leerling");
    $students = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div>Fout: " . htmlspecialchars($e->getMessage()) . "</div>";
    $students = [];
}
?>

<div class="container mt-4">
    <div>
        <div>
            <h1>Toets resultaten</h1>
        </div>
      </div>
    <div >
        <div >
            <ul>
                <?php foreach ($students as $student): ?>
                    <li >
                        <a href="student.php?leerling_id=<?= htmlspecialchars($student['naam']) ?>" class="text-decoration-none">
                            <?= htmlspecialchars(ucfirst($student['naam'])) ?>
                            <?= htmlspecialchars(ucfirst($student['klas'])) ?>
                        </a>
                    </li>
                    </li>

                <?php endforeach; ?>
            </ul>
            <a href="insert.php" >leerlings toevoegen</a>
        </div>
    </div>
</div>
<script></script>
</body>

</html>