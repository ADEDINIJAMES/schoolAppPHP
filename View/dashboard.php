<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="index.php?action=dashboard">Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
    
    <div class="content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Guest'); ?></h1>
        <p>Email: <?= htmlspecialchars($_SESSION['user']['email'] ?? 'N/A'); ?></p>
        <p>Phone: <?= htmlspecialchars($_SESSION['user']['phone'] ?? 'N/A'); ?></p>

        <?php if (isset($_SESSION['user']['is_Admin']) && $_SESSION['user']['is_Admin'] === 1): ?>
            <div class="admin-section">
                <h2>Admin Operations</h2>
                <ul>
                    <li><a href="index.php?action=registerStudent">Register a New Student</a></li>
                    <li><a href="index.php?action=viewStudents">View All Students</a></li>
                    <li> <a href ="index.php?action=addquestion"> Add question </a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
