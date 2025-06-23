<?php

try {

    $db = new PDO(
        "mysql:host=localhost;dbname=school",
        "root",
        ""
    );
} catch (PDOException $exception) {
    die('Error! ' . $exception->getMessage());
}