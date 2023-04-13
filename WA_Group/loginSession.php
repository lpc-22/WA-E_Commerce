<?php
session_start();

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, email, password FROM users WHERE name = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($dbUserID, $dbUsername, $dbEmail, $dbPassword);

        if ($stmt->fetch()) {
            if (strcmp($password, $dbPassword) === 0) {
                // Store user data in session and redirect to account.php
                $_SESSION['userID'] = $dbUserID;
                $_SESSION['username'] = $dbUsername;
                $_SESSION['email'] = $dbEmail;

                header("Location: account.php");
                exit;
            } else {
				?>
				<script>
					alert("Incorrect password");
					window.location.href = 'login.html';
				</script>
				<?php
            }
        } else {
				?>
				<script>
					alert("Username not found");
					window.location.href = 'login.html';
				</script>
				<?php
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement. " . $link->error;
    }

    $link->close();
}
?>