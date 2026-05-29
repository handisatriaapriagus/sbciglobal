<?php
require_once 'db.php';

$form_message = '';
$form_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $whatsapp_number = trim($_POST['whatsapp_number'] ?? '');
    $email_address = trim($_POST['email_address'] ?? '');
    $packs = isset($_POST['packs']) ? implode(', ', $_POST['packs']) : '';
    $objective = trim($_POST['objective'] ?? '');

    if ($full_name && $whatsapp_number && $email_address) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (full_name, whatsapp_number, email_address, selected_packs, objective) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $whatsapp_number, $email_address, $packs, $objective])) {
                $form_status = 'success';
                $form_message = 'Thank you! Your strategic ticket has been successfully submitted. Our team will contact you shortly.';

                // Send email notification handling
                $to = 'info@sbciglobal.com';
                $subject = 'New Strategic Ticket Submission - ' . $full_name;
                $message = "You have received a new strategic ticket submission.\n\n" .
                           "Details:\n" .
                           "Name: $full_name\n" .
                           "WhatsApp: $whatsapp_number\n" .
                           "Email: $email_address\n" .
                           "Packs Selected: $packs\n" .
                           "Objective:\n$objective\n";
                $headers = "From: noreply@sbciglobal.com\r\n" .
                           "Reply-To: $email_address\r\n" .
                           "X-Mailer: PHP/" . phpversion();

                @mail($to, $subject, $message, $headers); // Supress errors from mail function in case server is not configured

            } else {
                $form_status = 'error';
                $form_message = 'Something went wrong while submitting your ticket. Please try again.';
            }
        } catch (PDOException $e) {
            $form_status = 'error';
            $form_message = 'Failed to submit the form due to a database error.';
        }
    } else {
        $form_status = 'error';
        $form_message = 'Please fill in all required fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
require_once 'db.php';

$form_message = '';
$form_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $whatsapp_number = trim($_POST['whatsapp_number'] ?? '');
    $email_address = trim($_POST['email_address'] ?? '');
    $packs = isset($_POST['packs']) ? implode(', ', $_POST['packs']) : '';
    $objective = trim($_POST['objective'] ?? '');

    if ($full_name && $whatsapp_number && $email_address) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (full_name, whatsapp_number, email_address, selected_packs, objective) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $whatsapp_number, $email_address, $packs, $objective])) {
                $form_status = 'success';
                $form_message = 'Thank you! Your strategic ticket has been successfully submitted. Our team will contact you shortly.';

                // Send email notification handling
                $to = 'info@sbciglobal.com';
                $subject = 'New Strategic Ticket Submission - ' . $full_name;
                $message = "You have received a new strategic ticket submission.\n\n" .
                           "Details:\n" .
                           "Name: $full_name\n" .
                           "WhatsApp: $whatsapp_number\n" .
                           "Email: $email_address\n" .
                           "Packs Selected: $packs\n" .
                           "Objective:\n$objective\n";
                $headers = "From: noreply@sbciglobal.com\r\n" .
                           "Reply-To: $email_address\r\n" .
                           "X-Mailer: PHP/" . phpversion();

                @mail($to, $subject, $message, $headers); // Supress errors from mail function in case server is not configured

            } else {
                $form_status = 'error';
                $form_message = 'Something went wrong while submitting your ticket. Please try again.';
            }
        } catch (PDOException $e) {
            $form_status = 'error';
            $form_message = 'Failed to submit the form due to a database error.';
        }
    } else {
        $form_status = 'error';
        $form_message = 'Please fill in all required fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBCI Global | Launch Smarter Scale Faster</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
$is_home = ($current_page === 'index.php' || $current_page === '');
?>
<body class="<?= $is_home ? 'home-page' : 'subpage' ?>">

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <div class="logo-area">
                <img src="assets/logo.png" alt="SBCI Shield Logo" style="width: 90px; margin-bottom: 5px;">
            </div>

            <!-- Hamburger for Mobile -->
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <nav class="nav-links">
                <a href="index.php" class="<?= $is_home ? 'active' : '' ?>">Home</a>
                <a href="sbciai.php">SBCI AI</a>
                <a href="digital-pack.php" class="<?= $current_page == 'digital-pack.php' ? 'active' : '' ?>">Digital Pack</a>
                <a href="consulting-pack.php" class="<?= $current_page == 'consulting-pack.php' ? 'active' : '' ?>">Consulting Pack</a>
                <a href="business-setup-pack.php" class="<?= $current_page == 'business-setup-pack.php' ? 'active' : '' ?>">Business Setup Pack</a>
                <a href="training-pack.php" class="<?= $current_page == 'training-pack.php' ? 'active' : '' ?>">Training Pack</a>
                <a href="login.php" style="color: #ffd000; font-weight: 600;">Member Login</a>
                <a href="policy.php" class="<?= $current_page == 'policy.php' ? 'active' : '' ?>">Policy</a>
                <a href="join-us.php" class="search-icon <?= $current_page == 'join-us.php' ? 'active' : '' ?>">Join Us
                    <!-- Magnifying glass icon -->
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </a>
            </nav>
        </div>
    </header>
