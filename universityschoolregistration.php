<?php
require_once 'sbci_ai_common.php';

$result = ai_handle_submission(
    $pdo,
    'institution',
    [
        'institution_name' => 'Institution Name',
        'institution_type' => 'Type of Institution',
        'country_city' => 'Country / City',
        'contact_person' => 'Contact Person',
        'official_email' => 'Official Email',
        'official_mobile' => 'Official Mobile Number',
        'partnership_option' => 'Partnership Option',
    ]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI University / School Registration'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('registration'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/c146f6e7-a7c5-42ec-92db-20844f4134ef.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Build the future of education</p>
        <h1>University / School <span class="ai-gradient-text">Registration</span></h1>
        <p>Transform your institution with AI-powered smart campus, LMS, analytics, cloud security, and global partnership opportunities.</p>
    </div>
</main>

<section class="ai-form-shell">
    <aside class="ai-form-sidebar">
        <h2>Institution Benefits</h2>
        <ul class="ai-list">
            <li>AI smart campus solutions.</li>
            <li>LMS and ERP integration options.</li>
            <li>AI exam and analytics ecosystem.</li>
            <li>Student and teacher portals.</li>
            <li>International partnerships.</li>
            <li>Secure AWS infrastructure.</li>
            <li>AI transformation roadmap.</li>
        </ul>
    </aside>

    <div class="ai-form-card">
        <?php ai_alert($result); ?>
        <form method="POST">
            <input type="hidden" name="ai_form_type" value="institution">
            <div class="ai-form-grid">
                <div class="ai-form-section">Institution Information</div>
                <div class="ai-field full">
                    <label for="institution_name">Institution Name *</label>
                    <input id="institution_name" name="institution_name" type="text" value="<?php echo ai_old('institution_name'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="institution_type">Type of Institution *</label>
                    <select id="institution_type" name="institution_type" required>
                        <option value="">Select</option>
                        <?php ai_options(['University', 'Private School', 'International School', 'Training Center', 'Online Academy', 'Education Group'], $_POST['institution_type'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="country_city">Country / City *</label>
                    <input id="country_city" name="country_city" type="text" value="<?php echo ai_old('country_city'); ?>" required>
                </div>
                <div class="ai-field full">
                    <label for="website">Website</label>
                    <input id="website" name="website" type="url" value="<?php echo ai_old('website'); ?>">
                </div>
                <div class="ai-field">
                    <label for="number_of_students">Number of Students</label>
                    <input id="number_of_students" name="number_of_students" type="text" value="<?php echo ai_old('number_of_students'); ?>">
                </div>
                <div class="ai-field">
                    <label for="number_of_teachers">Number of Teachers</label>
                    <input id="number_of_teachers" name="number_of_teachers" type="text" value="<?php echo ai_old('number_of_teachers'); ?>">
                </div>
                <div class="ai-field">
                    <label for="contact_person">Contact Person *</label>
                    <input id="contact_person" name="contact_person" type="text" value="<?php echo ai_old('contact_person'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="position_designation">Position / Designation</label>
                    <input id="position_designation" name="position_designation" type="text" value="<?php echo ai_old('position_designation'); ?>">
                </div>
                <div class="ai-field">
                    <label for="official_email">Official Email *</label>
                    <input id="official_email" name="official_email" type="email" value="<?php echo ai_old('official_email'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="official_mobile">Official Mobile Number *</label>
                    <input id="official_mobile" name="official_mobile" type="text" value="<?php echo ai_old('official_mobile'); ?>" required>
                </div>

                <div class="ai-form-section">Interested Solutions</div>
                <div class="ai-field full">
                    <div class="ai-choice-grid">
                        <?php foreach (['AI Smart Campus', 'LMS Integration', 'AI Exam System', 'Student Analytics', 'Teacher Portal', 'Parent Portal', 'Online Learning', 'AI Research Assistant', 'University ERP Integration', 'Digital Certificates', 'International Partnerships', 'Other Solutions'] as $solution): ?>
                            <label class="ai-check-card"><input type="checkbox" name="interested_solutions[]" value="<?php echo ai_h($solution); ?>" <?php echo ai_is_checked('interested_solutions', $solution); ?>><?php echo ai_h($solution); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Partnership Options *</div>
                <div class="ai-field full">
                    <div class="ai-plan-picker">
                        <?php foreach (['Smart School Package', 'Smart University Package', 'White Label Platform', 'National Smart Campus Partnership'] as $option): ?>
                            <label class="ai-plan-option">
                                <input type="radio" name="partnership_option" value="<?php echo ai_h($option); ?>" required <?php echo ai_is_checked('partnership_option', $option); ?>>
                                <span><strong><?php echo ai_h($option); ?></strong><b>Custom</b><small>Request review</small></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ai-form-section">Send Your Request</div>
                <div class="ai-field full">
                    <label for="message">Your Message (Optional)</label>
                    <textarea id="message" name="message"><?php echo ai_old('message'); ?></textarea>
                </div>
                <div class="ai-field">
                    <label for="heard_from">How did you hear about us?</label>
                    <select id="heard_from" name="heard_from">
                        <option value="">Select</option>
                        <?php ai_options(['SBCI Team', 'Social Media', 'Referral', 'University Network', 'Event', 'Website Search', 'Other'], $_POST['heard_from'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="preferred_contact">Preferred Contact Method</label>
                    <select id="preferred_contact" name="preferred_contact">
                        <option value="">Select</option>
                        <?php ai_options(['Email', 'WhatsApp', 'Phone Call', 'Video Meeting'], $_POST['preferred_contact'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-submit-row">
                    <a href="sbciairegistration.php" class="ai-button secondary">Back to Portals</a>
                    <button class="ai-button" type="submit">Register Institution</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php ai_render_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
