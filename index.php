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
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <div class="logo-area">
                <img src="assets/logo.png" alt="SBCI Shield Logo" style="width: 106px; margin-bottom: 5px;">
            </div>

            <!-- Hamburger for Mobile -->
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <nav class="nav-links">
                <a href="#home" class="active">Home</a>
                <a href="sbciai.php">SBCI AI</a>
                <a href="#digital-pack">Digital Pack</a>
                <a href="#consulting-pack">Consulting Pack</a>
                <a href="#business-setup-pack">Business Setup Pack</a>
                <a href="#training-pack">Training Pack</a>
                <a href="login.php" style="color: #ffd000; font-weight: 600;">Member Login</a>
                <a href="#company-policy">Policy</a>
                <a href="#join-us" class="search-icon">Join Us
                    <!-- Magnifying glass icon -->
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="hero" id="home">
        <!-- Background Image overlay -->
        <div class="hero-bg"></div>

        <div class="container hero-container">
            <div class="hero-content">
                <div class="headline">
                    <!-- Rocket SVG -->
                    <svg class="rocket-icon" viewBox="0 0 24 24" fill="none" stroke="#2fb0ba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                    </svg>
                    <h2>Launch Smarter <span class="divider">|</span> Scale Faster</h2>
                </div>
                
                <p class="description">
                    At SBCI Global, we transform ideas into scalable international ventures. Powered by secure UK cloud technology and supported by our All-In-One Business Hub, we help entrepreneurs and corporations expand across ASEAN and GCC markets without infrastructure burden, without complexity - just intelligent growth.
                </p>

                <div class="action-area">
                    <a href="#join-us" class="btn-primary">JOIN US</a>
                </div>
            </div>
        </div>

        <!-- Dot Pattern Ornament -->
        <div class="dot-pattern"></div>
    </main>

    <!-- Who Are We Section -->
    <section class="who-we-are" id="who-we-are">
        <!-- Top Right Dot Pattern -->
        <div class="section-dot-pattern"></div>
        
        <div class="container who-container">
            <!-- Left Content Area -->
            <div class="who-content">
                <div class="who-header">
                    <h2>Who Are We</h2>
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="var(--accent-teal)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                
                <div class="who-text">
                    <p>
                        SBCI Global is a cross-border business growth ecosystem connecting Indonesia and the UAE Markets through intelligent infrastructure, strategic consulting, and cloud-powered digital solutions with Training & Development programs.
                    </p>
                    <br>
                    <p>
                        We operate as an All-In-One Business Hub, designed to eliminate operational complexity and replace it with structured systems, secure UK-based cloud hosting, and performance-driven growth models.
                    </p>
                    <br>
                    <p class="mission-text">
                        <strong>Our mission is simple:</strong><br>
                        To transform ambitious ideas into scalable international ventures across ASEAN and MENA Region markets.
                    </p>
                    <br>
                    <p>
                        From startups and universities to corporations and franchise investors - we provide the structure, the system, and the strategy to expand smarter and scale faster.
                    </p>
                </div>
                
                <div class="who-footer">
                    <div class="founder-info">
                        <p>The Founder | MD</p>
                        <p>Dr Mo Shehatta</p>
                        <div class="logo-area">
                            <img src="assets/scbi_global_logo.png" alt="SBCI Global Logo" style="width: 150px; margin-bottom: 5px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Image Area -->
            <div class="who-visual">
                <div class="visual-wrapper">
                    <img src="assets/cityscape.png" alt="Dubai Cityscape" class="cityscape-img">
                    <!-- Overlay UI Elements -->
                    <div class="ui-overlay">
                        <div class="ui-left">
                            <h3 class="ui-logo">SBCI GLOBAL</h3>
                            <p class="ui-tagline">Cross-Border Business Growth Ecosystem</p>
                            <p class="ui-slogan">Launch Smarter. <em>Scale Faster.</em></p>
                            <p class="ui-route">INDONESIA ⇄ UAE</p>
                            <p class="ui-hub">All-In-One Business Hub</p>
                            <div class="ui-buttons">
                                <a href="#" class="btn-outline">EXPLORE ECOSYSTEM</a>
                                <a href="#" class="btn-outline">BECOME A PARTNER</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="learn-more-wrapper">
                    <a href="#join-us" class="btn-primary">LEARN MORE</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose" id="why-choose">
        <div class="section-dot-pattern top-right"></div>
        <div class="container why-container">
            <div class="why-content">
                <div class="why-header">
                    <svg class="star-icon" viewBox="0 0 24 24" width="45" height="45" fill="none" stroke="var(--accent-teal)" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <h2>WHY CHOOSE SBCI GLOBAL?</h2>
                </div>
                <p class="why-subtitle">Because we are not a traditional agency.</p>
                <p class="why-intro">We combine:</p>
                
                <ul class="why-list">
                    <li>
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
                        </div>
                        <div class="why-text-item">
                            <h4>Secure UK Cloud Infrastructure</h4>
                            <p>Your systems hosted internationally - no local server, no IT burden.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path><path d="M2 12h20"></path></svg>
                        </div>
                        <div class="why-text-item">
                            <h4>Cross-Border Expertise</h4>
                            <p>Real operational understanding of Indonesia and UAE markets.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path><path d="M2 12h20"></path></svg>
                        </div>
                        <div class="why-text-item">
                            <h4>All-In-One Hub Model</h4>
                            <p>Digital + Consulting + Setup + Training - integrated in one ecosystem.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        </div>
                        <div class="why-text-item">
                            <h4>Data-Driven Growth</h4>
                            <p>ROI dashboards, structured reporting, performance tracking.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path></svg>
                        </div>
                        <div class="why-text-item">
                            <h4>Infrastructure-Free Expansion</h4>
                            <p>You don't build systems | We provide them ready to scale.</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="why-visual">
                <div class="visual-wrapper" style="box-shadow: none;">
                    <img src="assets/cityscape.png" alt="Dubai Cityscape" class="cityscape-img">
                    <div class="ui-overlay why-overlay">
                        <div class="ui-left why-full-overlay">
                            <h3 class="ui-logo text-center">SBCI GLOBAL</h3>
                            <p class="ui-tagline text-center">Cross-Border Business Growth Ecosystem</p>
                            <p class="ui-slogan text-center">Launch Smarter. <em>Scale Faster.</em></p>
                            
                            <div class="ui-cards-row">
                                <div class="ui-card">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
                                    <h5>Secure UK Cloud<br>Infrastructure</h5>
                                    <p>Your systems hosted<br>internationally - no local<br>server, no IT burden</p>
                                </div>
                                <div class="ui-card">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                    <h5>Cross-Border Expertise</h5>
                                    <p>Real operational understanding<br>of Indonesia and UAE markets</p>
                                </div>
                                <div class="ui-card">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    <h5>All-In-One Hub Model</h5>
                                    <p>Digital + Consulting + Setup +<br>Franchise - integrated in one<br>ecosystem</p>
                                </div>
                                <div class="ui-card">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                    <h5>Data-Driven Growth</h5>
                                    <p>ROI dashboards,<br>structured reporting,<br>performance tracking</p>
                                </div>
                            </div>
                            
                            <div class="ui-bottom-btn">
                                <div class="ui-alert">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path></svg> 
                                    <span>Infrastructure-Free Expansion</span>
                                </div>
                                <p class="small-disclaimer">You don't build systems. We provide them ready to scale.<br>System Hosting • Business Consulting • Funds Setup • Franchise Strategies</p>
                                <div class="ui-buttons center-btns">
                                    <a href="#" class="btn-outline">EXPLORE ECOSYSTEM</a>
                                    <a href="#" class="btn-outline">BECOME A PARTNER</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="learn-more-wrapper">
                    <a href="#success" class="btn-primary join-success">Join our Success Stories</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories UBL -->
    <section class="success-stories" id="success-ubl">
        <div class="section-dot-pattern top-right"></div>
        <div class="container success-container">
            <div class="success-header">
                <div class="header-left">
                    <svg viewBox="0 0 24 24" class="steps-icon" fill="var(--accent-teal)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5v-4h4v-4h4V7h6v12z"/></svg>
                    <h2>International Success Stories</h2>
                </div>
            </div>
            
            <h3 class="success-subtitle-center text-teal" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                Universitas Budi Luhur (UBL)
                <img src="assets/logo_ubl.png" alt="UBL Logo" style="height: 65px; width: auto; object-fit: contain;">
            </h3>
            <div class="success-grid">
                <div class="success-text-area">
                    <div class="highlight-text">
                        <svg class="inline-rocket" viewBox="0 0 24 24" width="45" height="45" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path></svg>
                        A Strategic Bridge Between Education & Global Industry
                    </div>
                    
                    <p>Under the visionary leadership of Dr. Mo Shehatta &ndash; Founder & Managing Director of Masterpiece & SBCI Global &ndash; together with Dr. Ahmed Farouk, Founder & Managing Director of Global Business Hub (UK-UAE), a powerful Memorandum of Understanding (MOU) has been officially established between:</p>
                    
                    <p>
                        Masterpiece Business Group - UAE<br>
                        GBH (Global Business Hub - UK & UAE)<br>
                        SBCI Global - Cross-Border Digital & Business Ecosystem<br>
                        Universitas Budi Luhur (UBL) - Indonesia
                    </p>
                    
                    <p>This strategic collaboration is further strengthened by the academic leadership of UBL:</p>
                    <p>
                        Dr. Arief - Deputy Rector for Student Affairs & Partnership<br>
                        Dr. Deni Mahdiana - Rector for Academic Affairs<br>
                        Dr. Foster - International Affairs Office
                    </p>
                </div>
                <div class="success-image-area">
                    <img src="assets/ubl_mou.png" alt="UBL MoU Signing" class="bordered-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories SAFCO -->
    <section class="success-stories bg-alt" id="success-safco">
        <div class="section-dot-pattern top-right"></div>
        <div class="container success-container">
            <div class="success-header">
                <div class="header-left">
                    <svg viewBox="0 0 24 24" class="steps-icon" fill="var(--accent-teal)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5v-4h4v-4h4V7h6v12z"/></svg>
                    <h2>International Success Stories</h2>
                </div>
            </div>
            
            <h3 class="success-subtitle-center text-teal" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                Masterpiece Business Group | SAFCO Group UAE
                <img src="assets/safco_logo.png" alt="SAFCO Logo" style="height: 65px; width: auto; object-fit: contain;">
            </h3>
            <div class="success-grid">
                <div class="success-text-area">
                    <p>We are proud to officially announce a powerful Memorandum of Understanding (MOU) signed between visionary leaders representing three dynamic forces in business growth and international expansion:</p>
                    
                    <ul class="bullet-list">
                        <li><strong>Mr. Maher Ahmed</strong> &ndash; Partner, Masterpiece Business Group</li>
                        <li><strong>Dr. Mohamed Shehatta</strong> &ndash; Managing Director, SBCI Global Group</li>
                        <li><strong>Mr. Gagandeep Sahni</strong> &ndash; Managing Director, SAFCO Group UAE</li>
                    </ul>
                    
                    <p>This strategic collaboration marks the beginning of a new cross-border ecosystem combining international digital solutions, smart infrastructure, and logistics & trading operations between the UAE and global markets.</p>
                </div>
                <div class="success-image-area">
                    <img src="assets/safco_mou.png" alt="SAFCO MoU Signing" class="bordered-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories Betterhomes -->
    <section class="success-stories" id="success-betterhomes">
        <div class="section-dot-pattern top-right"></div>
        <div class="container success-container">
            <div class="success-header">
                <div class="header-left">
                    <svg viewBox="0 0 24 24" class="steps-icon" fill="var(--accent-teal)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5v-4h4v-4h4V7h6v12z"/></svg>
                    <h2>International Success Stories</h2>
                </div>
            </div>
            
            <h3 class="success-subtitle-center text-teal" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                Masterpiece Business Group | SBCI | Betterhomes UAE
                <img src="assets/logo_betterhomes.png" alt="Betterhomes Logo" style="height: 65px; width: auto; object-fit: contain;">
            </h3>

            <div class="success-grid">
                <div class="success-text-area">
                    <p>We are proud to highlight a strategic Memorandum of Understanding (MOU) signed between Masterpiece Business Group, SBCI Global, and Betterhomes UAE &mdash; one of the UAE's most established real estate brokerage firms.</p>
                    
                    <p>This collaboration represents a structured alliance designed to integrate real estate investment, international digital infrastructure, and cross-border business expansion into one unified growth framework.</p>
                    
                    <div class="highlight-text" style="font-size: 16px; margin-top: 30px;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                        Partnership Vision
                    </div>
                    
                    <p>The MOU establishes a powerful ecosystem connecting:</p>
                    
                    <ul class="simple-list">
                        <li><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg> UAE premium real estate opportunities</li>
                        <li style="margin-top: 15px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"/></svg> Secure international digital infrastructure & cloud systems</li>
                        <li style="margin-top: 15px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c1.84-2.84 5.25-4.52 8.91-4.04-1.57.94-2.9 2.22-3.96 3.74-.68-.88-1.48-1.56-2.4-1.92-1.31-.51-2.77-.41-3.6.32zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg> Cross-border investor onboarding & business setup solutions</li>
                    </ul>
                </div>
                <div class="success-image-area">
                    <img src="assets/betterhomes_mou.png" alt="Betterhomes MoU Signing" class="bordered-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories Kantang -->
    <section class="success-stories bg-alt" id="success-kantang">
        <div class="section-dot-pattern top-right"></div>
        <div class="container success-container">
            <div class="success-header">
                <div class="header-left">
                    <svg viewBox="0 0 24 24" class="steps-icon" fill="var(--accent-teal)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5v-4h4v-4h4V7h6v12z"/></svg>
                    <h2>International Success Stories</h2>
                </div>
            </div>

            <h3 class="success-subtitle-center text-teal" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                Masterpiece Business Group | SBCI | Kantang Group
                <img src="assets/logo_kantang.png" alt="Kantang Group Logo" style="height: 65px; width: auto; object-fit: contain;">
            </h3>

            <div class="success-grid">
                <div class="success-text-area">
                    <p>We are proud to announce a strategic Memorandum of Understanding (MOU) signed between Masterpiece Business Group, SBCI Global, and Kantang Group - establishing a cross-border seafood export and smart logistics corridor from Thailand to the UAE, serving GCC and North Africa markets.</p>
                    
                    <p>This partnership marks a major step in building an integrated ecosystem combining premium seafood sourcing, white-label export solutions, and technology-driven logistics infrastructure.</p>
                    
                    <div class="highlight-text" style="font-size: 16px; margin-top: 30px;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c1.84-2.84 5.25-4.52 8.91-4.04-1.57.94-2.9 2.22-3.96 3.74-.68-.88-1.48-1.56-2.4-1.92-1.31-.51-2.77-.41-3.6.32zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg>
                        Partnership Vision
                    </div>
                    
                    <p>The alliance is structured to transform traditional seafood trading into a digitally integrated, scalable export platform, connecting:</p>
                    
                    <ul class="simple-list" style="margin-top: 20px;">
                        <li><span style="display:inline-block; width: 30px; font-weight: bold; color: #fff;">TH</span> Thailand &ndash; Premium seafood sourcing & processing</li>
                        <li style="margin-top: 8px;"><span style="display:inline-block; width: 30px; font-weight: bold; color: #fff;">AE</span> UAE &ndash; Strategic distribution & re-export hub</li>
                        <li style="margin-top: 8px;">
                            <span style="display:inline-block; width: 30px; font-weight: bold; color: #fff;"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg></span>
                            GCC & North Africa &ndash; High-demand consumption markets
                        </li>
                    </ul>
                </div>
                <div class="success-image-area">
                    <img src="assets/kantang_mou.png" alt="Kantang Group MoU Signing" class="bordered-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories Envipur -->
    <!-- (Using CSS classes rather than inline styles where possible, but inline for tiny specific overrides) -->
    <section class="success-stories" id="success-envipur">
        <div class="section-dot-pattern top-right"></div>
        <div class="container success-container">
            <div class="success-header">
                <div class="header-left">
                    <svg viewBox="0 0 24 24" class="steps-icon" fill="var(--accent-teal)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5v-4h4v-4h4V7h6v12z"/></svg>
                    <h2>International Success Stories</h2>
                </div>
            </div>
            
            <h3 class="success-subtitle-center text-teal" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                Masterpiece Business Group | SBCI | Envi Pur
                <img src="assets/logo_envi.png" alt="Envi Pur Logo" style="height: 65px; width: auto; object-fit: contain;">
            </h3>

            <div class="success-grid">
                <div class="success-text-area">
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 40px; margin-top: 10px;">
                        <svg class="inline-rocket" viewBox="0 0 24 24" width="45" height="45" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path></svg>
                        <h4 style="font-size: 20px; color: #fff; font-weight: 700; margin: 0; line-height: 1.4;">A Cross-Border Water<br>Technology Partnership</h4>
                    </div>
                    <p style="margin-bottom: 20px;">We are proud to announce a strategic success story between:</p>
                    <ul class="bullet-list" style="list-style: disc; margin-bottom: 30px; line-height: 2;">
                        <li>Masterpiece Business Group</li>
                        <li>SBCI Global</li>
                        <li>Envi-Pure s.r.o.</li>
                    </ul>
                    <p style="margin-bottom: 30px;">This collaboration marks the official integration of advanced European water treatment solutions from the Czech Republic into the UAE industrial and commercial market.</p>
                    <div class="highlight-text" style="font-size: 16px; margin-top: 30px;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8z"/></svg>
                        About Envi-Pure s.r.o.
                    </div>
                    <p>A European-based engineering company specializing in:</p>
                    <ul class="simple-list">
                        <li>Industrial wastewater treatment systems</li>
                        <li>Reverse osmosis &amp; filtration solutions</li>
                        <li>Sustainable water recycling technologies</li>
                        <li>Turnkey treatment plant installations</li>
                        <li>Environmental compliance systems</li>
                    </ul>
                    <p>Envi-Pure brings high-performance, EU-standard water treatment engineering - now structured for GCC market deployment.</p>
                    <p style="margin-top: 20px;">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c1.84-2.84 5.25-4.52 8.91-4.04-1.57.94-2.9 2.22-3.96 3.74-.68-.88-1.48-1.56-2.4-1.92-1.31-.51-2.77-.41-3.6.32zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg>
                        Market Expansion: Czech Technology &rarr; UAE Infrastructure<br>
                        Through this partnership:<br>
                        &#10003; Masterpiece Business Group leads UAE commercial structuring<br>
                        &#10003; SBCI Global manages digital positioning &amp; cross-border integration<br>
                        &#10003; Envi-Pure delivers European-engineered water treatment systems
                    </p>
                </div>
                <div class="success-image-area">
                    <img src="assets/envipur_mou.png" alt="Envi Pur MoU Signing" class="bordered-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Digital Pack Intro -->
    <section class="digital-pack bg-alt" id="digital-pack">
        <div class="section-dot-pattern top-right"></div>
        <div class="container why-container">
            <div class="why-content">
                <div class="why-header">
                    <svg viewBox="0 0 24 24" width="45" height="45" fill="var(--accent-teal)"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c1.84-2.84 5.25-4.52 8.91-4.04-1.57.94-2.9 2.22-3.96 3.74-.68-.88-1.48-1.56-2.4-1.92-1.31-.51-2.77-.41-3.6.32zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg>
                    <h2 style="font-size: 48px; text-transform: none;">Digital PACK</h2>
                </div>
                
                <p style="font-size: 18px; color: #fff; line-height: 1.5; margin-bottom: 30px;">
                    SBCI Global delivers integrated business solutions across four core pillars:
                </p>
                
                <h3 class="text-teal" style="font-size: 22px; font-weight: 500; margin-bottom: 25px;">1- Digital Infrastructure & Cloud Solutions</h3>
                
                <ul class="digital-intro-list">
                    <li>UK-based secure hosting</li>
                    <li>Corporate websites & portals</li>
                    <li>CRM & smart lead systems</li>
                    <li>Cloud call center integration</li>
                    <li>AI-powered reporting dashboards</li>
                    <li>Investor & franchise portals</li>
                    <li>Integrated Digital Marketing Solutions</li>
                </ul>
            </div>
            
            <div class="who-visual" style="margin-left: 0; padding: 25px 25px 0 25px;">
                <div class="visual-wrapper" style="box-shadow: none;">
                    <!-- A placeholder image referencing the Digital Pack UI provided by the prompt -->
                    <img src="assets/digital_pack_ui.png" alt="Digital Pack UI Mockup" class="cityscape-img" style="filter: none; opacity: 1;">
                </div>
                
                <div style="background-color: var(--accent-teal); color: #fff; padding: 15px; text-align: center; margin-top: 25px; margin-bottom: -15px; /* Offset the bottom pad */ margin-left: -25px; margin-right: -25px; font-weight: 500;">
                    Pack Starting Price 5 Million IDR | 1000 AED | 14000 EGP
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing / Packages Section -->
    <section class="packages-section" id="packages">
        <div class="container">
            <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 30px; letter-spacing: 1px;">Digital Setup Packages</h2>
            
            <div class="packages-grid">
                <!-- Package 1 -->
                <div class="package-card border-gray">
                    <div class="pkg-header border-bottom-gray">
                        <span class="pkg-number text-teal">1</span>
                        <h3>STARTER DIGITAL LAUNCH</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Build Your Digital Presence"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 5,000,000 | AED 1,000 | EGP 14,000</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label text-teal"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For</p>
                        <p class="ideal-text">Startups | Small Businesses | First-time Entrepreneurs</p>
                    </div>
                    
                    <div class="pkg-includes text-teal">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        What's Included:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Domain (.com / .co.id / .ae) - 1 Year</li>
                        <li><span>&#10003;</span> UK Secure Cloud Hosting - 1 Year</li>
                        <li><span>&#10003;</span> Professional 5-Page Website</li>
                        <li><span>&#10003;</span> Mobile Responsive Design</li>
                        <li><span>&#10003;</span> Basic SEO Setup</li>
                        <li><span>&#10003;</span> Google Search Console & Analytics</li>
                        <li><span>&#10003;</span> 2 Professional Business Emails</li>
                        <li><span>&#10003;</span> Social Media Setup (IG + FB + LinkedIn)</li>
                        <li><span>&#10003;</span> WhatsApp Business Integration</li>
                        <li><span>&#10003;</span> Basic Lead Capture Form</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-gray">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M3 3v18h18V3H3zm16 16H5V5h14v14zM11 10.5h2v3h-2v-3zM7 9.5h2v4H7v-4zm8-3h2v7h-2v-7z"/></svg>
                            ROI Plan:
                        </div>
                        <p>20-40 inbound leads/month (with basic SEO + social Media)</p>
                        <p>&bull; Brand credibility in 30 days</p>
                        <p>&bull; Suitable for service-based businesses</p>
                    </div>
                </div>

                <!-- Package 2 -->
                <div class="package-card border-teal">
                    <div class="pkg-header border-bottom-teal">
                        <span class="pkg-number">2</span>
                        <h3>GROWTH DIGITAL SYSTEM</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Automate & Capture Leads"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 9,500,000 | AED 2,200 | EGP 30,000</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For:</p>
                        <p class="ideal-text">Growing SMEs | Consultants | F&B Brands | Real Estate | Agencies</p>
                    </div>
                    
                    <div class="pkg-includes">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Everything in Starter PLUS:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> 10-Page Website / Landing Funnel</li>
                        <li><span>&#10003;</span> CRM System Integration</li>
                        <li><span>&#10003;</span> Smart Lead Tracking Dashboard</li>
                        <li><span>&#10003;</span> Meta Pixel & Google Ads Setup</li>
                        <li><span>&#10003;</span> Cloud Call Center Integration (VoIP Ready)</li>
                        <li><span>&#10003;</span> Automated Email Sequences</li>
                        <li><span>&#10003;</span> Monthly Basic Analytics Report</li>
                        <li><span>&#10003;</span> Lead Generation Campaign Setup</li>
                        <li><span>&#10003;</span> 8 Social Media Branded Posts</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-teal">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M3 3v18h18V3H3zm16 16H5V5h14v14zM11 10.5h2v3h-2v-3zM7 9.5h2v4H7v-4zm8-3h2v7h-2v-7z"/></svg>
                            ROI Plan:
                        </div>
                        <p>50-120 qualified leads/month</p>
                        <p>Automated follow-up increases conversion by 30-40%</p>
                        <p>Sales tracking visibility</p>
                        <p>Ideal for scaling businesses</p>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="package-card border-teal">
                    <div class="pkg-header border-bottom-teal">
                        <span class="pkg-number">3</span>
                        <h3>PREMIUM AIO DIGITAL HUB</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Full Business Infrastructure"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 18,000,000 | AED 3,600 | EGP 50,000</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For:</p>
                        <p class="ideal-text">Corporate | Investors | Franchise Brands | Cross-border Expansion</p>
                    </div>
                    
                    <div class="pkg-includes">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Everything in Growth PLUS:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Custom Business Portal</li>
                        <li><span>&#10003;</span> Investor / Franchise Dashboard</li>
                        <li><span>&#10003;</span> AI-Powered Reporting</li>
                        <li><span>&#10003;</span> Advanced CRM Automation</li>
                        <li><span>&#10003;</span> Smart Lead Scoring System</li>
                        <li><span>&#10003;</span> Multi-Country Domain Strategy</li>
                        <li><span>&#10003;</span> Advanced SEO Strategy</li>
                        <li><span>&#10003;</span> Paid Ads Strategy & Structure</li>
                        <li><span>&#10003;</span> Dedicated Cloud Storage System</li>
                        <li><span>&#10003;</span> KPI & Performance Dashboard</li>
                        <li><span>&#10003;</span> 3-Month Marketing Strategy Plan</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-teal" style="margin-top: 25px;">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M3 3v18h18V3H3zm16 16H5V5h14v14zM11 10.5h2v3h-2v-3zM7 9.5h2v4H7v-4zm8-3h2v7h-2v-7z"/></svg>
                            ROI Plan:
                        </div>
                        <p>150-300+ targeted leads/month</p>
                        <p>Structured investor funnel</p>
                        <p>Franchise scalability</p>
                        <p>Cross-border credibility (Indonesia &#x21C4; UAE)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Add-on Operation Packages Section -->
    <section class="packages-section bg-alt" id="addon-packages" style="padding-top: 50px;">
        <div class="container">
            <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 30px; letter-spacing: 1px;">Add-on Operation Packages</h2>
            
            <div class="packages-grid">
                <!-- Addon 1 -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M3 22v-6h6"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/></svg>
                            OPERATION PACK | Add On
                        </h3>
                    </div>
                    
                    <h4 style="color: #fff; padding: 0 20px; font-size: 18px; margin-bottom: 20px;">(Monthly Management)</h4>
                    
                    <div style="padding: 0 20px 20px;">
                        <span style="font-weight: bold; color: #fff;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M9 21c0 .5.4 1 1 1h4c.6 0 1-.5 1-1v-1H9v1zm3-19C8.1 2 5 5.1 5 9c0 2.4 1.2 4.5 3 5.7V17c0 .5.4 1 1 1h6c.6 0 1-.5 1-1v-2.3c1.8-1.3 3-3.4 3-5.7 0-3.9-3.1-7-7-7z"/></svg> 
                            Monthly Operation Pack = 50% of Setup Cost
                        </span>
                    </div>

                    <div class="pkg-includes text-teal">Includes:</div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Website Maintenance</li>
                        <li><span>&#10003;</span> Hosting Renewal</li>
                        <li><span>&#10003;</span> CRM Monitoring</li>
                        <li><span>&#10003;</span> 8-12 Social Media Posts</li>
                        <li><span>&#10003;</span> Ads Optimization</li>
                        <li><span>&#10003;</span> Lead Monitoring</li>
                        <li><span>&#10003;</span> Monthly Performance Report</li>
                    </ul>
                </div>

                <!-- Addon 2 -->
                <div class="package-card border-teal">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px; text-transform: none;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                            Advanced Lead Generation Add-On Plans
                        </h3>
                    </div>
                    
                    <div style="padding: 0 20px;">
                        <h4 style="color: #fff; font-size: 16px; margin: 15px 0 10px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 1v22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            LEAD BOOSTER PLAN
                        </h4>
                        <p class="price-value" style="font-size: 12px; margin-bottom: 15px;">Start from IDR 3,000,000 | AED 700</p>
                        
                        <ul class="pkg-features" style="padding: 0;">
                            <li><span style="color:#ccc;">&bull;</span> Meta + Google Ads</li>
                            <li><span style="color:#ccc;">&bull;</span> Funnel optimization</li>
                            <li><span style="color:#ccc;">&bull;</span> Conversion tracking</li>
                            <li><span style="color:#ccc;">&bull;</span> Weekly reporting</li>
                        </ul>
                        
                        <h4 style="color: #fff; font-size: 16px; margin: 25px 0 10px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M22 12h-4"/><path d="M6 12H2"/><path d="M12 6V2"/><path d="M12 22v-4"/></svg>
                            CROSS-BORDER INVESTOR PLAN
                        </h4>
                        <p class="price-value" style="font-size: 12px; margin-bottom: 15px;">Start from IDR 7,000,000 | AED 1800</p>
                        
                        <ul class="pkg-features" style="padding: 0;">
                            <li><span style="color:#ccc;">&bull;</span> LinkedIn targeting</li>
                            <li><span style="color:#ccc;">&bull;</span> International ads</li>
                            <li><span style="color:#ccc;">&bull;</span> Investor funnel landing page</li>
                            <li><span style="color:#ccc;">&bull;</span> CRM + appointment booking</li>
                        </ul>
                    </div>
                </div>

                <!-- Addon 3 -->
                <div class="package-card border-teal">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px; text-transform: none;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M13.22 19.34a2.91 2.91 0 0 0-2.44 0l-5.4 2.45A2 2 0 0 1 2 20V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2.92 1.8l-1.86-.46z"/><path d="m8 10 3 3 5-5"/></svg>
                            AI SALES AUTOMATION MODULE
                        </h3>
                    </div>
                    
                    <p class="pkg-tagline" style="font-size: 16px; font-weight:bold; color:#fff;">"Turn Visitors Into Paying Clients"</p>
                    <p class="price-value" style="padding: 0 20px 15px; font-size: 12px;">Start from <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> IDR 4,500,000 | <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> AED 1,100</p>
                    
                    <ul class="pkg-features" style="margin-top: 10px;">
                        <li><span>&#10003;</span> AI WhatsApp Auto-Reply System</li>
                        <li><span>&#10003;</span> Lead Qualification Chatbot</li>
                        <li><span>&#10003;</span> Smart FAQ Automation</li>
                        <li><span>&#10003;</span> Appointment Booking Integration</li>
                        <li><span>&#10003;</span> Sales Funnel Mapping</li>
                        <li><span>&#10003;</span> CRM Lead Tagging Automation</li>
                    </ul>
                    
                    <div class="pkg-roi" style="border-top: 1px solid rgba(255,255,255,0.2);">
                        <div class="roi-label" style="font-size: 16px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                            ROI Impact:
                        </div>
                        <p style="color: #fff; font-size: 13px;">Reduce manual response time by 70%</p>
                        <p style="color: #fff; font-size: 13px;">Increase conversion rate 20-35%</p>
                        <p style="color: #fff; font-size: 13px;">24/7 automated sales assistant</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Consulting Pack Intro -->
    <section class="digital-pack" id="consulting-pack" style="background-color: #222426; position: relative;">
        <!-- Using same styling base as digital-pack but adjusting colors -->
        <div class="section-dot-pattern top-right" style="background-image: radial-gradient(#2fb0ba 20%, transparent 20%);"></div>
        <div class="container why-container" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="why-content">
                <div class="why-header">
                    <svg viewBox="0 0 24 24" width="45" height="45" fill="var(--accent-teal)"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
                    <h2 style="font-size: 48px; text-transform: none;">Consulting Pack</h2>
                </div>
                
                <h3 class="text-teal" style="font-size: 22px; font-weight: 500; margin-bottom: 25px;">2- Strategic Consulting & Market Expansion</h3>
                
                <ul class="digital-intro-list" style="margin-bottom: 30px;">
                    <li>Indonesia &rightleftharpoons; UAE entry strategy</li>
                    <li>Feasibility & ROI modeling</li>
                    <li>Growth structuring & scaling blueprint</li>
                    <li>AI & digital transformation advisory</li>
                    <li>University & workforce integration programs</li>
                    <li>Lead Generation with Smart Sales and Marketing Team</li>
                    <li>Project Development and Operation</li>
                    <li>Call Center Multilingual Features</li>
                </ul>
            </div>
            
            <div class="who-visual" style="margin-left: 0; padding: 25px 25px 0 25px;">
                <div class="visual-wrapper" style="box-shadow: none; border: 4px solid var(--accent-teal);">
                    <img src="assets/consulting_pack_ui.png" alt="Consulting Pack UI Mockup" class="cityscape-img" style="filter: none; opacity: 1;">
                </div>
                
                <div style="background-color: var(--accent-teal); color: #fff; padding: 15px; text-align: center; margin-top: 25px; margin-bottom: -15px; margin-left: -25px; margin-right: -25px; font-weight: 500;">
                    Pack Starting Price 15 Million IDR | 3500 AED
                </div>
            </div>
        </div>
    </section>

    <!-- Consulting Packages Section -->
    <section class="packages-section bg-alt" id="consulting-packages" style="padding-top: 50px;">
        <div class="container">
            <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 30px; letter-spacing: 1px;">Consulting Packages</h2>
            
            <div class="packages-grid">
                <!-- Consulting Package 1 -->
                <div class="package-card border-gray">
                    <div class="pkg-header border-bottom-gray">
                        <span class="pkg-number">1</span>
                        <h3>BASIC ENTRY PACKAGE</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Market Validation & Smart Start"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 15,000,000 - AED 3,500</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label text-teal"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For:</p>
                        <p class="ideal-text">Startups | SMEs | First-time cross-border expansion</p>
                    </div>
                    
                    <div class="pkg-includes text-teal">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        What's Included:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Indonesia &rightleftharpoons; UAE Entry Strategy Overview</li>
                        <li><span>&#10003;</span> Market Feasibility Snapshot Report</li>
                        <li><span>&#10003;</span> Basic ROI Projection Model (1-3 Years)</li>
                        <li><span>&#10003;</span> Business Structure Recommendation</li>
                        <li><span>&#10003;</span> Competitor Analysis</li>
                        <li><span>&#10003;</span> Legal & Setup Advisory Guidance</li>
                        <li><span>&#10003;</span> 1 Strategy Workshop (Online)</li>
                        <li><span>&#10003;</span> Basic Lead Generation Plan (Structure Only)</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-gray">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7v-7zm4-3h2v10h-2V7zm4 6h2v4h-2v-4z"/></svg>
                            Expected Outcome:
                        </div>
                        <p>&bull; Clear go / no-go decision</p>
                        <p>&bull; Cost visibility before investment</p>
                        <p>&bull; Structured market entry roadmap</p>
                    </div>
                </div>

                <!-- Consulting Package 2 -->
                <div class="package-card border-gray">
                    <div class="pkg-header border-bottom-gray">
                        <span class="pkg-number text-teal">2</span>
                        <h3>SMART EXPANSION PACKAGE</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Structured Growth Blueprint"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 35,000,000 - AED 8,500</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label text-teal"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For:</p>
                        <p class="ideal-text">Growing SMEs | Investors | Franchise Brands | Service Companies</p>
                    </div>
                    
                    <div class="pkg-includes">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Everything in BASIC PLUS:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Detailed Feasibility Study (Financial + Operational)</li>
                        <li><span>&#10003;</span> Full ROI Modeling (5-Year Projection)</li>
                        <li><span>&#10003;</span> Growth Structuring & Scaling Blueprint</li>
                        <li><span>&#10003;</span> AI & Digital Transformation Advisory</li>
                        <li><span>&#10003;</span> Lead Generation Strategy + Funnel Design</li>
                        <li><span>&#10003;</span> Sales Structure Planning</li>
                        <li><span>&#10003;</span> University & Workforce Integration Strategy</li>
                        <li><span>&#10003;</span> Initial Partner Introduction Support</li>
                        <li><span>&#10003;</span> KPI Framework Design</li>
                        <li><span>&#10003;</span> 2 Strategy Workshops</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-gray">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7v-7zm4-3h2v10h-2V7zm4 6h2v4h-2v-4z"/></svg>
                            Expected Outcome:
                        </div>
                        <p>Investor-ready documentation</p>
                        <p>Operational clarity</p>
                        <p>Digital transformation roadmap</p>
                        <p>Structured sales pipeline</p>
                    </div>
                </div>

                <!-- Consulting Package 3 -->
                <div class="package-card border-teal">
                    <div class="pkg-header border-bottom-teal">
                        <span class="pkg-number">3</span>
                        <h3>Advanced MARKET INTEGRATION PACKAGE</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Full Expansion & Operational Execution"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 50,000,000 - AED 10,000</p>
                    </div>
                    
                    <div class="pkg-ideal">
                        <p class="ideal-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg> Ideal For:</p>
                        <p class="ideal-text">Corporate | Industrial | Education Groups | Large Investors | Government Projects</p>
                    </div>
                    
                    <div class="pkg-includes">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Everything in SMART PLUS:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Complete Market Entry Implementation</li>
                        <li><span>&#10003;</span> Project Development & Operational Structuring</li>
                        <li><span>&#10003;</span> Call Center Setup (Multilingual Support)</li>
                        <li><span>&#10003;</span> Smart CRM & Sales Dashboard Integration</li>
                        <li><span>&#10003;</span> Dedicated Lead Generation Team Support (3 Months)</li>
                        <li><span>&#10003;</span> Investor Pitch Structuring</li>
                        <li><span>&#10003;</span> Franchise or Partnership Structuring</li>
                        <li><span>&#10003;</span> On-Ground Market Representation (Coordination)</li>
                        <li><span>&#10003;</span> Regulatory & Compliance Coordination</li>
                        <li><span>&#10003;</span> 3-5 Strategy Workshops</li>
                        <li><span>&#10003;</span> 90-Day Execution Roadmap</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-teal">
                        <div class="roi-label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7v-7zm4-3h2v10h-2V7zm4 6h2v4h-2v-4z"/></svg>
                            Expected Outcome:
                        </div>
                        <p>Fully structured expansion model</p>
                        <p>Active lead acquisition system</p>
                        <p>Sales & operation infrastructure ready</p>
                        <p>Cross-border brand positioning</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Setup Pack Intro -->
    <section class="digital-pack" id="business-setup-pack" style="background-color: #292b2d; position: relative;">
        <!-- Same styling base, slightly different grey background -->
        <div class="section-dot-pattern top-right"></div>
        <div class="container why-container" style="padding-top: 80px; padding-bottom: 80px; position: relative;">
            <img src="assets/rakez_logo.png" alt="Rakez Logo" class="rakez-logo-main">
            <div class="why-content">
                <div class="why-header">
                    <svg viewBox="0 0 24 24" width="45" height="45" fill="var(--accent-teal)"><path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2 0v8h8c-.5-4.25-3.75-7.5-8-8zm0 10v10c4.25-.5 7.5-3.75 8-8h-8z"/></svg>
                    <h2 style="font-size: 48px; text-transform: none;">Business Setup Pack</h2>
                </div>
                
                <h3 class="text-teal" style="font-size: 22px; font-weight: 500; margin-bottom: 25px;">3- Business Setup & Operational Structuring</h3>
                
                <ul class="digital-intro-list" style="margin-bottom: 30px;">
                    <li>UAE Freezone & Mainland advisory | Rakez Channel Partner</li>
                    <li>Indonesia PT PMA & compliance support</li>
                    <li>HR & visa coordination</li>
                    <li>Virtual back-office systems</li>
                    <li>KPI & operational dashboards</li>
                    <li>Smart feasibility & ROI snapshot</li>
                    <li>CRM & lead management integration</li>
                    <li>Complex Activity and Business Bank Account Setup</li>
                </ul>
            </div>
            
            <div class="who-visual" style="margin-left: 0; padding: 25px 25px 0 25px;">
                <div class="visual-wrapper" style="box-shadow: none; border: 4px solid var(--accent-teal);">
                    <img src="assets/business_setup_ui.png" alt="Business Setup UI Mockup" class="cityscape-img" style="filter: none; opacity: 1;">
                </div>
                
                <div style="background-color: var(--accent-teal); color: #fff; padding: 15px; text-align: center; margin-top: 25px; margin-bottom: -15px; margin-left: -25px; margin-right: -25px; font-weight: 500;">
                    Pack Starting Price 25 Million IDR | 5000 AED | 70000 EGP
                </div>
            </div>
        </div>
    </section>

    <!-- Business Setup Packages Section -->
    <section class="packages-section" id="business-setup-packages" style="padding-top: 50px;">
        <div class="container">
            <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 30px; letter-spacing: 1px;">UAE Indonesia Setup Pack</h2>
            
            <div class="packages-grid">
                <!-- UAE Package 1 -->
                <div class="package-card border-gray">
                    <div class="pkg-header border-bottom-gray">
                        <span class="pkg-number text-teal">1</span>
                        <h3>STARTUP FREEZONE UAE PACKAGE</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Launch in UAE. Tax Optimized."</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">AED 7000 - IDR 35,000,000</p>
                    </div>
                    
                    <div class="pkg-includes text-teal">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Includes:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> RAKEZ Freezone License</li>
                        <li><span>&#10003;</span> 100% Foreign Ownership</li>
                        <li><span>&#10003;</span> 0% Personal Income Tax</li>
                        <li><span>&#10003;</span> 0% Corporate Tax (qualifying conditions apply)</li>
                        <li><span>&#10003;</span> Shared Coworkspace (Flexi Desk)</li>
                        <li><span>&#10003;</span> Landline Number</li>
                        <li><span>&#10003;</span> Business Activity Approval</li>
                        <li><span>&#10003;</span> Smart Feasibility & ROI Snapshot</li>
                        <li><span>&#10003;</span> Basic KPI Dashboard Setup</li>
                        <li><span>&#10003;</span> Bank Account Pre-Approval Support</li>
                        <li><span>&#10003;</span> CRM & Lead System Integration (Basic)</li>
                    </ul>
                    <div style="text-align: right; padding: 0 20px 20px; margin-top: auto;">
                        <img src="assets/rakez_logo.png" alt="Rakez Logo" style="height: 60px;">
                    </div>
                </div>

                <!-- UAE Package 2 -->
                <div class="package-card border-teal">
                    <div class="pkg-header border-bottom-teal">
                        <span class="pkg-number">2</span>
                        <h3>SCALE-UP UAE FREEZONE PACKAGE</h3>
                    </div>
                    
                    <p class="pkg-tagline">"Structured & Bank-Ready"</p>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">AED 15,000 - IDR 65,000,000</p>
                    </div>
                    
                    <p class="ideal-text" style="padding: 0 20px 10px;">Everything in Startup PLUS:</p>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> Multi-Activity License</li>
                        <li><span>&#10003;</span> Complex Activity Handling</li>
                        <li><span>&#10003;</span> Dedicated Bank Account Coordination</li>
                        <li><span>&#10003;</span> Virtual Back-Office Setup</li>
                        <li><span>&#10003;</span> Operational Structuring Blueprint</li>
                        <li><span>&#10003;</span> Lead Management CRM System</li>
                        <li><span>&#10003;</span> Growth KPI Dashboard</li>
                        <li><span>&#10003;</span> 1 Strategy Session</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-teal">
                        <div class="roi-label" style="color: #ccc; margin-bottom: 5px; font-size: 13px;">
                            INVESTOR RESIDENCY ADD-ON (2000 AED / Year)
                        </div>
                        <ul class="pkg-features" style="padding: 0; padding-top: 10px; padding-bottom: 20px;">
                            <li><span>&#10003;</span> Investor Visa</li>
                            <li><span>&#10003;</span> Emirates ID</li>
                            <li><span>&#10003;</span> Medical & Biometrics</li>
                            <li><span>&#10003;</span> Assistance with Housing & Facilities</li>
                            <li><span>&#10003;</span> Business Credit Line Advisory</li>
                            <li><span>&#10003;</span> Corporate Bank Support</li>
                        </ul>
                    </div>
                    <div style="text-align: right; padding: 0 20px 20px; margin-top: auto;">
                        <img src="assets/rakez_logo.png" alt="Rakez Logo" style="height: 60px;">
                    </div>
                </div>

                <!-- Indonesia Package -->
                <div class="package-card border-gray">
                    <div class="pkg-header border-bottom-gray">
                        <span class="pkg-number text-teal">3</span>
                        <h3>PT Indonesia START PACKAGE</h3>
                    </div>
                    
                    <div class="pkg-price-group">
                        <p class="price-label"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Starting From:</p>
                        <p class="price-value">IDR 35,000,000 - AED 7,000</p>
                    </div>
                    
                    <div class="pkg-includes text-teal">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                        Includes:
                    </div>
                    
                    <ul class="pkg-features">
                        <li><span>&#10003;</span> PT Company Registration</li>
                        <li><span>&#10003;</span> Business Identification Number (NIB)</li>
                        <li><span>&#10003;</span> Legal Compliance Documentation</li>
                        <li><span>&#10003;</span> Coworkspace Address (12 Months)</li>
                        <li><span>&#10003;</span> Bank Account Setup Support</li>
                        <li><span>&#10003;</span> Tax Registration</li>
                        <li><span>&#10003;</span> Smart Feasibility Snapshot</li>
                        <li><span>&#10003;</span> KPI Operational Structure</li>
                        <li><span>&#10003;</span> CRM Integration (Basic)</li>
                    </ul>
                    
                    <div class="pkg-roi border-top-gray">
                        <div class="roi-label" style="color: #ccc; margin-bottom: 5px; font-size: 13px;">
                            Customer Service Team ADD-ON<br>(1000 AED Monthly)
                        </div>
                        <ul class="pkg-features" style="padding: 0; padding-top: 10px;">
                            <li><span>&#10003;</span> Website and Domain (local Indonesian)</li>
                            <li><span>&#10003;</span> WhatsApp Api</li>
                            <li><span>&#10003;</span> QRIS and Ecommerce</li>
                            <li><span>&#10003;</span> Customer Service Reply with Local Bahasa</li>
                            <li><span>&#10003;</span> Professional Consulting and Management</li>
                            <li><span>&#10003;</span> Local Social Media Setup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certified Training & Development Intro -->
    <section class="digital-pack" id="training-pack" style="background-color: #222426; position: relative;">
        <!-- Same styling base, dark grey background -->
        <div class="section-dot-pattern top-right" style="background-image: radial-gradient(#2fb0ba 20%, transparent 20%);"></div>
        <div class="container why-container" style="padding-top: 80px; padding-bottom: 60px;">
            <div class="why-content" style="padding-right: 30px;">
                <h2 class="text-teal" style="font-size: 38px; text-transform: none; margin-bottom: 25px;">Certified Training & Career Development Packages</h2>
                
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px; font-size: 15px;">
                    SBCI Global Certified Training & Development Sector is a structured capability-building platform designed to equip Indonesian talents and corporate teams with internationally aligned competencies, integrated with UAE&ndash;ASEAN market exposure and real business application models.
                </p>
                
                <h3 class="text-teal" style="font-size: 18px; font-weight: 500; margin-bottom: 15px;">Our certified programs are designed for:</h3>
                
                <ul class="digital-intro-list" style="margin-bottom: 40px;">
                    <li><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72l5 2.73 5-2.73v3.72z"/></svg> University Students</li>
                    <li><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> Fresh Graduates</li>
                    <li><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg> SMEs & Corporate Teams</li>
                    <li><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><circle cx="12" cy="12" r="10"/><path d="M2.32 12A10.02 10.02 0 0 0 12 21.98M12 2.02A10.02 10.02 0 0 0 2.32 12M12 2v20M2 12h20M7.5 12c0 4.14 2 7.5 4.5 7.5s4.5-3.36 4.5-7.5-2-7.5-4.5-7.5-4.5 3.36-4.5 7.5z"/></svg> Professionals Targeting GCC & International Markets</li>
                </ul>

                <h3 class="text-teal" style="font-size: 16px; font-weight: 500; margin-bottom: 15px; text-transform: uppercase;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 8px;"><circle cx="12" cy="12" r="10"/></svg>
                    STRUCTURE OF THE CERTIFIED TRAINING PROGRAM DIVISIONS
                </h3>
                <ul class="digital-intro-list" style="margin-bottom: 30px; font-size: 15px; list-style-type: decimal; padding-left: 20px;">
                    <li style="padding-left: 10px; margin-bottom: 10px;">Language & Global Communication Program</li>
                    <li style="padding-left: 10px; margin-bottom: 10px;">Soft Skills & Leadership Program</li>
                    <li style="padding-left: 10px; margin-bottom: 10px;">Digital Solutions Program</li>
                    <li style="padding-left: 10px; margin-bottom: 10px;">Smart AI & Automation Tech Program</li>
                </ul>
            </div>
            
            <div class="who-visual" style="margin-left: 0; padding: 25px 25px 0 25px; align-items: flex-start;">
                <div class="visual-wrapper" style="box-shadow: none; border: 4px solid var(--accent-teal);">
                    <img src="assets/training_pack_ui.png" alt="Training Pack UI Mockup" class="cityscape-img" style="filter: none; opacity: 1;">
                </div>
                
                <div style="background-color: var(--accent-teal); color: #fff; padding: 15px; text-align: center; margin-top: 25px; margin-bottom: -15px; margin-left: -25px; margin-right: -25px; font-weight: 500;">
                    Pack Starting Price 1.05 Million IDR | 227 AED | 3000 EGP
                </div>
            </div>
        </div>
    </section>

    <!-- Training Programs Section -->
    <section class="packages-section bg-alt" id="training-programs" style="padding-top: 50px;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
                <h2 class="text-teal" style="font-size: 32px; font-weight: 600; letter-spacing: 1px; margin: 0;">Certified Training & Development Programs</h2>
                <div style="background-color: #fff; padding: 10px 15px; border-radius: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <img src="assets/global_business_hub_logo.png" alt="Global Business Hub Logo" style="height: 50px; width: auto; object-fit: contain; display: block;">
                </div>
            </div>
            
            <div class="packages-grid" style="grid-template-columns: repeat(2, 1fr);">
                <!-- Program 1 -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72l5 2.73 5-2.73v3.72z"/></svg>
                            1 LANGUAGE & GLOBAL COMMUNICATION PROGRAM
                        </h3>
                    </div>
                    
                    <div style="padding: 20px;">
                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            Objective:
                        </span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 20px;">Develop global communication capability aligned with UAE & international business standards.</p>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Modules:</span>
                        <ul class="pkg-features" style="padding: 0; margin-bottom: 20px;">
                            <li><span style="color:#ccc;">&bull;</span> Business English for GCC Market</li>
                            <li><span style="color:#ccc;">&bull;</span> Professional Email & Proposal Writing</li>
                            <li><span style="color:#ccc;">&bull;</span> Cross-Cultural Communication (ASEAN-UAE)</li>
                            <li><span style="color:#ccc;">&bull;</span> Interview & Corporate Presentation Skills</li>
                        </ul>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Duration:</span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 25px;">6 Weeks | 2 Sessions / Week | 24 Hours Total</p>

                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Special Start Price:
                        </span>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> Indonesia IDR 1,050,000 per participant</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">AE</span> UAE AED 227 per participant</p>
                        <p style="color: #ccc; font-size: 13px; font-style: italic;">(Group discount available for universities & corporates)</p>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><circle cx="12" cy="11" r="3"/></svg>
                            2 SOFT SKILLS & LEADERSHIP PROGRAM
                        </h3>
                    </div>
                    
                    <div style="padding: 20px;">
                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            Objective:
                        </span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 20px;">Build professional maturity, leadership mindset, and workplace readiness.</p>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Modules:</span>
                        <ul class="pkg-features" style="padding: 0; margin-bottom: 20px;">
                            <li><span style="color:#ccc;">&bull;</span> Growth Mindset & Professional Ethics</li>
                            <li><span style="color:#ccc;">&bull;</span> Time & Performance Management</li>
                            <li><span style="color:#ccc;">&bull;</span> Team Leadership & Decision Making</li>
                            <li><span style="color:#ccc;">&bull;</span> Workplace Emotional Intelligence</li>
                            <li><span style="color:#ccc;">&bull;</span> Corporate Problem-Solving Simulation</li>
                        </ul>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Duration:</span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 25px;">6 Weeks | 24 Hours</p>

                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Special Start Price:
                        </span>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> Indonesia IDR 1,500,000 per participant level</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">AE</span> UAE AED 325</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Training Career Programs Section -->
    <section class="packages-section bg-alt" id="training-career-programs">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
                <h2 class="text-teal" style="font-size: 32px; font-weight: 600; letter-spacing: 1px; margin: 0;">Certified Training & Development Career Programs</h2>
            </div>
            
            <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: stretch;">
                <div class="packages-grid" style="flex: 2; grid-template-columns: repeat(2, 1fr); min-width: 60%;">
                <!-- Program 3 -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            3 DIGITAL SOLUTIONS PROGRAM
                        </h3>
                    </div>
                    
                    <div style="padding: 20px;">
                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            Objective:
                        </span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 20px;">Equip participants with practical digital business infrastructure skills.</p>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Modules:</span>
                        <ul class="pkg-features" style="padding: 0; margin-bottom: 20px;">
                            <li><span style="color:#ccc;">&bull;</span> CRM & Lead Management Systems</li>
                            <li><span style="color:#ccc;">&bull;</span> Cloud-Based Business Operations</li>
                            <li><span style="color:#ccc;">&bull;</span> Digital Marketing Fundamentals</li>
                            <li><span style="color:#ccc;">&bull;</span> Website & Funnel Strategy</li>
                            <li><span style="color:#ccc;">&bull;</span> KPI Dashboard & Reporting</li>
                        </ul>
                        <p style="color: #fff; font-size: 14px; margin-bottom: 20px;">Includes live dashboard simulation & real project case.</p>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Duration:</span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 25px;">8 Weeks | 32 Hours</p>

                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Special Price start:
                        </span>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> Indonesia: IDR 2,000,000 / Level</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">AE</span> UAE: AED 450 / level</p>
                    </div>
                </div>

                <!-- Program 4 -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 2a2 2 0 0 1 2 2c0 .7-.4 1.3-1 1.7V7h4v2h-4v2h4v2h-4v1.3c.6.4 1 1 1 1.7a2 2 0 1 1-4 0c0-.7.4-1.3 1-1.7V13H7v-2h4V9H7V7h4V5.7c-.6-.4-1-1-1-1.7a2 2 0 0 1 2-2z"/></svg>
                            4 SMART AI & AUTOMATION TECH PROGRAM
                        </h3>
                    </div>
                    
                    <div style="padding: 20px;">
                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            Objective:
                        </span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 20px;">Prepare participants for AI-powered workplaces and business automation integration.</p>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Modules:</span>
                        <ul class="pkg-features" style="padding: 0; margin-bottom: 20px;">
                            <li><span style="color:#ccc;">&bull;</span> AI for Business Operations</li>
                            <li><span style="color:#ccc;">&bull;</span> Automation Tools & Workflow Systems</li>
                            <li><span style="color:#ccc;">&bull;</span> AI Content & Marketing Automation</li>
                            <li><span style="color:#ccc;">&bull;</span> Data-Driven Decision Making</li>
                            <li><span style="color:#ccc;">&bull;</span> AI Productivity Systems</li>
                            <li><span style="color:#ccc;">&bull;</span> Future Workforce & Global Readiness</li>
                        </ul>

                        <div class="pkg-includes text-teal" style="margin-left: 0;">Includes:</div>
                        <ul class="pkg-features" style="padding: 0; margin-bottom: 20px;">
                            <li><span>&#10003;</span> Automation Workflow Build</li>
                            <li><span>&#10003;</span> AI Project Submission</li>
                            <li><span>&#10003;</span> Final Digital Portfolio</li>
                        </ul>

                        <span style="font-weight: bold; color: #fff; margin-bottom: 15px; display: block;">Duration:</span>
                        <p style="color: #ccc; font-size: 15px; margin-bottom: 25px;">8 Weeks | 32 Hours</p>

                        <span style="font-weight: bold; color: #fff; display: flex; align-items: center; margin-bottom: 15px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Special Price Start:
                        </span>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> Indonesia: IDR 3,000,000 / level</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">AE</span> UAE: AED 660 / level</p>
                    </div>
                </div>
            </div>
            
            <!-- AI Tools & Platforms Image -->
            <div style="flex: 1; display: flex; align-items: center; justify-content: center; min-width: 300px; padding: 20px;">
                <img src="assets/app_logo.png" alt="AI Tools & Platforms" style="max-width: 100%; height: auto;">
            </div>
        </div>
        </div>
    </section>

    <!-- Corporate Bundles & Certification Structure Section -->
    <section class="packages-section" id="training-bundles" style="padding-top: 50px;">
        <div class="container">
            <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: stretch;">
                <div class="packages-grid" style="flex: 2; grid-template-columns: repeat(2, 1fr); min-width: 60%;">
                    <!-- Bundles -->
                <div class="package-card border-teal" style="background-color: transparent;">
                    <div class="pkg-header">
                        <h3 style="font-size: 20px;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                            CORPORATE & UNIVERSITY BUNDLED PACKAGES
                        </h3>
                    </div>
                    
                    <div style="padding: 20px;">
                        <h4 style="color: #fff; font-size: 16px; margin-bottom: 10px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><circle cx="12" cy="12" r="10"/></svg>
                            SILVER CORPORATE PACK
                        </h4>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">2 Programs | 20 Participants</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> IDR 30,000,000</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 20px;"><span style="color:#fff; font-weight:bold;">AE</span> AED 6500</p>

                        <h4 style="color: #fff; font-size: 16px; margin-bottom: 10px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            GOLD CORPORATE PACK
                        </h4>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">All 4 Programs | 30 Participants</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Includes customized case study</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> IDR 60,000,000</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 20px;"><span style="color:#fff; font-weight:bold;">AE</span> AED 12,000</p>

                        <h4 style="color: #fff; font-size: 16px; margin-bottom: 10px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            PLATINUM UNIVERSITY PARTNERSHIP
                        </h4>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Annual Contract</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Unlimited student access (LMS)</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">2 Live Cohorts / Semester</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Internship & UAE Exposure Webinar</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">ID</span> Starting IDR 100,000,000 / Year</p>
                        <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;"><span style="color:#fff; font-weight:bold;">AE</span> AED 22000 / Year</p>
                    </div>
                </div>

                <!-- Certification Structure & GCC Career Setup -->
                <div style="display: flex; flex-direction: column; gap: 30px;">
                    <!-- Top Box: Certification Level Structure -->
                    <div class="package-card border-teal" style="background-color: transparent;">
                        <div class="pkg-header">
                            <h3 style="font-size: 20px;">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                CERTIFICATION LEVEL STRUCTURE
                            </h3>
                        </div>
                        <div style="padding: 20px;">
                            <p style="color: #ccc; font-size: 15px; margin-bottom: 15px;">Level 1 &ndash; Foundation Certified</p>
                            <p style="color: #ccc; font-size: 15px; margin-bottom: 15px;">Level 2 &ndash; Professional Certified</p>
                            <p style="color: #ccc; font-size: 15px; margin-bottom: 25px;">Level 3 &ndash; International Market Ready Certified</p>

                            <p style="color: #ccc; font-size: 15px; margin-bottom: 10px;">Participants completing 3+ programs receive:</p>
                            <p style="color: #fff; font-weight: bold; font-size: 15px; margin-bottom: 25px;">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg> 
                                SBCI Global Advanced Professional Certification
                            </p>
                            
                            <p style="color: #fff; font-weight: bold; font-size: 15px; line-height: 1.5;">
                                Special Program and Authorized International Membership - Customized Program on client Request.
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Box: Career Development Program (GCC) -->
                    <div class="package-card border-teal" style="background-color: transparent;">
                        <div class="pkg-header">
                            <h3 style="font-size: 20px;">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                                Career Development Program (GCC)
                            </h3>
                        </div>
                        <div style="padding: 20px;">
                            <h4 style="color: #fff; font-size: 16px; margin-bottom: 15px;">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align: middle; margin-right: 5px;"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg> 
                                Career Development Program
                            </h4>
                            <p style="color: #fff; font-weight: bold; font-size: 15px; margin-bottom: 20px;">
                                Indonesia | Egypt &rarr; GCC Region
                            </p>
                            <p style="color: #ccc; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                                A structured Career Mobility & Workforce Acceleration Program designed to prepare, qualify, and deploy Indonesian and Egyptian talents into high-demand sectors across the GCC.
                            </p>
                            <p style="color: #ccc; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                                This is not just training.
                            </p>
                            <p style="color: #ccc; font-size: 14px; line-height: 1.6;">
                                It is a Career-to-Employment Ecosystem powered by digital infrastructure, industry alignment, and cross-border HR structuring.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Logos Side Column -->
            <div style="flex: 0 0 350px; display: flex; flex-direction: column; gap: 40px; align-items: stretch; justify-content: center; padding: 20px; margin-left: auto;">
                <!-- Row 1: Global Business Hub -->
                <div style="text-align: right;">
                    <img src="assets/global_business_hub_logo.png" alt="Global Business Hub" style="width: 100%; max-width: 250px; height: auto; background-color: #fff; padding: 5px 10px; border-radius: 4px;">
                </div>
                
                <!-- Row 2 -->
                <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                    <img src="assets/logo_ubl.png" alt="UBL Logo" style="max-height: 120px; width: auto; object-fit: contain; margin-left: -10px;">
                    <img src="assets/ump_logo.png" alt="UMP Logo" style="max-height: 120px; width: auto; object-fit: contain;">
                </div>
                
                <!-- Row 3 -->
                <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                    <img src="assets/logo_kantang.png" alt="Masterpiece / Partner" style="max-height: 80px; width: auto; object-fit: contain;">
                    <img src="assets/sbci_digital_logo.png" alt="SBCI Digital Logo" style="max-height: 50px; width: auto; object-fit: contain;">
                </div>
                
                <!-- Row 4 -->
                <div style="text-align: right;">
                    <img src="assets/rakez_logo.png" alt="Rakez Logo" style="max-height: 80px; width: auto; object-fit: contain;">
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Company Policy Section -->
    <section class="packages-section bg-alt" id="company-policy" style="padding-top: 50px;">
        <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap;">
            <!-- Left: Policy Text (Flex 1) -->
            <div style="flex: 1; min-width: 300px;">
                <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 20px;">Company Policy</h2>
                <p style="color: #fff; line-height: 1.6; margin-bottom: 15px;">This policy outlines the official payment terms, installment structure, and refund conditions applicable to all SBCI Global services including:</p>
                <ul style="color: #ccc; line-height: 1.6; margin-bottom: 25px; list-style-type: none; padding-left: 0;">
                    <li>Digital Solution Packages</li>
                    <li>Consulting & Market Expansion Packages</li>
                    <li>Business Setup & Operational Structuring</li>
                    <li>Franchise & Investment Models</li>
                    <li>Training & Development Programs</li>
                </ul>

                <h3 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Non-Refund Policy</h3>
                <p style="color: #fff; margin-bottom: 5px;">Strict Non-Refund Clause</p>
                <p style="color: #fff; margin-bottom: 5px;">All payments made to SBCI Global are non-refundable under the following conditions:</p>
                <ul style="color: #ccc; line-height: 1.6; margin-bottom: 25px; list-style-type: none; padding-left: 0;">
                    <li>After service initiation</li>
                    <li>After submission of official applications (government, freezone, bank, etc.)</li>
                    <li>After digital development commencement</li>
                    <li>After consulting strategy delivery</li>
                    <li>After documentation processing</li>
                    <li>After franchise blueprint or feasibility study submission</li>
                </ul>

                <h3 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Deposits</h3>
                <p style="color: #fff; margin-bottom: 5px;">All deposits are:</p>
                <ul style="color: #ccc; line-height: 1.6; margin-bottom: 25px; list-style-type: none; padding-left: 0;">
                    <li>Non-refundable</li>
                    <li>Non-transferable</li>
                    <li>Non-adjustable to other services</li>
                </ul>

                <h3 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Government & Third-Party Fees</h3>
                <p style="color: #fff; margin-bottom: 5px;">Government charges, licensing fees, visa fees, bank charges, and third-party costs are:</p>
                <ul style="color: #ccc; line-height: 1.6; margin-bottom: 15px; list-style-type: none; padding-left: 0;">
                    <li>Strictly non-refundable once submitted</li>
                    <li>Subject to authority regulations</li>
                    <li>Not controlled by SBCI Global</li>
                </ul>
                <p style="color: #fff;">Fore More Information - Email us on: <a href="mailto:info@sbciglobal.com" class="text-teal" style="text-decoration: none;">info@sbciglobal.com</a></p>
            </div>
            
            <!-- Right: Payment Image -->
            <div style="flex: 1; min-width: 300px; display: flex; align-items: center; justify-content: center;">
                <img src="assets/payment_mockup.png" alt="Payment Methods" style="width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            </div>
        </div>
    </section>

    <!-- Join Our Success Story (Form) Section -->
    <section class="packages-section" id="join-us" style="padding-top: 50px;">
        <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap;">
            <!-- Left: Form -->
            <div style="flex: 1; min-width: 300px;">
                <h2 class="text-teal" style="font-size: 28px; font-weight: 600; margin-bottom: 20px;">Join Our Success Story | Your Entry to Structured International Growth</h2>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">One Ticket. Four Strategic Divisions. Unlimited Possibilities.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">At SBCI Global, we don't offer generic advice.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">We deliver structured solutions aligned with your expansion goals across Indonesia, UAE, and international markets.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px;">Submit your consulting ticket and our expert division will connect with you directly via WhatsApp or Email within 24 hours.</p>

                <?php if ($form_message): ?>
                    <div style="padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #fff; background-color: <?php echo $form_status === 'success' ? '#2ecc71' : '#e74c3c'; ?>;">
                        <?php echo htmlspecialchars($form_message); ?>
                    </div>
                <?php endif; ?>

                <div style="border: 1px solid #2fb0ba; padding: 30px; border-radius: 8px;">
                    <form action="#join-us" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">Full Name:</label>
                            <input type="text" name="full_name" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">WhatsApp Number: (with country code)</label>
                            <input type="text" name="whatsapp_number" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">Email Address:</label>
                            <input type="email" name="email_address" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>

                        <div>
                            <h4 class="text-teal" style="margin-bottom: 10px; font-size: 16px;">Select Your Pack*</h4>
                            <p style="color: #888; font-size: 12px; margin-bottom: 10px;">(Multi-select available)</p>
                            <div style="display: flex; flex-direction: column; gap: 8px; color: #fff; font-size: 14px;">
                                <label><input type="checkbox" name="packs[]" value="Digital Solution Pack"> Digital Solution Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Consulting Pack"> Consulting Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Company Setup Pack"> Company Setup Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Training & Development Pack"> Training & Development Pack</label>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-teal" style="margin-bottom: 10px; font-size: 16px;">Describe Your Objective*</h4>
                            <p style="color: #888; font-size: 12px; margin-bottom: 10px;">Briefly explain your current situation, challenges, or expansion goals.</p>
                            <textarea name="objective" rows="4" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px; width: 100%; box-sizing: border-box; resize: vertical;"></textarea>
                        </div>

                        <button type="submit" style="background-color: #2fb0ba; color: #fff; border: none; padding: 12px 20px; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; align-self: flex-start;">Send Ticket</button>
                    </form>
                </div>
            </div>

            <!-- Right: Consulting Ticket Image -->
            <div style="flex: 1; min-width: 300px; display: flex; align-items: center; justify-content: center;">
                <img src="assets/consulting_ticket.png" alt="Strategic Consulting Ticket" style="width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            </div>
        </div>
    </section>

    <!-- Final Footer / Contact Section -->
    <footer id="contact" style="background-color: #1e2022; padding: 60px 0; border-top: 5px solid #2fb0ba; margin-top: 50px; position: relative;">
        <!-- Dot Pattern top right -->
        <div class="section-dot-pattern top-right" style="background-image: radial-gradient(#2fb0ba 20%, transparent 20%); width: 150px; height: 150px; opacity: 0.5;"></div>
        
        <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start;">
            
            <!-- Left: Team Image & Copyright -->
            <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; gap: 20px;">
                <img src="assets/team_meeting.png" alt="SBCI Global Team" style="width: 100%; border-radius: 4px; border-left: 10px solid #2fb0ba; display: block;">
                
                <div style="display: flex; gap: 20px; align-items: center; margin-top: 10px;">
                    <div style="flex: 1; text-align: center;">
                        <img src="assets/logo.png" alt="SBCI Shield Logo" style="width: 114px; margin-bottom: 5px;">
                        <p style="color: #666; font-size: 10px; letter-spacing: 1px;">AUTHORIZED BUSINESS PARTNER</p>
                        <p style="color: #666; font-size: 12px; margin-top: 10px;">Copyright @ 2026 SBCI Global Group</p>
                    </div>
                    <div style="background-color: #2fb0ba; padding: 15px; text-align: center; border-radius: 4px;">
                        <img src="assets/qr_scan.png" alt="QR Code" style="width: 100px; height: 100px; border-radius: 4px; margin-bottom: 5px; background: #fff; padding: 5px;">
                        <p style="color: #fff; font-size: 14px; font-weight: 600; margin: 0;">Scan | Join Us</p>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Information -->
            <div style="flex: 1; min-width: 300px;">
                <h2 class="text-teal" style="font-size: 32px; font-weight: 600; margin-bottom: 15px;">
                    <svg viewBox="0 0 24 24" width="30" height="30" fill="currentColor" style="vertical-align: middle; margin-right: 10px;"><path d="M21.5 2v6h-1.5V4.6l-6.5 6.5-4-4L2 14.6 3.4 16l8-8 4 4 8-8V10H25V2h-3.5z"/></svg> 
                    Launch Smarter | Scale Faster
                </h2>
                <p style="color: #2fb0ba; font-size: 18px; margin-bottom: 30px;">Join our Success Stories . . .</p>
                <p style="color: #ccc; font-size: 16px; margin-bottom: 40px;">Contact us for Free Consultation with our experts :)</p>

                <div style="display: flex; flex-direction: column; gap: 30px;">
                    <!-- UAE Address -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">UAE <span style="font-weight: 400;">Address</span></h4>
                            <p style="color: #ccc; font-size: 14px;"><a href="https://maps.google.com/?q=Rakez+Compass+UAE" target="_blank" style="color: #ccc; text-decoration: none;">Rakez Compass UAE | SBCI Rakez Channel Partner</a></p>
                        </div>
                    </div>

                    <!-- UAE Contact -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">UAE <span style="font-weight: 400;">Contact</span></h4>
                            <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Land Line: <a href="tel:+97172031433" style="color: #ccc; text-decoration: none;">+971 7 203 1433</a> | Mobile: <a href="https://wa.me/971557414583" target="_blank" style="color: #ccc; text-decoration: none;">+971 55 7414 583</a></p>
                            <p style="color: #ccc; font-size: 14px;">Email: <a href="mailto:info@sbciglobal.com" style="color: #ccc; text-decoration: none;">info@sbciglobal.com</a></p>
                        </div>
                    </div>

                    <!-- Indonesia Address -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Indonesia <span style="font-weight: 400;">Address</span></h4>
                            <p style="color: #ccc; font-size: 14px;"><a href="https://maps.google.com/?q=Prosperity+Tower+SCBD+Jakarta" target="_blank" style="color: #ccc; text-decoration: none;">Prosperity Tower, 8th Floor Kawasan SCBD | Jakarta</a></p>
                        </div>
                    </div>

                    <!-- Indonesia Contact -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Indonesia <span style="font-weight: 400;">Contact</span></h4>
                            <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Mobile: <a href="https://wa.me/6281385221520" target="_blank" style="color: #ccc; text-decoration: none;">+62 8138 522 1520</a></p>
                            <p style="color: #ccc; font-size: 14px;">Email: <a href="mailto:info@sbciglobal.com" style="color: #ccc; text-decoration: none;">info@sbciglobal.com</a></p>
                        </div>
                    </div>

                    <!-- Egypt Address -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Egypt <span style="font-weight: 400;">Address</span></h4>
                            <p style="color: #ccc; font-size: 14px;"><a href="https://maps.google.com/?q=Raya+Offices+Regus+New+Cairo+Egypt" target="_blank" style="color: #ccc; text-decoration: none;">Raya Offices - Regus - New Cairo Egypt</a></p>
                        </div>
                    </div>

                    <!-- Egypt Contact -->
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="background-color: #2fb0ba; color: #fff; padding: 15px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-teal" style="font-size: 18px; margin-bottom: 5px;">Egypt <span style="font-weight: 400;">Contact</span></h4>
                            <p style="color: #ccc; font-size: 14px; margin-bottom: 5px;">Mobile: <a href="https://wa.me/201555534883" target="_blank" style="color: #ccc; text-decoration: none;">+20 15555 34883</a></p>
                            <p style="color: #ccc; font-size: 14px;">Email: <a href="mailto:info@sbciglobal.com" style="color: #ccc; text-decoration: none;">info@sbciglobal.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple mobile menu toggle
        const menuToggle = document.getElementById('mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            menuToggle.classList.toggle('active');
        });

        // Scroll Observer for Active Navigation
        const sections = document.querySelectorAll("section[id], main[id]");
        const navItems = document.querySelectorAll(".nav-links a[href^='#']");

        window.addEventListener("scroll", () => {
            let current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 150) { // Offset for fixed navbar
                    current = section.getAttribute("id");
                }
            });

            // Map specific sections to their parent navigation item
            const sectionMap = {
                // Keep Home green until Digital Pack
                "who-we-are": "home",
                "why-choose": "home",
                "success-ubl": "home",
                "success-safco": "home",
                "success-betterhomes": "home",
                "success-kantang": "home",
                "success-envipur": "home",
                
                // Digital Pack sub-sections
                "packages": "digital-pack",
                "addon-packages": "digital-pack",

                // Consulting Pack sub-sections
                "consulting-packages": "consulting-pack",

                // Business Setup Pack sub-sections
                "business-setup-packages": "business-setup-pack",

                // Keep Training Pack green until Policy
                "training-programs": "training-pack",
                "training-career-programs": "training-pack",
                "training-bundles": "training-pack"
            };

            // Translate the current section ID if it exists in the map
            const targetNavId = sectionMap[current] || current;

            navItems.forEach((item) => {
                item.classList.remove("active");
                if (item.getAttribute("href") === `#${targetNavId}`) {
                    item.classList.add("active");
                }
            });
        });


        // Trigger scroll event on page load to set correct initial state
        window.dispatchEvent(new Event('scroll'));
    </script>
</body>
</html>
