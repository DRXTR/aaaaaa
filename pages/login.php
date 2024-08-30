<?php
// Configuration
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'your_database';

// Login
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email address';
  } else {
    // Check if email exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.php');
        exit;
      } else {
        $error = 'Invalid password';
      }
    } else {
      $error = 'Email address not found';
    }
  }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <img src="https://images.pexels.com/photos/1907785/pexels-photo-1907785.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    <div class="container">
        <div class="register-wrapper">
            <div class="register-header">
                <h2>Log-In</h2>
                <p>Fill in the details to Log</p>
            </div>
            <form class="login-form" method="post">
  <div class="input-group">
    <input type="email" id="email" name="email" required>
    <label for="email">Email</label>
  </div>
  <div class="input-group">
    <input type="password" id="password" name="password" required>
    <label for="password">Password</label>
  </div>
  <button type="submit" class="login-btn" name="login">Login</button>
</form>

    <script>
        // Função para alternar a visibilidade da senha
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling;
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>
</html>
