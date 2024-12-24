<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
  <div class="container">
    <p class="heading">REGISTER</p>
    <form method="POST" action="index.php?action=register" class="register-form">
      <div class="input-group">
        <label for="name" class="label">Name:</label>
        <input type="text" id="name" name="name" class="input-field" placeholder="Enter your name..." required>
      </div>

      <div class="input-group">
        <label for="email" class="label">Email:</label>
        <input type="email" id="email" name="email" class="input-field" placeholder="Enter your email address...">
      </div>

      <div class="input-group">
        <label for="phone" class="label">Phone Number:</label>
        <input type="text" id="phone" name="phone" class="input-field" placeholder="Enter your phone number..." required>
      </div>
         <div class="input-group">
        <label for="phone" class="label">Password:</label>
        <input type="password" id="password" name="password" class="input-field" placeholder="Enter your Password..." required>
      </div>

      <div class="submit-container">
        <button type="submit" class="submit-btn">Register</button>
      </div>
    </form>
    <p class="login-link">Already have an account? <a href="index.php?action=login">Log in</a></p>
    <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
  </div>
</body>
</html>
