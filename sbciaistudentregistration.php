<?php
require_once 'sbci_ai_common.php';

$result = ai_handle_submission(
    $pdo,
    'student',
    [
        'full_name' => 'Full Name',
        'email_address' => 'Email Address',
        'whatsapp_number' => 'Mobile Number / WhatsApp',
        'school_name' => 'School / University Name',
        'selected_plan' => 'Selected Student Plan',
    ],
    ['student_photo' => 'Student Photo']
);

$studentPlans = [
    ['name' => 'Basic', 'prices' => ['EGP' => '250', 'USD' => '5']],
    ['name' => 'Advance', 'prices' => ['EGP' => '450', 'USD' => '9']],
    ['name' => 'Pro', 'prices' => ['EGP' => '750', 'USD' => '15']],
];
$studentCurrency = strtoupper((string) ($_POST['plan_currency'] ?? ''));
if (!in_array($studentCurrency, ['EGP', 'USD'], true)) {
    $selectedPlan = (string) ($_POST['selected_plan'] ?? '');
    $studentCurrency = stripos($selectedPlan, 'USD') !== false ? 'USD' : 'EGP';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Student Registration'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('registration'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Start your future with AI</p>
        <h1>Student <span class="ai-gradient-text">Registration</span></h1>
        <p>Join thousands of students learning smarter with SBCI AI tools, digital certificates, AI study support, and career opportunities.</p>
    </div>
</main>

<section class="ai-form-shell">
    <aside class="ai-form-sidebar">
        <h2>Student Benefits</h2>
        <ul class="ai-list">
            <li>1 Month free subscription voucher.</li>
            <li>Free AI demo and learning tools.</li>
            <li>Cashback up to 20%.</li>
            <li>Access to premium courses.</li>
            <li>Smart notes and AI assistant.</li>
            <li>International certificates.</li>
            <li>Internships and career support.</li>
        </ul>
    </aside>

    <div class="ai-form-card">
        <?php ai_alert($result); ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ai_form_type" value="student">
            <div class="ai-form-grid">
                <div class="ai-form-section">Personal Information</div>
                <div class="ai-field">
                    <label for="full_name">Full Name *</label>
                    <input id="full_name" name="full_name" type="text" value="<?php echo ai_old('full_name'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="whatsapp_number">Mobile Number / WhatsApp *</label>
                    <input id="whatsapp_number" name="whatsapp_number" type="text" value="<?php echo ai_old('whatsapp_number'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="email_address">Email Address *</label>
                    <input id="email_address" name="email_address" type="email" value="<?php echo ai_old('email_address'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select</option>
                        <?php ai_options(['Male', 'Female', 'Prefer not to say'], $_POST['gender'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="date_of_birth">Date of Birth</label>
                    <input id="date_of_birth" name="date_of_birth" type="date" value="<?php echo ai_old('date_of_birth'); ?>">
                </div>
                <div class="ai-field">
                    <label for="nationality">Nationality</label>
                    <input id="nationality" name="nationality" type="text" value="<?php echo ai_old('nationality'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="city_country">City / Country</label>
                    <input id="city_country" name="city_country" type="text" value="<?php echo ai_old('city_country'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="student_photo">Student Photo Upload</label>
                    <input id="student_photo" name="student_photo" type="file" accept=".jpg,.jpeg,.png">
                </div>

                <div class="ai-form-section">Academic Information</div>
                <div class="ai-field">
                    <label for="school_name">School / University Name *</label>
                    <input id="school_name" name="school_name" type="text" value="<?php echo ai_old('school_name'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="faculty_major">Faculty / Major</label>
                    <input id="faculty_major" name="faculty_major" type="text" value="<?php echo ai_old('faculty_major'); ?>">
                </div>
                <div class="ai-field">
                    <label for="academic_year">Current Academic Year</label>
                    <select id="academic_year" name="academic_year">
                        <option value="">Select</option>
                        <?php ai_options(['High School', 'Year 1', 'Year 2', 'Year 3', 'Year 4', 'Graduate', 'Postgraduate'], $_POST['academic_year'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="student_id">Student ID (Optional)</label>
                    <input id="student_id" name="student_id" type="text" value="<?php echo ai_old('student_id'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="graduation_year">Expected Graduation Year</label>
                    <input id="graduation_year" name="graduation_year" type="text" value="<?php echo ai_old('graduation_year'); ?>">
                </div>

                <div class="ai-form-section">Learning Interests</div>
                <div class="ai-field full">
                    <div class="ai-choice-grid three">
                        <?php foreach (['AI & Technology', 'Business', 'Programming', 'Design', 'Marketing', 'Engineering', 'Languages', 'Medical', 'Other'] as $interest): ?>
                            <label class="ai-check-card"><input type="checkbox" name="learning_interests[]" value="<?php echo ai_h($interest); ?>" <?php echo ai_is_checked('learning_interests', $interest); ?>><?php echo ai_h($interest); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Which features interest you most?</div>
                <div class="ai-field full">
                    <div class="ai-choice-grid">
                        <?php foreach (['AI Learning Assistant', 'Smart Notes & Summaries', 'AI Exam Preparation', 'Online Courses', 'International Certificates', 'Internship Opportunities', 'AI Research Tools', 'Video Classes', 'Career Development'] as $feature): ?>
                            <label class="ai-check-card"><input type="checkbox" name="feature_interests[]" value="<?php echo ai_h($feature); ?>" <?php echo ai_is_checked('feature_interests', $feature); ?>><?php echo ai_h($feature); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Choose Your Student Plan *</div>
                <div class="ai-field full">
                    <div class="ai-plan-currency-block" data-plan-currency>
                        <div class="ai-plan-toolbar">
                            <span class="ai-choice-title">Currency</span>
                            <div class="ai-currency-toggle" role="radiogroup" aria-label="Student plan currency">
                                <?php foreach (['EGP', 'USD'] as $currency): ?>
                                    <label>
                                        <input type="radio" name="plan_currency" value="<?php echo ai_h($currency); ?>" <?php echo $studentCurrency === $currency ? 'checked' : ''; ?>>
                                        <span><?php echo ai_h($currency); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="ai-plan-picker">
                            <?php foreach ($studentPlans as $index => $plan): ?>
                                <?php
                                    $currentPrice = $plan['prices'][$studentCurrency];
                                    $currentValue = $plan['name'] . ' - ' . $currentPrice . ' ' . $studentCurrency . ' / Month';
                                ?>
                                <label class="ai-plan-option">
                                    <input
                                        type="radio"
                                        name="selected_plan"
                                        value="<?php echo ai_h($currentValue); ?>"
                                        data-plan-name="<?php echo ai_h($plan['name']); ?>"
                                        data-price-egp="<?php echo ai_h($plan['prices']['EGP']); ?>"
                                        data-price-usd="<?php echo ai_h($plan['prices']['USD']); ?>"
                                        <?php echo $index === 0 ? 'required' : ''; ?>
                                        <?php echo ai_is_checked('selected_plan', $currentValue); ?>
                                    >
                                    <span>
                                        <strong><?php echo ai_h($plan['name']); ?></strong>
                                        <b data-plan-price><?php echo ai_h($currentPrice); ?></b>
                                        <small data-plan-unit><?php echo ai_h($studentCurrency); ?> / Month</small>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="ai-submit-row">
                    <a href="sbciairegistration.php" class="ai-button secondary">Back to Portals</a>
                    <button class="ai-button" type="submit">Register as Student</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php ai_render_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
