<?php

session_start();
include "database.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the current status of the task
    $sql = "SELECT completed FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $stmt->bind_result($completed);
    $stmt->fetch();
    $stmt->close();

    // Toggle the completed status
    $new_status = ($completed == 1) ? 0 : 1;

    // Update the task status in the database
    $sql = "UPDATE tasks SET completed = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $new_status, $id, $user_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    header('location: ../task/user.php');
    exit();
}
