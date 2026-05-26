<?php
session_start();
require_once 'db.php';

// Check if user is logged in AND is an admin
if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch only users created by this admin
$stmt = $pdo->prepare("SELECT id, username, name, email, phone, membership, role FROM members WHERE created_by = ? ORDER BY id DESC");
$stmt->execute([$_SESSION['member_id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBCI Global - User List</title>
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
            max-width: 1100px;
            width: 100%;
            min-width: 0;
            display: flex;
            gap: 40px;
        }

        .form-panel {
            flex: 1;
            min-width: 0;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .panel-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--primary), #1a7b83);
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(47, 176, 186, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(47, 176, 186, 0.4);
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th {
            text-align: left;
            padding: 15px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        table td {
            padding: 15px;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            vertical-align: middle;
        }

        table tbody tr:hover {
            background: rgba(47, 176, 186, 0.05);
        }

        .role-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-admin { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }
        .role-client { background: rgba(47, 176, 186, 0.15); color: #5eead4; }

        .btn-action {
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .btn-action:hover {
            color: #fff;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
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
            .main-content { margin-left: 0; padding: 80px 15px 40px; width: 100%; max-width: 100vw; overflow-x: hidden; }
            .form-panel { padding: 25px 15px; }
            .panel-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 260px; }
            table th, table td { padding: 10px; font-size: 13px; }
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
                    <h2>Member Directory</h2>
                    <a href="create_user.php" class="btn-add">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        New User
                    </a>
                </div>

                <?php if (empty($users)): ?>
                    <div class="empty-state">
                        <p>No members found in the system.</p>
                    </div>
                <?php else: ?>
                    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin: 0 -15px; padding: 0 15px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $u): ?>
                                    <tr onclick="window.location='profile.php?id=<?php echo $u['id']; ?>'" style="cursor: pointer;" title="Click to view details">
                                        <td>#<?php echo $u['id']; ?></td>
                                        <td style="font-weight: 500;"><?php echo htmlspecialchars($u['username']); ?></td>
                                        <td><?php echo htmlspecialchars($u['name'] ?: '-'); ?></td>
                                        <td>
                                            <span class="role-badge <?php echo $u['role'] === 'admin' ? 'role-admin' : 'role-client'; ?>">
                                                <?php echo htmlspecialchars($u['role']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($u['email'] ?: '-'); ?></td>
                                        <td><?php echo htmlspecialchars($u['phone'] ?: '-'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div class="notes-panel">
                <div class="status-badge">
                    &#9881; Admin Mode Active
                </div>
            </div>
        </div>
    </div>

</body>
</html>
