<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collabstr - Brand Deal Opportunity</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8f9fa; }
        .navbar { background: white; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 22px; font-weight: 800; color: #6C63FF; }
        .logo span { color: #333; }
        .hero { padding: 40px 20px; text-align: center; }
        .offer-badge { display: inline-block; background: #e8f5e9; color: #2e7d32; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 20px; }
        .hero h1 { font-size: 32px; color: #1a1a2e; margin-bottom: 16px; }
        .hero h1 span { color: #6C63FF; }
        .hero p { font-size: 16px; color: #666; margin-bottom: 30px; }
        .cta-button { display: inline-block; background: linear-gradient(135deg, #6C63FF, #8B5CF6); color: white; padding: 16px 40px; border-radius: 50px; font-size: 18px; font-weight: 600; text-decoration: none; }
        .price-card { background: linear-gradient(135deg, #6C63FF, #8B5CF6); color: white; padding: 30px; border-radius: 20px; margin: 30px 20px; }
        .price-card .price { font-size: 42px; font-weight: 800; }
        .price-card .sub { opacity: 0.9; margin: 10px 0; }
        .price-card .details div { display: flex; justify-content: space-between; margin: 8px 0; }
        .trust-bar { background: white; padding: 16px; margin-top: 20px; }
        .trust-bar span { color: #999; font-size: 13px; margin: 0 10px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Collab<span>str</span></div>
    </nav>

    <div class="hero">
        <div class="offer-badge">🎯 Exclusive Brand Deal</div>
        <h1>You've been <span>pre-selected</span> for a campaign</h1>
        <p>A major lifestyle brand loved your content and wants to collaborate. Review the full campaign brief and claim your payout.</p>
        
        <div class="price-card">
            <h2>Campaign Payout</h2>
            <div class="price">$2,500</div>
            <div class="sub">Estimated earnings</div>
            <div class="details">
                <div><span>📱 Instagram Post</span><span>$1,000</span></div>
                <div><span>🎬 TikTok Video</span><span>$800</span></div>
                <div><span>📸 Story Mention</span><span>$700</span></div>
            </div>
        </div>

        <a href="login.php" class="cta-button">Sign in with Google →</a>
    </div>

    <div class="trust-bar">
        <span>⭐ 4.9/5 from 12,000+ creators</span>
        <span>🔒 256-bit encrypted</span>
        <span>✅ Trusted by 500+ brands</span>
    </div>
</body>
</html>
