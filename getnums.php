<?php

require_once __DIR__ . '/../../../db_login.php';

$conn = new PDO("mysql:host=localhost;dbname=cs383", $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

$query = $conn->prepare("SELECT DISTINCT num FROM master_schedule WHERE sub = :sub ORDER BY num");
$query->execute(['sub' => $_POST['sub']]);

$numbers = array_column($query->fetchAll(), 'num');

echo json_encode($numbers);
