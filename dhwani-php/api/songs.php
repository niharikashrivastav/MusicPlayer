<?php
// ============================================================
// api/songs.php — GET all songs from database
// ============================================================

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

require_once "db.php";

$stmt = $pdo->query("SELECT * FROM songs ORDER BY id ASC");
$songs = $stmt->fetchAll();

echo json_encode($songs);
?>
