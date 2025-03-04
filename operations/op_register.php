<?php

include "database.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    try {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = trim($_POST['email']);
        $password = $_POST['pw'];

        $sql = "INSERT INTO user(fname, lname, email, password) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fname, $lname, $email, $password);

        $stmt->execute();
        echo "<script>
              alert('Registered successfully!');
              window.location.href = '../authentication/login.php';
           </script>";
        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $conn->close();
        die($e);
    }
}
