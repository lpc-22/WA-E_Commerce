<?php
session_start();

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT name, email, password FROM users WHERE name = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($dbUsername, $dbEmail, $dbPassword);

        if ($stmt->fetch()) {
            if (strcmp($password, $dbPassword) === 0) {
                // Store user data in session and redirect to account.php
                $_SESSION['username'] = $dbUsername;
                $_SESSION['email'] = $dbEmail;
                header("Location: account.php");
                exit;
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Username not found.";
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement. " . $link->error;
    }

    $link->close();
}
?>