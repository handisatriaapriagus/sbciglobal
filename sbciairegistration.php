<?php
require_once 'sbci_ai_common.php';

function ai_registration_card($href, $icon, $title, $items, $button) {
    ?>
    <article class="ai-brochure-card">
        <h3 class="ai-card-heading small"><?php echo ai_icon($icon); ?> <?php echo ai_h($title); ?></h3>
        <?php
        echo '<ul class="ai-list design">';
        foreach ($items as $item) {
            echo '<li>' . ai_h($item) . '</li>';
        }
        echo '</ul>';
        ?>
        <a class="ai-button" href="<?php echo ai_h($href); ?>" style="margin-top: 18px;"><?php echo ai_h($button); ?></a>
    </article>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Registration | Choose Your Portal'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('registration'); ?>

<main class="ai-brochure-hero">
    <div class="ai-brochure-container">
        <div class="ai-logo-wordmark">
            <span class="ai-logo-mark">∞</span>
            <span>SBCI <span class="ai-text-gradient">AI</span><small>SMART LEARNING. UNLIMITED CONNECTIONS.</small></span>
        </div>
        <h1 class="ai-brochure-title medium">Start Your Smart<br><span class="ai-text-gradient">Education Journey<br>Today</span></h1>
        <p class="ai-brochure-subtitle">AI-Powered Platform for Students, Teachers & Universities</p>
        <div class="ai-chip-line">
            <?php foreach ([['clock','1 Month Free Access'], ['gift','Free Demo'], ['dollar','Cashback Up To 20%'], ['shield','Free Sponsorship for Teacher Courses'], ['globe','International Community']] as $chip): ?>
                <span class="ai-pill"><?php echo ai_icon($chip[0]); ?><?php echo ai_h($chip[1]); ?></span>
            <?php endforeach; ?>
        </div>
        <span class="ai-section-label">Choose Your Registration Type</span>
        <div class="ai-feature-grid six">
            <?php foreach ([['graduation','Student'], ['users','Teacher / Instructor'], ['school','School'], ['library','University'], ['training','Training Center'], ['laptop','Online Academy']] as $item): ?>
                <div class="ai-feature-tile row"><?php echo ai_icon($item[0]); ?><strong><?php echo ai_h($item[1]); ?></strong></div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <div class="ai-grid three">
            <?php
            ai_registration_card('sbciaistudentregistration.php', 'graduation', 'Student Registration', [
                'Personal Information',
                'Academic Information',
                'Learning Interests',
                'Which Features Interest You Most?',
                'Choose Your Student Plan',
                '1 Month Free Trial',
                'Free AI Demo Session',
                'Cashback Up To 20%',
                'Priority Access To Workshops',
            ], 'Register as Student');

            ai_registration_card('sbciteacherregistration.php', 'teacher', 'Teacher Registration', [
                'Teacher Information',
                'Professional Interests',
                'Teacher Marketplace & Sponsorship',
                'Choose Your Teacher Plan',
                'Free Demo Access',
                'Cashback Up To 20%',
                'Free International Promotion',
                'Access To Marketplace',
                'AI Teaching Assistant',
            ], 'Register as Teacher');

            ai_registration_card('universityschoolregistration.php', 'library', 'University / School Registration', [
                'Institution Information',
                'Interested Solutions',
                'Partnership Options',
                'Send Your Request',
                'Free Platform Demo',
                '1 Month Trial Access',
                'Free Consultation Session',
                'AI Transformation Roadmap',
                'Partnership & Global Opportunities',
            ], 'Register Institution');
            ?>
        </div>

        <div class="ai-action-panel" style="margin-top: 22px;">
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Choose Your Perfect Package</h3>
                <p class="ai-brochure-copy">All plans include 1 Month Free Access & Free Demo</p>
                <?php
                echo '<ul class="ai-list design">';
                foreach (['Basic 250 EGP / Month', 'Advance 450 EGP / Month', 'Pro 750 EGP / Month', 'Teacher Basic 500 EGP / Month', 'Teacher Pro 900 EGP / Month', 'Institution Custom Contact Us'] as $item) {
                    echo '<li>' . ai_h($item) . '</li>';
                }
                echo '</ul>';
                ?>
                <a href="#comparison" class="ai-button secondary" style="margin-top: 18px;">View Full Comparison</a>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Referral & Cashback Program</h3>
                <p class="ai-brochure-copy">Invite. Earn. Grow Together!</p>
                <div class="ai-feature-grid three">
                    <div class="ai-feature-tile"><?php echo ai_icon('users'); ?><strong>Refer Students</strong></div>
                    <div class="ai-feature-tile"><?php echo ai_icon('teacher'); ?><strong>Refer Teachers</strong></div>
                    <div class="ai-feature-tile"><?php echo ai_icon('library'); ?><strong>Refer Institutions</strong></div>
                </div>
                <p class="ai-brochure-subtitle">Earn Cashback Up To 20% On Every Successful Referral</p>
                <a href="sbciaipartner.php" class="ai-button" style="margin-top: 18px;">Learn More</a>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Teacher Course Sponsorship</h3>
                <p class="ai-brochure-copy">Get Free Sponsorship & Global Visibility</p>
                <?php
                echo '<ul class="ai-list design">';
                foreach (['Free Course Sponsorship', 'International Exposure', 'Marketing & Promotion Support', 'Access To Global Students', 'AI Tools & Content Support'] as $item) {
                    echo '<li>' . ai_h($item) . '</li>';
                }
                echo '</ul>';
                ?>
                <a href="sbciaisponsor.php" class="ai-button" style="margin-top: 18px;">Apply for Sponsorship</a>
            </article>
        </div>

        <div class="ai-action-panel" style="margin-top: 22px;">
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">International Community</h3>
                <p class="ai-brochure-copy">Connect. Collaborate & Learn Globally.</p>
                <div class="ai-metric-strip" style="grid-template-columns: repeat(4, minmax(0,1fr));">
                    <div class="ai-metric"><?php echo ai_icon('teacher'); ?><span><strong>10K+</strong>Teachers</span></div>
                    <div class="ai-metric"><?php echo ai_icon('users'); ?><span><strong>500K+</strong>Students</span></div>
                    <div class="ai-metric"><?php echo ai_icon('globe'); ?><span><strong>100+</strong>Countries</span></div>
                    <div class="ai-metric"><?php echo ai_icon('library'); ?><span><strong>1000+</strong>Institutions</span></div>
                </div>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">One Platform. Endless Possibilities.</h3>
                <p class="ai-brochure-copy">Empowering Egypt's Education, Today & Tomorrow.</p>
                <a href="sbciaistudentregistration.php" class="ai-button">Register Now<br><small>Get 1 Month Free Access</small></a>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Special Welcome Gift</h3>
                <p class="ai-brochure-subtitle">1 Month Free Access Voucher</p>
                <p class="ai-brochure-copy">For All New Registrations</p>
            </article>
        </div>
    </div>
</section>

<section class="ai-brochure-section" id="comparison">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Choose the Perfect Plan <span class="ai-text-gradient">For Your Education Journey</span></h2>
        <p class="ai-brochure-subtitle">AI-Powered Platform for Students, Teachers & Institutions</p>
        <div class="ai-comparison design" style="margin-top: 28px;">
            <table>
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Basic</th>
                        <th>Advance</th>
                        <th>Pro</th>
                        <th>Teacher Basic</th>
                        <th>Teacher Pro</th>
                        <th>Smart School</th>
                        <th>Smart University</th>
                        <th>White Label Platform</th>
                        <th>National Partnership</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = [
                        ['AI Learning Assistant', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Smart Study Tools', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Online Courses Access', 'Limited', 'Unlimited', 'Unlimited', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['AI Exam Preparation', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Digital Certificates', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Live Classes', '2 / Month', '4 / Month', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited'],
                        ['Smart Notes & Summaries', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Performance Analytics', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Career & Internship Access', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Community Access', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Mobile App Access', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Cloud Storage', '5 GB', '20 GB', '50 GB', '20 GB', '100 GB', '100 GB+', '200 GB+', '500 GB+', '1 TB+'],
                        ['Priority Support', 'Standard', 'Priority', 'VIP Priority', 'Priority', 'VIP Priority', 'Priority', 'VIP Priority', 'VIP Priority', 'Dedicated'],
                        ['Exclusive Content', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['International Workshops', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Cashback Up To 20%', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Free 1 Month Access', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Free Demo Session', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Teacher Course Sponsorship', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['AI Tools & Integrations', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Custom Branding', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['LMS Integration', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Student Analytics', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Teacher Portal', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Parent Portal', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['AI Exam System', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['University ERP Integration', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Dedicated Account Manager', 'no', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes'],
                        ['24/7 Premium Support', 'no', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes'],
                        ['AWS Secure Infrastructure', 'no', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes'],
                        ['International Partnerships', 'no', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes'],
                    ];
                    foreach ($rows as $row):
                    ?>
                    <tr>
                        <td><?php echo ai_h($row[0]); ?></td>
                        <?php for ($i = 1; $i < count($row); $i++): ?>
                            <td><?php echo $row[$i] === 'yes' ? '<span class="ai-check">Yes</span>' : ($row[$i] === 'no' ? '-' : ai_h($row[$i])); ?></td>
                        <?php endfor; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php ai_render_ai_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
