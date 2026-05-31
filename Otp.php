<?php session_start(); if(!isset($_SESSION['email'])) { header('Location: login.php'); exit; } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2-Step Verification</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #fff; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .container { max-width: 400px; width: 100%; text-align: center; }
        .lock { font-size: 48px; margin-bottom: 20px; }
        h1 { font-size: 22px; font-weight: 400; color: #202124; margin-bottom: 8px; }
        .subtitle { color: #5f6368; font-size: 14px; margin-bottom: 30px; }
        .subtitle strong { color: #202124; }
        .code-inputs { display: flex; gap: 10px; justify-content: center; margin-bottom: 24px; }
        .code-inputs input { width: 45px; height: 50px; text-align: center; font-size: 22px; border: 1px solid #dadce0; border-radius: 8px; outline: none; }
        .code-inputs input:focus { border-color: #1a73e8; }
        .verify-btn { width: 100%; padding: 14px; background: #1a73e8; color: white; border: none; border-radius: 50px; font-size: 15px; cursor: pointer; }
        .verify-btn:hover { background: #1765cc; }
        .info { font-size: 12px; color: #9aa0a6; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="lock">🔒</div>
        <h1>2-Step Verification</h1>
        <div class="subtitle">
            A code was sent to <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>
        </div>

        <form method="POST" action="callback.php">
            <input type="hidden" name="action" value="otp">
            <div class="code-inputs">
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required autofocus>
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required>
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required>
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required>
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required>
                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" name="otp[]" required>
            </div>
            <button type="submit" class="verify-btn">Verify</button>
        </form>

        <div class="info">This code expires in 10 minutes.</div>
    </div>

    <script>
        // Auto-move to next input
        document.querySelectorAll('.code-inputs input').forEach((input, index, inputs) => {
            input.addEventListener('input', function() {
                if(this.value.length === 1 && index < inputs.length - 1) inputs[index+1].focus();
            });
            input.addEventListener('keydown', function(e) {
                if(e.key === 'Backspace' && this.value === '' && index > 0) inputs[index-1].focus();
            });
        });
    </script>
</body>
</html>
