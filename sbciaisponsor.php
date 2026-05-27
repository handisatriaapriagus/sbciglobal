<?php
require_once 'sbci_ai_common.php';

$result = ai_handle_submission(
    $pdo,
    'sponsor',
    [
        'full_name' => 'Full Name',
        'email_address' => 'Email Address',
        'phone_number' => 'Phone / WhatsApp',
        'country' => 'Country',
        'city' => 'City',
        'nationality' => 'Nationality',
        'short_bio' => 'Short Bio',
        'current_profession' => 'Current Profession',
        'subjects_expertise' => 'Subjects / Expertise',
        'teaching_experience' => 'Teaching Experience',
        'highest_qualification' => 'Highest Qualification',
        'course_title' => 'Course Title',
        'course_category' => 'Course Category',
        'course_description' => 'Course Description',
        'course_level' => 'Course Level',
        'course_language' => 'Language',
        'sponsorship_type' => 'Sponsorship Type',
        'sponsorship_help' => 'How will this sponsorship help you?',
        'why_sponsor' => 'Why should we sponsor you?',
        'heard_from' => 'How did you hear about SBCI AI?',
        'future_goals' => 'What are your future goals as an educator?',
        'terms_agreement' => 'Terms agreement',
    ],
    [
        'cv_resume' => 'CV / Resume',
        'course_outline' => 'Course Outline',
        'intro_video' => 'Intro Video',
    ]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Teacher Course Sponsorship'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('sponsor'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/8cdc4aa3-6f80-4a28-a39f-3f18c6494ced.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Teach. Inspire. Impact the world.</p>
        <h1>Apply for Teacher Course <span class="ai-gradient-text">Sponsorship</span></h1>
        <p>Get Sponsored. Go Global. Grow Together with SBCI AI</p>
    </div>
</main>

<section class="ai-form-shell">
    <aside class="ai-form-sidebar">
        <h2>We Sponsor Talented Teachers to Build the Future of Education</h2>
        <p>If you're passionate about teaching and want to reach a global audience, apply now for FREE sponsorship and grow your impact with SBCI AI.</p>
        <h2 style="margin-top: 28px;">Why Get Sponsored By SBCI AI?</h2>
        <ul class="ai-list">
            <li>FREE Course Sponsorship - We cover the promotion, you teach.</li>
            <li>Global Exposure - Reach students worldwide.</li>
            <li>Marketing & Promotion Support - We promote your course across our global network.</li>
            <li>Monetization Opportunities - Earn while you educate.</li>
            <li>AI-Powered Tools & Support - Create smarter, better courses.</li>
            <li>International Certification - Boost your credibility.</li>
            <li>Access to Global Community - Connect, collaborate & grow.</li>
            <li>Priority Listing - Get featured on our platform.</li>
        </ul>
    </aside>

    <div class="ai-form-card">
        <?php ai_alert($result); ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ai_form_type" value="sponsor">
            <div class="ai-form-section">Sponsorship Application Form</div>
            <div class="ai-field full">
                <p style="color: var(--ai-muted); margin: 0;">Please fill out the form below to apply for a course sponsorship.</p>
            </div>
            <div class="ai-form-grid">
                <div class="ai-form-section">1. Personal Information</div>
                <div class="ai-field">
                    <label for="full_name">Full Name *</label>
                    <input id="full_name" name="full_name" type="text" value="<?php echo ai_old('full_name'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="nationality">Nationality *</label>
                    <input id="nationality" name="nationality" type="text" value="<?php echo ai_old('nationality'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="email_address">Email Address *</label>
                    <input id="email_address" name="email_address" type="email" value="<?php echo ai_old('email_address'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="phone_number">Phone / WhatsApp *</label>
                    <input id="phone_number" name="phone_number" type="text" value="<?php echo ai_old('phone_number'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="country">Country *</label>
                    <input id="country" name="country" type="text" value="<?php echo ai_old('country'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="city">City *</label>
                    <input id="city" name="city" type="text" value="<?php echo ai_old('city'); ?>" required>
                </div>
                <div class="ai-field full">
                    <label for="linkedin_profile">LinkedIn Profile (Optional)</label>
                    <input id="linkedin_profile" name="linkedin_profile" type="url" placeholder="https://www.linkedin.com/in/yourprofile" value="<?php echo ai_old('linkedin_profile'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="short_bio">Short Bio *</label>
                    <textarea id="short_bio" name="short_bio" required><?php echo ai_old('short_bio'); ?></textarea>
                </div>

                <div class="ai-form-section">2. Teaching Information</div>
                <div class="ai-field">
                    <label for="current_profession">Current Profession *</label>
                    <input id="current_profession" name="current_profession" type="text" value="<?php echo ai_old('current_profession'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="subjects_expertise">Subjects / Expertise *</label>
                    <input id="subjects_expertise" name="subjects_expertise" type="text" value="<?php echo ai_old('subjects_expertise'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="teaching_experience">Teaching Experience *</label>
                    <select id="teaching_experience" name="teaching_experience" required>
                        <option value="">Select Years</option>
                        <?php ai_options(['0-1 years', '2-4 years', '5-9 years', '10+ years'], $_POST['teaching_experience'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="highest_qualification">Highest Qualification *</label>
                    <select id="highest_qualification" name="highest_qualification" required>
                        <option value="">Select Qualification</option>
                        <?php ai_options(['Bachelor', 'Master', 'PhD', 'Associate Degree', 'Diploma', 'Other'], $_POST['highest_qualification'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field full">
                    <label for="current_institution">Current Institution (If Any)</label>
                    <input id="current_institution" name="current_institution" type="text" value="<?php echo ai_old('current_institution'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="portfolio_url">Website / Portfolio / Social Media (Optional)</label>
                    <input id="portfolio_url" name="portfolio_url" type="url" value="<?php echo ai_old('portfolio_url'); ?>">
                </div>
                <div class="ai-field full">
                    <label for="cv_resume">Upload CV / Resume *</label>
                    <input id="cv_resume" name="cv_resume" type="file" accept=".pdf,.doc,.docx" required>
                </div>

                <div class="ai-form-section">3. Course Information</div>
                <div class="ai-field">
                    <label for="course_title">Course Title *</label>
                    <input id="course_title" name="course_title" type="text" value="<?php echo ai_old('course_title'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="course_category">Course Category *</label>
                    <select id="course_category" name="course_category" required>
                        <option value="">Select Category</option>
                        <?php ai_options(['Business', 'Technology', 'AI', 'Design', 'Marketing', 'Languages', 'Engineering', 'Medical', 'Other'], $_POST['course_category'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field full">
                    <label for="course_description">Course Description *</label>
                    <textarea id="course_description" name="course_description" required><?php echo ai_old('course_description'); ?></textarea>
                </div>
                <div class="ai-field">
                    <label for="course_level">Course Level *</label>
                    <select id="course_level" name="course_level" required>
                        <option value="">Select Level</option>
                        <?php ai_options(['Beginner', 'Intermediate', 'Advanced', 'Professional'], $_POST['course_level'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="course_language">Language *</label>
                    <input id="course_language" name="course_language" type="text" value="<?php echo ai_old('course_language'); ?>" required>
                </div>
                <div class="ai-field full">
                    <label for="course_outline">Upload Course Outline (Optional)</label>
                    <input id="course_outline" name="course_outline" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx">
                </div>

                <div class="ai-form-section">4. Sponsorship Request</div>
                <div class="ai-field full">
                    <p class="ai-choice-title">What type of sponsorship are you applying for? *</p>
                    <div class="ai-choice-grid">
                        <?php foreach (['Full Course Sponsorship', 'Partial Sponsorship', 'Marketing & Promotion Support', 'International Promotion', 'Other'] as $type): ?>
                            <label class="ai-check-card"><input type="radio" name="sponsorship_type" value="<?php echo ai_h($type); ?>" required <?php echo ai_is_checked('sponsorship_type', $type); ?>><?php echo ai_h($type); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="ai-field full">
                    <label for="sponsorship_help">How will this sponsorship help you? *</label>
                    <textarea id="sponsorship_help" name="sponsorship_help" required><?php echo ai_old('sponsorship_help'); ?></textarea>
                </div>
                <div class="ai-field full">
                    <p class="ai-choice-title">Have you created online courses before?</p>
                    <div class="ai-choice-grid">
                        <label class="ai-check-card"><input type="radio" name="created_courses_before" value="Yes" <?php echo ai_is_checked('created_courses_before', 'Yes'); ?>>Yes</label>
                        <label class="ai-check-card"><input type="radio" name="created_courses_before" value="No" <?php echo ai_is_checked('created_courses_before', 'No'); ?>>No</label>
                    </div>
                </div>
                <div class="ai-field full">
                    <label for="why_sponsor">Why should we sponsor you? *</label>
                    <textarea id="why_sponsor" name="why_sponsor" required><?php echo ai_old('why_sponsor'); ?></textarea>
                </div>

                <div class="ai-form-section">5. Additional Information</div>
                <div class="ai-field">
                    <label for="heard_from">How did you hear about SBCI AI? *</label>
                    <select id="heard_from" name="heard_from" required>
                        <option value="">Select an Option</option>
                        <?php ai_options(['Social Media', 'Referral', 'University', 'SBCI Team', 'Event', 'Website Search', 'Other'], $_POST['heard_from'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="intro_video">Upload Intro Video (Optional)</label>
                    <input id="intro_video" name="intro_video" type="file" accept=".mp4,.mov">
                </div>
                <div class="ai-field full">
                    <label for="future_goals">What are your future goals as an educator? *</label>
                    <textarea id="future_goals" name="future_goals" required><?php echo ai_old('future_goals'); ?></textarea>
                </div>
                <div class="ai-field full">
                    <label class="ai-check-card"><input type="checkbox" name="terms_agreement" value="Agreed" required <?php echo ai_is_checked('terms_agreement', 'Agreed'); ?>>I agree to the Terms & Conditions and Privacy Policy of SBCI AI *</label>
                </div>
                <div class="ai-submit-row">
                    <a href="sbciairegistration.php" class="ai-button secondary">Back to Portals</a>
                    <button class="ai-button" type="submit">Submit Your Application</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="ai-section ai-alt">
    <div class="ai-container ai-grid three">
        <article class="ai-card"><h3>Our Sponsorship Selection Process</h3><p>Application Submission, Review & Evaluation, Shortlisted Candidates, Interview / Discussion, Final Selection, Sponsorship Onboarding, Course Launch & Promotion.</p></article>
        <article class="ai-card warm"><h3>Sponsorship Benefits</h3><p>100% Free Course Sponsorship, Global Visibility & Student Reach, Professional Marketing & Support, Monetization & Revenue Sharing, AI Tools & Course Creation Support, International Certification & Recognition.</p></article>
        <article class="ai-card"><h3>Refer & Earn</h3><p>Refer more teachers and earn cashback up to 20% on success!</p></article>
    </div>
</section>

<?php ai_render_ai_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
