<?php
require_once 'db.php';
require_once 'mail_notifications.php';

$form_message = '';
$form_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'strategic_ticket') {
    $full_name = trim($_POST['full_name'] ?? '');
    $whatsapp_number = trim($_POST['whatsapp_number'] ?? '');
    $email_address = trim($_POST['email_address'] ?? '');
    $selected_packs = $_POST['packs'] ?? [];
    if (!is_array($selected_packs)) {
        $selected_packs = [];
    }
    $packs = implode(', ', array_map('strval', $selected_packs));
    $objective = trim($_POST['objective'] ?? '');

    if ($full_name && $whatsapp_number && $email_address && $packs && $objective && filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (full_name, whatsapp_number, email_address, selected_packs, objective) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $whatsapp_number, $email_address, $packs, $objective])) {
                $form_status = 'success';
                $form_message = 'Thank you! Your strategic ticket has been successfully submitted. Our team will contact you shortly.';

                $subject = 'New Strategic Ticket Submission - ' . $full_name;
                sbci_send_admin_notification(
                    $subject,
                    'A new SBCI Global strategic ticket was received.',
                    [
                        'full_name' => $full_name,
                        'whatsapp_number' => $whatsapp_number,
                        'email_address' => $email_address,
                        'selected_packs' => $selected_packs,
                        'objective' => $objective,
                    ],
                    $email_address
                );

                sbci_send_client_confirmation($email_address, [
                    'brand' => 'SBCI Global',
                    'request_name' => 'strategic consulting ticket',
                    'subject' => 'SBCI Global - Strategic Ticket Received Successfully',
                    'confirmation' => 'Our expert division will review your request and contact you shortly via WhatsApp or email to arrange the next consultation step.',
                    'next_steps' => [
                        'Strategic ticket review',
                        'Direct WhatsApp or email follow-up',
                        'Consultation arrangement with our expert division',
                        'Recommended solution and package guidance',
                    ],
                    'referral' => 'Invite your network to connect with SBCI Global and explore structured business, digital, consulting, setup, and training solutions.',
                    'closing' => 'Thank you for choosing SBCI Global - Launch Smarter. Scale Faster.',
                    'signature' => [
                        'SBCI Global',
                        'Launch Smarter. Scale Faster.',
                    ],
                ]);

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
        $form_message = 'Please fill in all required fields and enter a valid email address.';
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
    <?php 
    $current_page = basename($_SERVER['PHP_SELF']);
    $is_home = ($current_page === 'index.php' || $current_page === '');
    $is_ai = (strpos($current_page, 'sbciai') !== false || strpos($current_page, 'registration') !== false);
    if ($is_ai): 
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sbci_ai.css">
    <?php endif; ?>
</head>
<body class="<?= $is_home ? 'home-page' : 'subpage' ?><?= $is_ai ? ' ai-page' : '' ?>">

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <div class="logo-area">
                <img src="assets/logo.png" alt="SBCI Shield Logo" style="width: 90px; margin-bottom: 5px;">
            </div>

            <!-- Hamburger for Mobile -->
            <button class="menu-toggle" id="mobile-menu" type="button" aria-label="Open navigation" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <nav class="nav-links">
                <a href="index.php" class="<?= $is_home ? 'active' : '' ?>">Home</a>
                <a href="digital-pack.php" class="<?= $current_page == 'digital-pack.php' ? 'active' : '' ?>">Digital Pack</a>
                <a href="consulting-pack.php" class="<?= $current_page == 'consulting-pack.php' ? 'active' : '' ?>">Consulting Pack</a>
                <a href="business-setup-pack.php" class="<?= $current_page == 'business-setup-pack.php' ? 'active' : '' ?>">Business Setup Pack</a>
                <a href="training-pack.php" class="<?= $current_page == 'training-pack.php' ? 'active' : '' ?>">Training Pack</a>
                <a href="sbciai.php" class="<?= $current_page == 'sbciai.php' ? 'active' : '' ?>">SBCI AI</a>
                <div class="dropdown">
                    <a href="sbciairegistration.php" class="dropbtn <?= strpos($current_page, 'registration') !== false ? 'active' : '' ?>" style="color: #c026d3;">Registration AI &#9660;</a>
                    <div class="dropdown-content">
                        <a href="sbciaistudentregistration.php">Student Portal</a>
                        <a href="sbciteacherregistration.php">Teacher Portal</a>
                        <a href="universityschoolregistration.php">School/Univ. Portal</a>
                        <a href="sbciaipartner.php">Partnership</a>
                    </div>
                </div>
                <a href="login.php" style="color: #ffd000; font-weight: 600;">Member Login</a>
                <a href="policy.php" class="<?= $current_page == 'policy.php' ? 'active' : '' ?>">Policy</a>
                <a href="join-us.php" class="search-icon <?= $current_page == 'join-us.php' ? 'active' : '' ?>">Join Us
                    <!-- Magnifying glass icon -->
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </a>
            </nav>
        </div>
    </header>
