<?php
session_start();
include "database.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    try {

        $email = $_POST['email'];
        $password = $_POST['pw'];

        $sql = "SELECT user_id, password FROM user WHERE email = ?";
        // $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            $_SESSION["user_id"] = $user_id;
            echo "<script>
              alert('Login successfully!');
              window.location.href = '../task/user.php';
           </script>";
        } else {
            echo "<script>alert('Invalid credentials');
            window.location.href = '../Authentication/login.php';
            </script>";
        }
        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $conn->close();
        die($e);
    }
}
