<?php
require_once 'db.php';

function ai_h($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
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
    $items = [
        ['Home', 'index.php', 'home'],
        ['SBCI AI', 'sbciai.php', 'ai'],
        ['Ecosystem', 'sbciai.php#ecosystem', 'ecosystem'],
        ['Packages', 'sbciai.php#packages', 'packages'],
        ['Plans', 'sbciairegistration.php#comparison', 'plans'],
        ['Registration', 'sbciairegistration.php', 'registration'],
        ['Sponsorship', 'sbciaisponsor.php', 'sponsor'],
        ['Partner', 'sbciaipartner.php', 'partner'],
    ];
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
            <?php foreach ($items as $item): ?>
                <a href="<?php echo ai_h($item[1]); ?>" class="<?php echo $active === $item[2] ? 'active' : ''; ?>"><?php echo ai_h($item[0]); ?></a>
            <?php endforeach; ?>
            <a class="ai-nav-whatsapp" href="https://wa.me/971506264883" target="_blank" rel="noopener">WhatsApp</a>
        </nav>
    </header>
    <?php
}

function ai_render_footer() {
    ?>
    <footer class="ai-footer">
        <div class="ai-footer-main">
            <div class="ai-footer-brand">
                <img src="assets/logo.png" alt="SBCI Global">
                <p>SBCI Global helps businesses and education communities launch smarter and scale faster through expert consulting, setup, and digital solutions.</p>
            </div>
            <div class="ai-footer-connect">
                <p class="ai-section-kicker">Let's Connect</p>
                <div class="ai-contact-grid">
                    <div class="ai-contact-item">
                        <span class="ai-contact-icon">PIN</span>
                        <div>
                            <strong>UAE Office</strong>
                            <p>Rakez Compass UAE | RAK</p>
                        </div>
                    </div>
                    <div class="ai-contact-item">
                        <span class="ai-contact-icon">TEL</span>
                        <div>
                            <strong>UAE Contact</strong>
                            <p><a href="tel:+971506264883">+971 50 626 4883</a></p>
                        </div>
                    </div>
                    <div class="ai-contact-item">
                        <span class="ai-contact-icon">PIN</span>
                        <div>
                            <strong>Egypt Office</strong>
                            <p>SkyMall Co Work Space Mirror</p>
                        </div>
                    </div>
                    <div class="ai-contact-item">
                        <span class="ai-contact-icon">TEL</span>
                        <div>
                            <strong>Egypt Contact</strong>
                            <p><a href="tel:+201222640202">+20 12 22 64 02 02</a></p>
                        </div>
                    </div>
                </div>
                <div class="ai-footer-cta">
                    <img src="assets/qr_scan.png" alt="Scan to join SBCI Global">
                    <div>
                        <strong>Join our success stories.</strong>
                        <p>Contact us for free consultation with our experts.</p>
                    </div>
                </div>
            </div>
            <div class="ai-footer-map" aria-hidden="true">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
        <div class="ai-footer-bottom">
            <span>Authorized Business Partner</span>
            <span>Global Presence. Local Expertise.</span>
            <span>Trusted by Entrepreneurs</span>
            <span>&copy; 2026 SBCI Global. All Rights Reserved.</span>
            <a href="mailto:info@sbciglobal.com">info@sbciglobal.com</a>
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
