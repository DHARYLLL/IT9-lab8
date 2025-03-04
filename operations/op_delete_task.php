<?php
session_start();
include "database.php";

try {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM tasks WHERE id=? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<script>
    alert('Task deleted successfully.');
    window.location.href = '../task/user.php';
    </script>";
    exit();
} catch (\Exception $e) {
    $conn->close();
    die($e);
}
