<?php
require_once 'db.php';

function ai_h($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function ai_icon($name) {
    $icons = [
        'ai' => '<path d="M12 2v3"/><path d="M12 19v3"/><path d="M2 12h3"/><path d="M19 12h3"/><path d="m4.9 4.9 2.1 2.1"/><path d="m17 17 2.1 2.1"/><path d="m19.1 4.9-2.1 2.1"/><path d="m7 17-2.1 2.1"/><rect x="7" y="7" width="10" height="10" rx="2"/><path d="M10 11h4"/><path d="M10 14h2"/>',
        'analytics' => '<path d="M4 19V5"/><path d="M4 19h16"/><path d="M8 15v-4"/><path d="M12 15V8"/><path d="M16 15v-7"/><path d="m16 8 2 2 3-4"/>',
        'book' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z"/><path d="M8 7h8"/><path d="M8 11h6"/>',
        'bot' => '<rect x="5" y="8" width="14" height="10" rx="2"/><path d="M12 8V4"/><circle cx="9" cy="13" r="1"/><circle cx="15" cy="13" r="1"/><path d="M9 17h6"/><path d="M8 4h8"/>',
        'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M3 12h18"/>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/><path d="M8 14h4"/><path d="M8 18h8"/>',
        'certificate' => '<circle cx="12" cy="8" r="4"/><path d="M8.5 11 7 22l5-3 5 3-1.5-11"/><path d="m10 8 1.2 1.2L14 6.5"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'cloud' => '<path d="M17.5 19H7a5 5 0 1 1 1.5-9.8A6.5 6.5 0 0 1 21 12.5 3.5 3.5 0 0 1 17.5 19z"/>',
        'coins' => '<ellipse cx="8" cy="6" rx="5" ry="3"/><path d="M3 6v6c0 1.7 2.2 3 5 3s5-1.3 5-3V6"/><path d="M13 10c2.8 0 5 1.3 5 3s-2.2 3-5 3"/><path d="M18 13v5c0 1.7-2.2 3-5 3-2.1 0-3.9-.8-4.6-2"/>',
        'database' => '<ellipse cx="12" cy="5" rx="7" ry="3"/><path d="M5 5v14c0 1.7 3.1 3 7 3s7-1.3 7-3V5"/><path d="M5 12c0 1.7 3.1 3 7 3s7-1.3 7-3"/>',
        'dollar' => '<path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>',
        'exam' => '<path d="M8 3h8l4 4v14H4V3h4z"/><path d="M16 3v5h5"/><path d="M8 12h8"/><path d="M8 16h4"/><path d="m15 17 1.2 1.2L19 15"/>',
        'gift' => '<rect x="3" y="8" width="18" height="13" rx="2"/><path d="M12 8v13"/><path d="M3 12h18"/><path d="M7.5 8a2.5 2.5 0 1 1 4.5-1.5V8"/><path d="M16.5 8a2.5 2.5 0 1 0-4.5-1.5V8"/>',
        'gear' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.2a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8 1.7 1.7 0 0 0 1.5 1h.2a2 2 0 1 1 0 4h-.2a1.7 1.7 0 0 0-1.4 1z"/>',
        'globe' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 0 20"/><path d="M12 2a15.3 15.3 0 0 0 0 20"/>',
        'graduation' => '<path d="m22 10-10-5-10 5 10 5 10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/><path d="M22 10v6"/>',
        'handshake' => '<path d="m11 17 2 2a3 3 0 0 0 4.2 0l3.8-3.8a3 3 0 0 0 0-4.2l-3-3-6 6"/><path d="m2 12 6-6 4 4"/><path d="m7 17-5-5"/><path d="m17 7 5 5"/>',
        'headset' => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M4 13v3a2 2 0 0 0 2 2h1v-7H6a2 2 0 0 0-2 2z"/><path d="M20 13v3a2 2 0 0 1-2 2h-1v-7h1a2 2 0 0 1 2 2z"/><path d="M14 20h-4"/>',
        'laptop' => '<rect x="5" y="4" width="14" height="11" rx="2"/><path d="M3 20h18"/><path d="M8 15h8"/>',
        'library' => '<path d="M4 19h16"/><path d="M6 17V7"/><path d="M10 17V5"/><path d="M14 17V7"/><path d="M18 17V5"/><path d="M4 7h16"/><path d="M4 5h16"/>',
        'lock' => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/><path d="M12 15v2"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'map-pin' => '<path d="M12 21s7-5.2 7-12A7 7 0 1 0 5 9c0 6.8 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/>',
        'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.4 2.1L8 9.7a16 16 0 0 0 6.3 6.3l1.3-1.3a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2z"/>',
        'rocket' => '<path d="M4.5 16.5c-1.5 1.3-2 3.7-2 5 1.3 0 3.7-.5 5-2"/><path d="M9 15 6 18"/><path d="M15 9 9 15"/><path d="M15 9c2-4 5-6 7-7 0 2-3 5-7 7z"/><path d="M14 10l4 4"/><path d="M9 15l-1-4 4 1"/>',
        'school' => '<path d="M3 21h18"/><path d="M5 21V9l7-4 7 4v12"/><path d="M9 21v-6h6v6"/><path d="M8 11h2"/><path d="M14 11h2"/>',
        'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-5"/>',
        'star' => '<path d="m12 2 3 6 6.6 1-4.8 4.6 1.2 6.4-6-3.2-6 3.2 1.2-6.4L2.4 9 9 8z"/>',
        'teacher' => '<path d="M3 4h18v12H3z"/><path d="M8 21h8"/><path d="M12 16v5"/><circle cx="8" cy="10" r="2"/><path d="M12 12h5"/><path d="M12 8h5"/>',
        'training' => '<rect x="4" y="5" width="16" height="12" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/><path d="m10 9 4 3-4 3z"/>',
        'upload' => '<path d="M12 3v12"/><path d="m7 8 5-5 5 5"/><path d="M5 21h14"/>',
        'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/>',
        'video' => '<rect x="3" y="5" width="14" height="14" rx="2"/><path d="m17 9 4-2v10l-4-2z"/>',
    ];

    if (!isset($icons[$name])) {
        return '';
    }

    return '<span class="ai-design-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $icons[$name] . '</svg></span>';
}

function ai_old($name, $default = '') {
    $value = $_POST[$name] ?? $default;
    return is_array($value) ? '' : ai_h($value);
}

function ai_is_checked($name, $value) {
    $current = $_POST[$name] ?? [];
    if (!is_array($current)) {
        $current = [$current];
    }
    return in_array($value, $current, true) ? 'checked' : '';
}

function ai_options($options, $selected = '') {
    foreach ($options as $value => $label) {
        $optionValue = is_int($value) ? $label : $value;
        $isSelected = ((string) $optionValue === (string) $selected) ? 'selected' : '';
        echo '<option value="' . ai_h($optionValue) . '" ' . $isSelected . '>' . ai_h($label) . '</option>';
    }
}

function ai_ensure_submission_table($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS sbci_ai_submissions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            form_type VARCHAR(80) NOT NULL,
            full_name VARCHAR(255),
            email VARCHAR(255),
            phone VARCHAR(80),
            payload LONGTEXT NOT NULL,
            uploaded_files LONGTEXT,
            status VARCHAR(40) DEFAULT 'new',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
}

function ai_sanitize_upload_name($name) {
    $name = preg_replace('/[^A-Za-z0-9._-]/', '_', $name);
    return trim($name, '._') ?: 'upload';
}

function ai_handle_uploads($formType, $uploadFields) {
    if (!$uploadFields) {
        return [true, []];
    }

    $saved = [];
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'mp4', 'mov'];
    $maxBytes = 25 * 1024 * 1024;

    foreach ($uploadFields as $fieldName => $label) {
        if (empty($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            continue;
        }

        $file = $_FILES[$fieldName];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return [false, "Upload failed for {$label}. Please try again."];
        }

        if ($file['size'] > $maxBytes) {
            return [false, "{$label} must be 25MB or smaller."];
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowed, true)) {
            return [false, "{$label} uses an unsupported file type."];
        }

        $safeName = ai_sanitize_upload_name(pathinfo($file['name'], PATHINFO_FILENAME));
        $fileName = sprintf('ai_%s_%s_%s.%s', $formType, date('YmdHis'), uniqid($safeName . '_'), $extension);
        $target = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            return [false, "Could not save {$label}. Please contact support."];
        }

        $saved[$fieldName] = 'uploads/' . $fileName;
    }

    return [true, $saved];
}

