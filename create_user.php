<?php
session_start();
require_once 'db.php';

// Check if user is logged in AND is an admin
if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate required fields
    if (empty($username) || empty($password)) {
        $error = "Username and Password are required.";
    } else {
        // Check if username already exists
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM members WHERE username = ?");
        $stmtCheck->execute([$username]);
        if ($stmtCheck->fetchColumn() > 0) {
            $error = "Username already exists. Please choose another one.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'client'; // Default new users to client role
            
            // Profile fields
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $domain = trim($_POST['domain'] ?? '');
            $membership = trim($_POST['membership'] ?? '');
            $instagram = trim($_POST['instagram'] ?? '');
            $linkedin = trim($_POST['linkedin'] ?? '');
            $tiktok = trim($_POST['tiktok'] ?? '');
            $facebook = trim($_POST['facebook'] ?? '');
            $credit_score = trim($_POST['credit_score'] ?? '');
            $wallet_cashback = trim($_POST['wallet_cashback'] ?? '');
            $others = trim($_POST['others'] ?? '');
            
            // Insert new member
            $sql = "INSERT INTO members (username, password, role, name, email, phone, domain, membership, instagram, linkedin, tiktok, facebook, credit_score, wallet_cashback, others, created_by) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($sql);
            
            try {
                $pdo->beginTransaction();
                
                $insertStmt->execute([
                    $username, $hashed_password, $role, $name, $email, $phone, $domain, 
                    $membership, $instagram, $linkedin, $tiktok, $facebook, $credit_score, $wallet_cashback, $others, $_SESSION['member_id']
                ]);
                
                $new_member_id = $pdo->lastInsertId();
                
                // Initialize 6 empty attachment slots for the new member
                $attachStmt = $pdo->prepare("INSERT INTO member_attachments (member_id, attachment_number, display_name) VALUES (?, ?, ?)");
                for ($i = 1; $i <= 6; $i++) {
                    $attachStmt->execute([$new_member_id, $i, "Upload $i"]);
                }
                
                $pdo->commit();
                $message = "User '$username' created successfully!";
                
                // Clear post variables after success so the form resets
                $_POST = array();
                
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = "Failed to create user: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBCI Global - Create User</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2fb0ba;
            --primary-hover: #1f8a92;
            --bg-dark: #0f1115;
            --card-bg: rgba(22, 26, 32, 0.65);
            --border: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --text-muted: #9ca3af;
            --sidebar-width: 260px;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text);
            margin: 0;
            font-family: 'Public Sans', sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Abstract Animated Background */
        .bg-fx {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -2;
            overflow: hidden;
            background: radial-gradient(circle at top right, rgba(47, 176, 186, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at bottom left, rgba(20, 100, 110, 0.15) 0%, transparent 50%);
        }

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.5;
            animation: float-orb 15s ease-in-out infinite alternate;
        }

        .orb-1 { width: 400px; height: 400px; background: rgba(47, 176, 186, 0.2); top: -100px; left: -100px; }
        .orb-2 { width: 300px; height: 300px; background: rgba(15, 90, 105, 0.2); bottom: -100px; right: -50px; animation-delay: -5s; }

        @keyframes float-orb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.1); }
            100% { transform: translate(-40px, 60px) scale(0.9); }
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(15, 20, 25, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid var(--border);
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            box-sizing: border-box;
            position: fixed;
            height: 100vh;
            z-index: 50;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .brand-logo svg {
            width: 32px; height: 32px; fill: var(--primary);
        }

        .brand-logo span {
            font-size: 20px; font-weight: 700; color: #fff; letter-spacing: 1px;
        }

        .sidebar a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, rgba(47, 176, 186, 0.2), rgba(47, 176, 186, 0.05));
            color: var(--primary);
            border: 1px solid rgba(47, 176, 186, 0.3);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .sidebar a.sub-menu {
            font-size: 13px;
            margin-top: -5px;
            padding-left: 44px;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 50px;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .content-wrapper {
            max-width: 900px;
            width: 100%;
            display: flex;
            gap: 40px;
        }

        .form-panel {
            flex: 1;
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.5);
        }

        .panel-header {
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
        }
        
        .panel-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .success-msg {
            background: rgba(16, 185, 129, 0.1);
            border-left: 3px solid #10b981;
            color: #a7f3d0;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 500;
        }

        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            color: #fca5a5;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 5px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 12px 16px;
            color: #fff;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 0 3px rgba(47, 176, 186, 0.15);
        }

        .section-divider {
            grid-column: span 2;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin: 15px 0 10px;
            padding-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), #1a7b83);
            color: #fff;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 30px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(47, 176, 186, 0.3);
            grid-column: span 2;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(47, 176, 186, 0.4);
        }

        /* Notes Panel */
        .notes-panel {
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .status-admin {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Mobile Adjustments */
        .mobile-nav-toggle {
            display: none;
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 100;
            background: var(--card-bg);
            border: 1px solid var(--border);
            backdrop-filter: blur(10px);
            padding: 10px;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 40;
        }

        @media (max-width: 1024px) {
            .content-wrapper { flex-direction: column; gap: 20px; }
            .notes-panel { width: 100%; flex-direction: row; justify-content: flex-start; }
        }

        @media (max-width: 768px) {
            .mobile-nav-toggle { display: block; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 280px;
            }
            .sidebar.active { transform: translateX(0); }
            .sidebar.active + .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; padding: 80px 20px 40px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full-width { grid-column: span 1; }
            .section-divider { grid-column: span 1; }
            .btn-save { grid-column: span 1; }
            .form-panel { padding: 30px 20px; }
        }

        @media (max-width: 480px) {
            .form-control { font-size: 16px; } /* Prevent iOS zoom */
            .sidebar { width: 260px; }
        }
    </style>
</head>
<body>

    <div class="bg-fx">
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
    </div>

    <!-- Mobile Nav Toggle -->
    <div class="mobile-nav-toggle" onclick="document.querySelector('.sidebar').classList.toggle('active')">
        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </div>

    <div class="sidebar">
        <div class="brand-logo">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4l6 14H6l6-14z"/></svg>
            <span>SBCI APP</span>
        </div>
        
        <?php if ($_SESSION['role'] !== 'admin'): ?>
            <a href="profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                My Profile
            </a>
            <a href="attachments.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'attachments.php' ? 'active' : ''; ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                Attachments
            </a>
        <?php else: ?>
            <a href="list_users.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'list_users.php' ? 'active' : ''; ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                User List
            </a>
            <a href="create_user.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'create_user.php' ? 'active' : ''; ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Create User
            </a>
            <a href="create_admin.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'create_admin.php' ? 'active' : ''; ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Create Admin
            </a>
        <?php endif; ?>
        
        <div class="sidebar-bottom">
            <a href="logout.php">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                Sign Out
            </a>
        </div>
    </div>
    <div class="sidebar-overlay" onclick="document.querySelector('.sidebar').classList.remove('active')"></div>

    <div class="main-content">
        <div class="content-wrapper">
            <div class="form-panel">
                <div class="panel-header">
                    <h2>Register New Member</h2>
                </div>
                
                <?php if ($message): ?>
                    <div class="success-msg"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-grid">
                        <div class="section-divider">Login Credentials</div>
                        
                        <div class="form-group">
                            <label>Username (Login ID) *</label>
                            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <div class="section-divider">Profile Data</div>
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Domain</label>
                            <input type="text" name="domain" class="form-control" value="<?php echo htmlspecialchars($_POST['domain'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Membership</label>
                            <input type="text" name="membership" class="form-control" value="<?php echo htmlspecialchars($_POST['membership'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="<?php echo htmlspecialchars($_POST['instagram'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" name="linkedin" class="form-control" value="<?php echo htmlspecialchars($_POST['linkedin'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Tiktok</label>
                            <input type="text" name="tiktok" class="form-control" value="<?php echo htmlspecialchars($_POST['tiktok'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="<?php echo htmlspecialchars($_POST['facebook'] ?? ''); ?>">
                        </div>

                        <div class="section-divider">Financial Info <span style="font-size: 11px; color: var(--primary); text-transform: none; margin-left: 5px;">(Admin Only)</span></div>

                        <div class="form-group">
                            <label>Credit Score</label>
                            <input type="text" name="credit_score" class="form-control" value="<?php echo htmlspecialchars($_POST['credit_score'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Wallet Cashback</label>
                            <input type="text" name="wallet_cashback" class="form-control" value="<?php echo htmlspecialchars($_POST['wallet_cashback'] ?? ''); ?>">
                        </div>
                        <div class="form-group full-width">
                            <label>Others</label>
                            <input type="text" name="others" class="form-control" value="<?php echo htmlspecialchars($_POST['others'] ?? ''); ?>">
                        </div>

                        <button type="submit" class="btn-save">Create User Profile</button>
                    </div>
                </form>
            </div>

            <div class="notes-panel">
                <div class="status-badge status-admin">
                    &#9881; Admin Mode Active
                </div>
            </div>
        </div>
    </div>

</body>
</html>
