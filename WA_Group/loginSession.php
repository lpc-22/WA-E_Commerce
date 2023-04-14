<?php
session_start();

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, email, password FROM users WHERE name = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $stmt->bind_result($dbUserID, $dbUsername, $dbEmail, $dbPassword);

            if ($stmt->fetch()) {
                if (password_verify($password, $dbPassword)) {
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
						window.location.href = 'login.php';
					</script>
					<?php
                    exit;
                }
            } else {
				?>
				<script>
					alert("Username not found");
					window.location.href = 'login.php';
				</script>
				<?php
                exit;
            }

            $stmt->close();
        } else {
            $_SESSION['login_error'] = "Error: Unable to execute statement. " . $link->error;
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Error: Unable to prepare statement. " . $link->error;
        header("Location: login.php");
        exit;
    }

    $link->close();
}
?>