function ai_collect_payload() {
    $payload = [];
    foreach ($_POST as $key => $value) {
        if ($key === 'ai_form_type') {
            continue;
        }
        $payload[$key] = $value;
    }
    return $payload;
}

function ai_form_label($formType) {
    $labels = [
        'student' => 'Student Registration',
        'teacher' => 'Teacher Registration',
        'institution' => 'University / School Registration',
        'sponsor' => 'Teacher Course Sponsorship',
        'partner' => 'SBCI AI Partner / Referral',
    ];
    return $labels[$formType] ?? 'SBCI AI Registration';
}

function ai_handle_submission($pdo, $formType, $requiredFields, $uploadFields = []) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['ai_form_type'] ?? '') !== $formType) {
        return null;
    }

    foreach ($requiredFields as $field => $label) {
        $value = $_POST[$field] ?? '';
        if (is_array($value)) {
            $value = implode('', $value);
        }
        if (trim((string) $value) === '') {
            return ['status' => 'error', 'message' => "{$label} is required."];
        }
    }

    $emailToValidate = $_POST['email_address'] ?? $_POST['official_email'] ?? '';
    if (!empty($emailToValidate) && !filter_var($emailToValidate, FILTER_VALIDATE_EMAIL)) {
        return ['status' => 'error', 'message' => 'Please enter a valid email address.'];
    }

    [$uploadOk, $uploadResult] = ai_handle_uploads($formType, $uploadFields);
    if (!$uploadOk) {
        return ['status' => 'error', 'message' => $uploadResult];
    }

    $payload = ai_collect_payload();
    if ($uploadResult) {
        $payload['uploaded_files'] = $uploadResult;
    }

    $name = $_POST['full_name'] ?? $_POST['institution_name'] ?? $_POST['organization_name'] ?? 'SBCI AI Applicant';
    $email = $_POST['email_address'] ?? $_POST['official_email'] ?? '';
    $phone = $_POST['whatsapp_number'] ?? $_POST['official_mobile'] ?? $_POST['phone_number'] ?? '';

    try {
        ai_ensure_submission_table($pdo);
        $stmt = $pdo->prepare("
            INSERT INTO sbci_ai_submissions (form_type, full_name, email, phone, payload, uploaded_files)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $formType,
            trim((string) $name),
            trim((string) $email),
            trim((string) $phone),
            json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            json_encode($uploadResult, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);

        $subject = 'New SBCI AI ' . ai_form_label($formType) . ' Submission';
        $mailBody = "A new SBCI AI submission was received.\n\n" .
            "Form: " . ai_form_label($formType) . "\n" .
            "Name: " . trim((string) $name) . "\n" .
            "Email: " . trim((string) $email) . "\n" .
            "Phone: " . trim((string) $phone) . "\n";
        @mail('info@sbciglobal.com', $subject, $mailBody, "From: noreply@sbciglobal.com\r\n");

        $_POST = [];
        return ['status' => 'success', 'message' => 'Thank you. Your SBCI AI request has been submitted successfully. Our team will contact you shortly.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'We could not save your request right now. Please contact info@sbciglobal.com.'];
    }
}

function ai_alert($result) {
    if (!$result) {
        return;
    }
    $class = $result['status'] === 'success' ? 'ai-alert ai-alert-success' : 'ai-alert ai-alert-error';
    echo '<div class="' . $class . '">' . ai_h($result['message']) . '</div>';
}

function ai_render_head($title) {
    echo '<meta charset="UTF-8">' . "\n";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    echo '<title>' . ai_h($title) . '</title>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">' . "\n";
    echo '<link rel="stylesheet" href="sbci_ai.css">' . "\n";
}

function ai_render_nav($active = '') {
    ?>
    <header class="ai-nav">
        <a href="sbciai.php" class="ai-brand" aria-label="SBCI AI Home">
            <img src="assets/f1eeeaa9-3e7a-4138-923b-bb59988e5f9c.jpg" alt="SBCI AI Logo">
            <span>SBCI <strong>AI</strong></span>
        </a>
        <button class="ai-nav-toggle" type="button" aria-label="Open navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <nav class="ai-nav-links">
            <a href="index.php" class="<?php echo $active === 'home' ? 'active' : ''; ?>">Home</a>
            <a href="sbciai.php" class="<?php echo $active === 'ai' ? 'active' : ''; ?>">SBCI AI</a>
            <a href="sbciai.php#ecosystem">Ecosystem</a>
            <a href="sbciai.php#packages">Packages</a>
            <a href="sbciairegistration.php#comparison">Plans</a>

            <!-- Registration Dropdown -->
            <div class="ai-dropdown <?php echo in_array($active, ['registration', 'sponsor', 'partner'], true) ? 'active' : ''; ?>">
                <span class="ai-dropdown-toggle">Registration <span class="ai-arrow">&#9662;</span></span>
                <div class="ai-dropdown-menu">
                    <a href="sbciaistudentregistration.php" class="<?php echo $active === 'registration' && basename($_SERVER['PHP_SELF']) === 'sbciaistudentregistration.php' ? 'active' : ''; ?>">Student Portal</a>
                    <a href="sbciteacherregistration.php" class="<?php echo $active === 'registration' && basename($_SERVER['PHP_SELF']) === 'sbciteacherregistration.php' ? 'active' : ''; ?>">Teacher Portal</a>
                    <a href="universityschoolregistration.php" class="<?php echo $active === 'registration' && basename($_SERVER['PHP_SELF']) === 'universityschoolregistration.php' ? 'active' : ''; ?>">University/School Portal</a>
                    <a href="sbciaisponsor.php" class="<?php echo $active === 'sponsor' ? 'active' : ''; ?>">Sponsorship Form</a>
                    <a href="sbciaipartner.php" class="<?php echo $active === 'partner' ? 'active' : ''; ?>">Partner Form</a>
                </div>
            </div>

            <a class="ai-nav-whatsapp" href="https://wa.me/971506264883" target="_blank" rel="noopener">WhatsApp</a>
        </nav>
    </header>
    <?php
}

function ai_render_footer() {
    ?>
    <footer id="contact" style="background-color: #111822; padding-top: 60px; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; position: relative; overflow: hidden;">
        <div class="container" style="display: flex; gap: 50px; flex-wrap: wrap; align-items: flex-start; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            
            <!-- Left: Logo & Description -->
            <div style="flex: 0 0 35%; display: flex; flex-direction: column; padding-right: 50px; border-right: 1px solid #2a3845;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <img src="assets/logo.png" alt="SBCI Shield Logo" style="width: 160px; margin: 0 auto; display: block;">
                </div>
                <p style="color: #b0b8c1; font-size: 15px; line-height: 1.7; margin: 0;">
                    SBCI Global helps businesses launch smarter and scale faster through expert consulting, setup, and digital solutions. Let's build your success story together.
                </p>
            </div>

            <!-- Right: Contact Grid & QR -->
            <div style="flex: 1; position: relative;">
                <!-- Dot Pattern Background -->
                <div style="position: absolute; top: 0; right: 0; width: 250px; height: 100%; background-image: radial-gradient(circle, #2fb0ba 1.5px, transparent 1.5px); background-size: 24px 24px; opacity: 0.15; pointer-events: none;"></div>
                
                <h4 style="color: #fff; font-size: 13px; font-weight: 700; margin-bottom: 30px; letter-spacing: 1px; text-transform: uppercase;">Let's connect</h4>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px; position: relative; z-index: 1;">
                    <!-- UAE OFFICE -->
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="background-color: #2fb0ba; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h5 style="color: #2fb0ba; font-size: 13px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 0.5px;">UAE OFFICE</h5>
                            <p style="color: #b0b8c1; font-size: 14px; margin: 0;">Rakez Compass UAE | RAK</p>
                        </div>
                    </div>

                    <!-- UAE CONTACT -->
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="background-color: #2fb0ba; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h5 style="color: #2fb0ba; font-size: 13px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 0.5px;">UAE CONTACT</h5>
                            <a href="tel:+971506264883" style="color: #b0b8c1; font-size: 14px; text-decoration: underline;">+971 50 626 4883</a>
                        </div>
                    </div>

                    <!-- EGYPT OFFICE -->
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="background-color: #2fb0ba; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h5 style="color: #2fb0ba; font-size: 13px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 0.5px;">EGYPT OFFICE</h5>
                            <p style="color: #b0b8c1; font-size: 14px; margin: 0;">SkyMall Co Work Space Mirror</p>
                        </div>
                    </div>

                    <!-- EGYPT CONTACT -->
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="background-color: #2fb0ba; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h5 style="color: #2fb0ba; font-size: 13px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 0.5px;">EGYPT CONTACT</h5>
                            <a href="tel:+201222640202" style="color: #b0b8c1; font-size: 14px; text-decoration: underline;">+20 12 22 64 02 02</a>
                        </div>
                    </div>
                </div>

                <!-- Divider Line -->
                <div style="border-top: 1px solid #2a3845; margin-bottom: 30px;"></div>

                <!-- QR Section -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="background-color: #2fb0ba; padding: 6px; border-radius: 10px;">
                        <img src="assets/qr_scan.png" alt="QR Code" style="width: 80px; height: 80px; display: block; border-radius: 6px; background: white; padding: 4px;">
                    </div>
                    <div>
                        <h5 style="color: #fff; font-size: 16px; font-weight: 700; margin: 0 0 10px 0;">Join our success stories.</h5>
                        <p style="color: #b0b8c1; font-size: 14px; margin: 0;">Contact us for free consultation with our experts.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Strip -->
        <div style="border-top: 1px solid #2a3845; padding: 25px 0; margin-top: 60px;">
            <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center; gap: 20px;">
                <div style="display: flex; gap: 30px; color: #b0b8c1; font-size: 12px; font-weight: 600; letter-spacing: 0.5px;">
                    <span>AUTHORIZED BUSINESS PARTNER</span>
                    <span>GLOBAL PRESENCE LOCAL EXPERTISE</span>
                    <span>TRUSTED BY ENTREPRENEURS</span>
                </div>
                <div style="display: flex; gap: 30px; color: #b0b8c1; font-size: 12px;">
                    <span>&copy; 2025 SBCI Global. All Rights Reserved.</span>
                    <a href="mailto:info@sbciglobal.com" style="color: #b0b8c1; text-decoration: underline;">info@sbciglobal.com</a>
                </div>
            </div>
        </div>
    </footer>
    <?php
}

function ai_render_ai_footer() {
    ai_render_footer();
    return;
    ?>
    <footer class="ai-footer">
        <div class="ai-footer-main" style="border-bottom: none; padding-bottom: 20px;">
            <div class="ai-footer-brand" style="border-right: none; display: flex; align-items: center; gap: 15px; flex-wrap: wrap; width: 100%; justify-content: space-between;">
                <a href="sbciai.php" class="ai-brand" aria-label="SBCI AI Home" style="text-decoration: none; color: inherit;">
                    <img src="assets/f1eeeaa9-3e7a-4138-923b-bb59988e5f9c.jpg" alt="SBCI AI Logo" style="width: clamp(50px, 8vw, 64px); height: auto; border-radius: 8px;">
                    <span style="font-size: 22px; font-weight: 800; white-space: nowrap;">SBCI <strong style="color: var(--ai-orange);">AI</strong></span>
                </a>
                <p style="margin: 0; color: var(--ai-muted); font-size: 14px; max-width: 600px;">SMART LEARNING. UNLIMITED CONNECTIONS.</p>
            </div>
        </div>

        <div class="ai-footer-bottom" style="border-top: 1px solid rgba(47, 176, 186, 0.35); padding: 26px clamp(16px, 4vw, 56px); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; color: #cbd1e6; font-size: 13px;">
            <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <span style="color: var(--ai-teal); font-weight: bold;">✓</span> Trusted by Educators Worldwide
                </span>
                <span style="display: flex; align-items: center; gap: 8px;">
                    <span style="color: var(--ai-teal); font-weight: bold;">✓</span> AI-Powered Smarter Education
                </span>
                <span style="display: flex; align-items: center; gap: 8px;">
                    <span style="color: var(--ai-teal); font-weight: bold;">✓</span> Global Community Connecting Minds
                </span>
            </div>
            <div style="display: flex; gap: 20px; font-weight: bold;">
                <a href="https://www.sbciglobal.com" target="_blank" rel="noopener" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                    <span style="color: var(--ai-teal);">🌐</span> www.sbciglobal.com
                </a>
                <a href="mailto:support@sbciglobal.com" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                    <span style="color: var(--ai-teal);">✉</span> support@sbciglobal.com
                </a>
            </div>
        </div>
    </footer>
    <?php
}

function ai_render_scripts() {
    ?>
    <script>
        const aiToggle = document.querySelector('.ai-nav-toggle');
        const aiNav = document.querySelector('.ai-nav-links');
        if (aiToggle && aiNav) {
            aiToggle.addEventListener('click', () => {
                const isOpen = aiNav.classList.toggle('open');
                aiToggle.classList.toggle('active', isOpen);
                aiToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        document.querySelectorAll('.ai-nav-links a').forEach((link) => {
            link.addEventListener('click', () => {
                aiNav?.classList.remove('open');
                aiToggle?.classList.remove('active');
                aiToggle?.setAttribute('aria-expanded', 'false');
            });
        });

        document.querySelectorAll('[data-plan-currency]').forEach((currencyBlock) => {
            const currencyInputs = currencyBlock.querySelectorAll('input[name="plan_currency"]');
            const planInputs = currencyBlock.querySelectorAll('input[data-plan-name]');
            if (!currencyInputs.length || !planInputs.length) {
                return;
            }

            const updatePlanPrices = () => {
                const checkedCurrency = currencyBlock.querySelector('input[name="plan_currency"]:checked');
                const currency = checkedCurrency ? checkedCurrency.value : 'EGP';
                const priceKey = currency === 'USD' ? 'priceUsd' : 'priceEgp';

                planInputs.forEach((input) => {
                    const price = input.dataset[priceKey];
                    if (!price) {
                        return;
                    }

                    input.value = `${input.dataset.planName} - ${price} ${currency} / Month`;

                    const option = input.closest('.ai-plan-option');
                    option?.querySelector('[data-plan-price]')?.replaceChildren(document.createTextNode(price));
                    option?.querySelector('[data-plan-unit]')?.replaceChildren(document.createTextNode(`${currency} / Month`));
                });
            };

            currencyInputs.forEach((input) => {
                input.addEventListener('change', updatePlanPrices);
            });
            updatePlanPrices();
        });
    </script>
    <?php
}
?>
