<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add a New Question</h1>
    <form id="add-question-form" method="POST" action="index.php?action=addquestion">
        <label>Question: <input type="text" name="question" required></label>
        <label>Option 1: <input type="text" name="option1" required></label>
        <label>Option 2: <input type="text" name="option2" required></label>
        <label>Option 3: <input type="text" name="option3" required></label>
        <label>Option 4: <input type="text" name="option4" required></label>
        <label>Correct Option: <select name="correct_option">
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
        </select></label>
        <button type="submit">Submit</button>
    </form>
    <!-- <script src="jquery.min.js"></script>
    <script src="script.js"></script> -->
</body>
</html>
