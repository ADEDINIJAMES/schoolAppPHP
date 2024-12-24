

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="../css/view.css">
</head>
<body>
    <?php if (isset($_SESSION['user']['is_Admin']) && $_SESSION['user']['is_Admin'] === 1): ?>

    <div class="container">
        <div class="back-btn-container">
        <a href="index.php?action=dashboard" class="back-btn">← Back to Dashboard</a>
    </div>
        <h1>Registered Students</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Class</th>
                    <th>Age</th>
                    <th>Parent Name</th>
                    <th>Parent Phone</th>
                            
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                         <td><?php echo htmlspecialchars($student['class']); ?></td>
                        <td><?php echo htmlspecialchars($student['age']); ?></td>
                         <td><?php echo htmlspecialchars($student['parent_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['parent_phone']); ?></td>
                        <td><?php echo htmlspecialchars($student['created_At']?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <?php endif; ?>

</body>
</html>
