<?php
session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $secret = $_POST['secret'] ?? '';

    // Hardcoded secret key to prevent unauthorized admin creation
    $admin_secret_key = 'SBCI_ADMIN_2026';

    if ($username && $password && $secret) {
        if ($secret !== $admin_secret_key) {
            $error = 'Invalid Registration Secret Key.';
        } else {
            // Check if username already exists
            $stmt = $pdo->prepare("SELECT id FROM members WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = 'Username already exists.';
            } else {
                // Insert new admin
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $role = 'admin';
                
                $stmt = $pdo->prepare("INSERT INTO members (username, password, role) VALUES (?, ?, ?)");
                if ($stmt->execute([$username, $hashed_password, $role])) {
                    $success = 'Admin account created successfully! You can now <a href="login.php" style="color:#2fb0ba; text-decoration:underline;">login</a>.';
                } else {
                    $error = 'Failed to create admin account. Please try again.';
                }
            }
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBCI Global - Admin Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #222426; /* Dark background */
            color: #fff;
            margin: 0;
            font-family: 'Public Sans', sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 100%;
            padding: 40px;
        }

        .login-left {
            flex: 1;
            padding-top: 20px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 80px;
        }
        
        .header-title-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Abstract logo svg placeholder */
        .mock-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #1f6b7a, #2fb0ba);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mock-logo svg {
            width: 30px;
            height: 30px;
            fill: #fff;
        }

        .login-title {
            color: #2fb0ba;
            font-size: 40px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .form-container {
            max-width: 450px;
            margin-left: 100px; /* Indent the form a bit like the mockup */
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .form-group label {
            width: 120px;
            font-size: 16px;
        }

        .form-group input {
            flex: 1;
            background-color: transparent;
            border: 1px solid #2fb0ba;
            padding: 10px 15px;
            color: #fff;
            font-size: 16px;
            font-family: inherit;
        }
        
        .form-group input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(47, 176, 186, 0.5);
        }

        .btn-container {
            margin-left: 120px; /* Align with input fields */
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 150px;
        }

        .btn-login {
            background-color: #2fb0ba;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
        }

        .error-message {
            color: #ff6b6b;
            margin-bottom: 20px;
            margin-left: 120px;
        }

        .success-message {
            color: #4cd137;
            margin-bottom: 20px;
            margin-left: 120px;
        }

        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .logo-display {
            border: 15px solid #2fb0ba;
            border-right: none;
            width: 100%;
            height: 80%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1e2022; /* Slightly different dark */
            box-shadow: -10px 10px 30px rgba(0,0,0,0.5);
        }

        .big-logo {
            text-align: center;
        }

        .big-logo img {
            max-width: 250px;
            margin-bottom: 15px;
        }

        .big-logo h2 {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 5px;
            margin: 0;
            text-transform: uppercase;
        }
        
        .big-logo p {
            font-size: 12px;
            color: #888;
            letter-spacing: 2px;
            margin-top: 5px;
            text-transform: uppercase;
        }

        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
            }
            .header-top {
                flex-direction: column;
                gap: 20px;
                margin-bottom: 40px;
            }
            .form-container, .btn-container {
                margin-left: 0;
            }
            .login-right {
                margin-top: 50px;
            }
            .logo-display {
                border-right: 15px solid #2fb0ba;
                height: 300px;
            }
            .form-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .form-group label {
                width: auto;
            }
            .form-group input {
                width: 100%;
                box-sizing: border-box;
            }
            .error-message, .success-message {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <!-- Left Side: Form -->
        <div class="login-left">
            <div class="header-top">
                <div class="header-title-container">
                    <div class="mock-logo">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4l6 14H6l6-14z"/></svg>
                    </div>
                    <h1 class="login-title">Admin Register</h1>
                </div>
            </div>

            <div class="form-container">
                <?php if ($error): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="success-message"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="secret">Secret Key:</label>
                        <input type="password" id="secret" name="secret" placeholder="Required for Admin Role" required>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn-login">Register</button>
                    </div>
                    <div style="margin-left: 120px; margin-top: 20px;">
                        <a href="login.php" style="color: #ccc; text-decoration: none; font-size: 14px;">&larr; Back to Login</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Logo Display -->
        <div class="login-right">
            <div class="logo-display">
                <div class="big-logo">
                    <img src="assets/logo.png" alt="SBCI Global Shield">
                    <h2>SBCI <span style="font-weight: 700;">GLOBAL</span></h2>
                    <p>AUTHORIZED BUSINESS PARTNER</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
