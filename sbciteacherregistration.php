<?php
require_once 'sbci_ai_common.php';

$result = ai_handle_submission(
    $pdo,
    'teacher',
    [
        'full_name' => 'Full Name',
        'email_address' => 'Email Address',
        'whatsapp_number' => 'Mobile Number / WhatsApp',
        'subjects_courses' => 'Subjects / Courses',
        'selected_plan' => 'Selected Teacher Plan',
    ],
    ['cv_upload' => 'CV Upload']
);

$teacherPlans = [
    ['name' => 'Teacher Basic', 'prices' => ['EGP' => '500', 'USD' => '10']],
    ['name' => 'Teacher Pro', 'prices' => ['EGP' => '900', 'USD' => '17']],
];
$teacherCurrency = strtoupper((string) ($_POST['plan_currency'] ?? ''));
if (!in_array($teacherCurrency, ['EGP', 'USD'], true)) {
    $selectedPlan = (string) ($_POST['selected_plan'] ?? '');
    $teacherCurrency = stripos($selectedPlan, 'USD') !== false ? 'USD' : 'EGP';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Teacher Registration'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('registration'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/bb061704-3018-46e8-af80-467e8f1124aa.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Empower. Teach. Inspire.</p>
        <h1>Teacher <span class="ai-gradient-text">Registration</span></h1>
        <p>Build your teaching brand, reach the world, create courses, and access the SBCI AI teacher marketplace.</p>
    </div>
</main>

<section class="ai-form-shell">
    <aside class="ai-form-sidebar">
        <h2>Teacher Benefits</h2>
        <ul class="ai-list">
            <li>1 Month free subscription voucher.</li>
            <li>Cashback up to 20%.</li>
            <li>Free course sponsorship access.</li>
            <li>International teacher promotion.</li>
            <li>Access to teacher marketplace.</li>
            <li>AI teaching assistant.</li>
            <li>Monetize your knowledge.</li>
        </ul>
    </aside>

    <div class="ai-form-card">
        <?php ai_alert($result); ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ai_form_type" value="teacher">
            <div class="ai-form-grid">
                <div class="ai-form-section">Teacher Information</div>
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
                    <label for="nationality">Nationality</label>
                    <input id="nationality" name="nationality" type="text" value="<?php echo ai_old('nationality'); ?>">
                </div>
                <div class="ai-field">
                    <label for="country">Country</label>
                    <input id="country" name="country" type="text" value="<?php echo ai_old('country'); ?>">
                </div>
                <div class="ai-field">
                    <label for="current_institution">Current Institution</label>
                    <input id="current_institution" name="current_institution" type="text" value="<?php echo ai_old('current_institution'); ?>">
                </div>
                <div class="ai-field">
                    <label for="teaching_experience">Teaching Experience</label>
                    <select id="teaching_experience" name="teaching_experience">
                        <option value="">Select</option>
                        <?php ai_options(['0-1 years', '2-4 years', '5-9 years', '10+ years'], $_POST['teaching_experience'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="subjects_courses">Subjects / Courses *</label>
                    <input id="subjects_courses" name="subjects_courses" type="text" value="<?php echo ai_old('subjects_courses'); ?>" required>
                </div>
                <div class="ai-field full">
                    <label for="linkedin_profile">LinkedIn Profile (Optional)</label>
                    <input id="linkedin_profile" name="linkedin_profile" type="url" value="<?php echo ai_old('linkedin_profile'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="cv_upload">CV Upload</label>
                    <input id="cv_upload" name="cv_upload" type="file" accept=".pdf,.doc,.docx">
                </div>

                <div class="ai-form-section">Professional Interests</div>
                <div class="ai-field full">
                    <div class="ai-choice-grid">
                        <?php foreach (['Create Online Courses', 'Sell Educational Content', 'Build Teaching Brand', 'Create AI Exams', 'Teach Internationally', 'Host Workshops', 'Join Global Community', 'Monetize Materials'] as $interest): ?>
                            <label class="ai-check-card"><input type="checkbox" name="professional_interests[]" value="<?php echo ai_h($interest); ?>" <?php echo ai_is_checked('professional_interests', $interest); ?>><?php echo ai_h($interest); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Teacher Marketplace and Sponsorship</div>
                <div class="ai-field full">
                    <div class="ai-choice-grid">
                        <?php foreach (['Free Course Sponsorship', 'International Teacher Promotion', 'Featured Instructor Program', 'AI Teaching Certification', 'Online Course Marketing', 'Support & Promotion'] as $option): ?>
                            <label class="ai-check-card"><input type="checkbox" name="marketplace_sponsorship[]" value="<?php echo ai_h($option); ?>" <?php echo ai_is_checked('marketplace_sponsorship', $option); ?>><?php echo ai_h($option); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Choose Your Teacher Plan *</div>
                <div class="ai-field full">
                    <div class="ai-plan-currency-block" data-plan-currency>
                        <div class="ai-plan-toolbar">
                            <span class="ai-choice-title">Currency</span>
                            <div class="ai-currency-toggle" role="radiogroup" aria-label="Teacher plan currency">
                                <?php foreach (['EGP', 'USD'] as $currency): ?>
                                    <label>
                                        <input type="radio" name="plan_currency" value="<?php echo ai_h($currency); ?>" <?php echo $teacherCurrency === $currency ? 'checked' : ''; ?>>
                                        <span><?php echo ai_h($currency); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="ai-plan-picker">
                            <?php foreach ($teacherPlans as $index => $plan): ?>
                                <?php
                                    $currentPrice = $plan['prices'][$teacherCurrency];
                                    $currentValue = $plan['name'] . ' - ' . $currentPrice . ' ' . $teacherCurrency . ' / Month';
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
                                        <small data-plan-unit><?php echo ai_h($teacherCurrency); ?> / Month</small>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                            <label class="ai-plan-option">
                                <input type="radio" name="selected_plan" value="Sponsorship Review" <?php echo ai_is_checked('selected_plan', 'Sponsorship Review'); ?>>
                                <span><strong>Sponsorship</strong><b>Apply</b><small>Course support</small></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="ai-submit-row">
                    <a href="sbciaisponsor.php" class="ai-button secondary">Apply for Sponsorship</a>
                    <button class="ai-button" type="submit">Register as Teacher</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php ai_render_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
