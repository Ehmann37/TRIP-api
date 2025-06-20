<?php
require_once __DIR__ . '/../config/db.php';

function getAllStops() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM stop");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStopById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM stop WHERE stop_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addStop($data) {
    global $pdo;
    $sql = "INSERT INTO stop (stop_name, longitude, latitude) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['stop_name'],
        $data['longitude'],
        $data['latitude']
    ]);
    return $pdo->lastInsertId();
}

function updateStop($id, $data) {
    global $pdo;
    $sql = "UPDATE stop SET stop_name = ?, longitude = ?, latitude = ? WHERE stop_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['stop_name'],
        $data['longitude'],
        $data['latitude'],
        $id
    ]);
    return $stmt->rowCount() > 0;
}

function deleteStop($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM stop WHERE stop_id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}
?>
