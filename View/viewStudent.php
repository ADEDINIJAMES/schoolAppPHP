<meta charSet="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>View Students</title>
<link rel="stylesheet" href="../css/view.css" />

<div class="container">
    <div class="back-btn-container">
        <a href="index.php?action=dashboard" class="back-btn">← Back to Dashboard</a>
    </div>
    <h1>Registered Students</h1>

    <!-- Search Form -->
    <form method="GET" action="index.php?action=viewStudents" class="search-form">
        <input type="text" name="search" placeholder="Search by name, email..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
        <button type="submit">Search</button>
    </form>

    <!-- Student Table -->
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
                <th colSpan="2">ACTION</th>
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
                    <td><?php echo htmlspecialchars($student['created_at'] ?? 'N/A'); ?></td>
                    <td><a href="index.php?action=update&id=<?php echo $student['id']; ?>"><button>Update</button></a></td>
                    <td><a href="index.php?action=deleteStudent&id=<?php echo $student['id']; ?>" onClick="return confirm('Are you sure you want to delete this student?');"><button>Delete</button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
