<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT name, password FROM users WHERE name = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $stmt->bind_result($dbUsername, $dbPassword);

        if ($stmt->fetch()) {
            if (strcmp($password, $dbPassword) === 0) {
                // Redirect to account.html
                header("Location: account.html");
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