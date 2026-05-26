<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT id, password, role FROM members WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['member_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            if ($user['role'] === 'admin') {
                header("Location: list_users.php");
            } else {
                header("Location: profile.php");
            }
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Please fill in all fields';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBCI Global - Member Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary: #2fb0ba;
            --primary-hover: #1f8a92;
            --bg-dark: #0f1115;
            --card-bg: rgba(22, 26, 32, 0.7);
            --border: rgba(255, 255, 255, 0.1);
            --text: #ffffff;
            --text-muted: #9ca3af;
        }

        body {
            margin: 0;
            font-family: 'Public Sans', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Abstract Animated Background */
        .bg-fx {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -2;
            overflow: hidden;
            background: radial-gradient(circle at top right, rgba(47, 176, 186, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at bottom left, rgba(20, 100, 110, 0.2) 0%, transparent 50%);
        }

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
            animation: float-orb 15s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: rgba(47, 176, 186, 0.2);
            top: -150px;
            left: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: rgba(15, 90, 105, 0.25);
            bottom: -100px;
            right: -100px;
            animation-delay: -5s;
        }

        @keyframes float-orb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(100px, 50px) scale(1.1); }
            100% { transform: translate(-50px, 100px) scale(0.9); }
        }

        /* Layout Container */
        .login-wrapper {
            width: 100%;
            max-width: 1100px;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        .back-nav {
            position: absolute;
            top: 40px;
            left: 50px;
            z-index: 20;
        }

        .back-link {
            color: var(--text-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid transparent;
        }

        .back-link:hover {
            color: var(--text);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.1);
            transform: translateX(-3px);
        }

        .login-card {
            display: flex;
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255,255,255,0.1);
            min-height: 650px;
        }

        /* Left Side: Form Area */
        .login-form-area {
            flex: 1;
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 50px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), #125e65);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(47, 176, 186, 0.3);
        }

        .brand-icon svg {
            width: 26px;
            height: 26px;
            fill: #fff;
        }

        .title-group h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
            color: #fff;
        }

        .title-group p {
            color: var(--text-muted);
            margin: 4px 0 0 0;
            font-size: 14px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            color: #fca5a5;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #6b7280;
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 16px 16px 46px;
            color: #fff;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control::placeholder {
            color: #4b5563;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 0 4px rgba(47, 176, 186, 0.15);
        }

        .form-control:focus + svg {
            color: var(--primary);
        }

        .form-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 40px;
            gap: 20px;
        }

        .btn-submit {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), #1a7b83);
            color: #fff;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(47, 176, 186, 0.4);
        }

        .btn-submit:hover::after {
            opacity: 1;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-forgot {
            background: transparent;
            color: var(--text-muted);
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.3s;
            padding: 10px;
        }

        .btn-forgot:hover {
            color: var(--text);
            text-decoration: underline;
        }

        /* Right Side: Branding Overlay */
        .login-visual-area {
            flex: 1.2;
            background: url('assets/hero_bg.png') center/cover no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            text-align: center;
            border-left: 1px solid rgba(255,255,255,0.05);
        }

        .visual-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(15, 20, 25, 0.85), rgba(10, 45, 52, 0.75));
            border-radius: 0 24px 24px 0;
        }

        .visual-content {
            position: relative;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .visual-logo {
            width: 140px;
            margin-bottom: 30px;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.5));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .visual-title {
            font-size: 38px;
            font-weight: 300;
            letter-spacing: 8px;
            margin: 0;
            color: #fff;
        }
        
        .visual-title span {
            font-weight: 700;
        }

        .visual-subtitle {
            font-size: 13px;
            color: var(--primary);
            letter-spacing: 4px;
            margin-top: 15px;
            text-transform: uppercase;
            font-weight: 600;
            background: rgba(47, 176, 186, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid rgba(47, 176, 186, 0.2);
        }

        /* Highly Responsive Mobile Approach */
        @media (max-width: 900px) {
            body {
                align-items: flex-start;
                padding-top: 70px;
                padding-bottom: 40px;
                box-sizing: border-box;
            }

            .back-nav {
                top: 20px;
                left: 20px;
            }

            .login-wrapper {
                padding: 15px;
                margin-top: 0; 
            }

            .login-card {
                flex-direction: column-reverse;
                min-height: auto;
                border-radius: 20px;
            }

            .visual-overlay {
                border-radius: 20px 20px 0 0;
            }

            .login-visual-area {
                flex: none;
                padding: 40px 20px;
                border-left: none;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .visual-logo {
                width: 90px;
                margin-bottom: 20px;
            }

            .visual-title {
                font-size: 26px;
                letter-spacing: 4px;
            }

            .visual-subtitle {
                font-size: 11px;
                padding: 6px 12px;
            }

            .login-form-area {
                padding: 40px 25px;
            }

            .brand-header {
                justify-content: center;
                margin-bottom: 35px;
            }

            .form-action-bar {
                flex-direction: column;
                gap: 15px;
            }

            .btn-submit {
                width: 100%;
                order: 1;
            }

            .btn-forgot {
                order: 2;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .login-wrapper {
                padding: 10px;
            }
            .login-form-area {
                padding: 30px 20px;
            }
            .title-group h1 {
                font-size: 24px;
            }
            .brand-icon {
                width: 40px;
                height: 40px;
            }
            .brand-icon svg {
                width: 20px;
                height: 20px;
            }
            .form-control {
                padding: 14px 14px 14px 40px;
                font-size: 16px; /* Prevents iOS zoom */
            }
            .input-wrapper svg {
                left: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="bg-fx">
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
    </div>

    <!-- Move back link absolute outside card for better spacing on mobile -->
    <div class="back-nav">
        <a href="index.php" class="back-link">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Home
        </a>
    </div>

    <div class="login-wrapper">
        <div class="login-card">
            
            <!-- Left Side: Form -->
            <div class="login-form-area">
                <div class="brand-header">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4l6 14H6l6-14z"/></svg>
                    </div>
                    <div class="title-group">
                        <h1>Welcome Back</h1>
                        <p>Sign in to your member dashboard</p>
                    </div>
                </div>

                <?php if ($error): ?>
                    <div class="alert-error">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                    </div>

                    <div class="form-action-bar">
                        <button type="submit" class="btn-submit">
                            Secure Login
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                        <button type="button" class="btn-forgot" onclick="alert('Please contact support to reset your password.')">Forgot Password?</button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Branding -->
            <div class="login-visual-area">
                <div class="visual-overlay"></div>
                <div class="visual-content">
                    <img src="assets/logo.png" alt="SBCI Global Shield" class="visual-logo">
                    <h2 class="visual-title">SBCI <span>GLOBAL</span></h2>
                    <p class="visual-subtitle">Authorized Business Partner</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
