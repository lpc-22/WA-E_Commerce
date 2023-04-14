<?php
session_start();

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
		?>
		<script>
			alert("Passwords do not match");
			window.location.href = 'signup.php';
		</script>
		<?php
        exit;
    }

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

    if ($stmt = $link->prepare($sql)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            $_SESSION['signup_success'] = true;
			?>
			<script>
				alert("Create account successfully");
				window.location.href = 'login.php';
			</script>
			<?php
        } else {
            $_SESSION['signup_error'] = "Error: Unable to create account. " . $link->error;
            header("Location: signup.php");
            exit;
        }

        $stmt->close();
    } else {
        $_SESSION['signup_error'] = "Error: Unable to prepare statement. " . $link->error;
        header("Location: signup.php");
        exit;
    }

    $link->close();
} else {
    header("Location: signup.php");
    exit;
}
?>