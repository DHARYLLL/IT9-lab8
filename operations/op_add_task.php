<?php

session_start();
include "database.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method == 'POST') {
    $task = trim($_POST["task"]);
    $user_id = $_SESSION["user_id"];

    if (!empty($task)) {
        try {
            // Prepare the SQL statement
            $sql = "INSERT INTO tasks (user_id, task) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $task);

            if ($stmt->execute()) {
                echo "<script>alert('Task added successfully!';
                window.location.href = '../task/user.php';
                </script>";

                //$_SESSION["message"] = "Task added successfully!";
            }
            $stmt->close();
        } catch (Exception $e) {
            $_SESSION["error"] = "Database Error: " . $e->getMessage();
        }
    } else {
        $_SESSION["error"] = "Task cannot be empty.";
    }
    header("location: ../task/user.php");
}
