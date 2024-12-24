<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link rel="stylesheet" href="../css/login.css">

</head>
<body>
    <div class="login-container">
        <div class="text-center">
            <h1>Welcome Back!</h1>
            <p>Login to access your account</p>
        </div>
        <form method="POST" action="index.php?action=login">
            <div class="mb-4">
                <label for="email" class="block">Email/Username</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email or username"
                    required
                />
                <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                />
            </div>
            <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <button type="submit">Login</button>
        </form>
        <p class="forgot-password">
            Forgot your password? <a href="#">Click here</a>
                <p class="login-link">You don't have an account ? <a href="index.php?action=register">Register</a></p>

        </p>
    </div>
</body>
</html>
