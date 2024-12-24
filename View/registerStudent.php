<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
  <div class="container">
    <p class="heading">REGISTER Student</p>
    
    <div class="back-btn-container">
        <a href="index.php?action=dashboard" class="back-btn">← Back to Dashboard</a>
    </div>

    <?php if (isset($_SESSION['user']['is_Admin']) && $_SESSION['user']['is_Admin'] === 1): ?>
    <form method="POST" action="index.php?action=registerStudent" class="register-form">
        <div class="input-group">
            <label for="name" class="label">Name:</label>
            <input type="text" id="name" name="name" class="input-field" placeholder="Enter student's name..." required>
        </div>

        <div class="input-group">
            <label for="email" class="label">Email:</label>
            <input type="email" id="email" name="email" class="input-field" placeholder="Enter student's email address...">
        </div>

        <div class="input-group">
            <label for="phone" class="label">Phone Number:</label>
            <input type="text" id="phone" name="phone" class="input-field" placeholder="Enter student's phone number..." required>
        </div>

        <div class="input-group">
            <label for="age" class="label">Age:</label>
            <input type="number" id="age" name="age" class="input-field" placeholder="Enter student's Age..." required min="0">
        </div>

        <div class="input-group">
            <label for="class" class="label">Class:</label>
            <input type="text" id="class" name="class" class="input-field" placeholder="Enter student's class..." required>
        </div>

        <div class="input-group">
            <label for="parent_name" class="label">Parent Name:</label>
            <input type="text" id="parent_name" name="parent_name" class="input-field" placeholder="Enter parent's name..." required>
        </div>

        <div class="input-group">
            <label for="parent_phone" class="label">Parent Phone:</label>
            <input type="text" id="parent_phone" name="parent_phone" class="input-field" placeholder="Enter parent's phone..." required>
        </div>

        <div class="submit-container">
            <button type="submit" class="submit-btn">Register</button>
        </div>
    </form>
    <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
    <?php endif; ?>
  </div>
</body>
</html>
