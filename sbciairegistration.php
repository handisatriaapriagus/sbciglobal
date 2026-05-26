<?php
require_once 'sbci_ai_common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Registration | Choose Your Portal'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('registration'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Start your smart education journey today</p>
        <h1>Choose your <span class="ai-gradient-text">registration portal</span></h1>
        <p>Select the path that fits your role. Each sector has a dedicated form, benefits, and next-step process for the SBCI AI team.</p>
        <div class="ai-pill-row">
            <span class="ai-pill">1 Month Free Access</span>
            <span class="ai-pill">Free Demo</span>
            <span class="ai-pill">Cashback Up To 20%</span>
            <span class="ai-pill">Teacher Sponsorship</span>
            <span class="ai-pill">International Community</span>
        </div>
    </div>
</main>

<section class="ai-section">
    <div class="ai-container">
        <div class="ai-grid three">
            <a class="ai-portal-card" href="sbciaistudentregistration.php" style="--card-image: url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>Student Portal</h3>
                    <p>AI learning assistant, smart study tools, online courses, certificates, career access, and student community.</p>
                </span>
            </a>
            <a class="ai-portal-card" href="sbciteacherregistration.php" style="--card-image: url('assets/bb061704-3018-46e8-af80-467e8f1124aa.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>Teacher Portal</h3>
                    <p>AI exam builder, online teaching hub, course selling system, teacher marketplace, and global promotion.</p>
                </span>
            </a>
            <a class="ai-portal-card" href="universityschoolregistration.php" style="--card-image: url('assets/c146f6e7-a7c5-42ec-92db-20844f4134ef.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>University / School Portal</h3>
                    <p>Smart campus, LMS integration, student analytics, ERP options, and institutional partnership packages.</p>
                </span>
            </a>
            <a class="ai-portal-card" href="sbciaisponsor.php" style="--card-image: url('assets/8cdc4aa3-6f80-4a28-a39f-3f18c6494ced.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>Sponsorship Form</h3>
                    <p>Apply for free course sponsorship, international promotion, marketing support, and course launch visibility.</p>
                </span>
            </a>
            <a class="ai-portal-card" href="sbciaipartner.php" style="--card-image: url('assets/0f395fbe-d33e-4557-b364-80ece7c038b9.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>Partner Form</h3>
                    <p>Refer, earn, and grow with SBCI AI through cashback, agent levels, and partnership opportunities.</p>
                </span>
            </a>
            <a class="ai-portal-card" href="https://wa.me/971506264883" target="_blank" rel="noopener" style="--card-image: url('assets/42cef3e2-de18-4705-854f-8b9767876379.jpg');">
                <span class="media"></span>
                <span class="content">
                    <h3>Need Guidance?</h3>
                    <p>Contact SBCI AI on WhatsApp and our team will help you choose the right path.</p>
                </span>
            </a>
        </div>
    </div>
</section>

<section class="ai-section ai-alt" id="comparison">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Plans comparison</p>
                <h2>Choose the perfect plan for your education journey.</h2>
            </div>
            <p>Student, teacher, and institution plans are structured for different levels of access, support, and growth.</p>
        </div>
        <div class="ai-grid three" style="margin-bottom: 28px;">
            <article class="ai-price-card">
                <h3>Student Plans</h3>
                <div class="ai-price">250-750 <small>EGP / Month<br>5-15 USD / Month</small></div>
                <p>Basic, Advance, and Pro options with AI assistant, study tools, certificates, analytics, and support.</p>
                <a href="sbciaistudentregistration.php" class="ai-button">Register as Student</a>
            </article>
            <article class="ai-price-card">
                <h3>Teacher Plans</h3>
                <div class="ai-price">500-900 <small>EGP / Month<br>10-17 USD / Month</small></div>
                <p>AI teaching tools, course creator support, student management, marketplace access, and promotion.</p>
                <a href="sbciteacherregistration.php" class="ai-button">Register as Teacher</a>
            </article>
            <article class="ai-price-card featured">
                <h3>Institution Plans</h3>
                <div class="ai-price">Custom <small>Solution</small></div>
                <p>Smart school, smart university, white label platform, and national smart campus partnership.</p>
                <a href="universityschoolregistration.php" class="ai-button">Register Institution</a>
            </article>
        </div>
        <div class="ai-comparison">
            <table>
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Student Basic</th>
                        <th>Student Advance</th>
                        <th>Student Pro</th>
                        <th>Teacher Basic</th>
                        <th>Teacher Pro</th>
                        <th>Institution</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = [
                        ['AI Learning Assistant', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Smart Study Tools', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Online Courses Access', 'Limited', 'Unlimited', 'Unlimited', 'yes', 'yes', 'yes'],
                        ['AI Exam Preparation', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['Live Classes', '2 / Month', '4 / Month', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited'],
                        ['Performance Analytics', 'no', 'yes', 'yes', 'Basic', 'Advanced', 'Advanced'],
                        ['Cloud Storage', '5 GB', '20 GB', '50 GB', '20 GB', '100 GB', '100 GB+'],
                        ['Priority Support', 'Standard', 'Priority', 'VIP', 'Priority', 'VIP', 'Dedicated'],
                        ['Custom Branding', 'no', 'no', 'no', 'no', 'yes', 'yes'],
                        ['LMS / ERP Integration', 'no', 'no', 'no', 'no', 'yes', 'yes'],
                        ['AWS Secure Infrastructure', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                        ['International Partnerships', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'],
                    ];
                    foreach ($rows as $row):
                    ?>
                    <tr>
                        <td><?php echo ai_h($row[0]); ?></td>
                        <?php for ($i = 1; $i < count($row); $i++): ?>
                            <td><?php echo $row[$i] === 'yes' ? '<span class="ai-check">Yes</span>' : ai_h($row[$i]); ?></td>
                        <?php endfor; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="ai-section">
    <div class="ai-container ai-grid three">
        <article class="ai-card">
            <h3>Referral and Cashback Program</h3>
            <p>Invite students, teachers, and institutions. Earn cashback up to 20% on successful referrals.</p>
            <a href="sbciaipartner.php" class="ai-button secondary" style="margin-top: 18px;">Join Partner Program</a>
        </article>
        <article class="ai-card warm">
            <h3>Teacher Course Sponsorship</h3>
            <p>Get free course sponsorship, international promotion, marketing support, and AI content support.</p>
            <a href="sbciaisponsor.php" class="ai-button secondary" style="margin-top: 18px;">Apply for Sponsorship</a>
        </article>
        <article class="ai-card">
            <h3>Special Welcome Gift</h3>
            <p>New eligible registrations can request a 1 month free access voucher and a free demo session.</p>
            <a href="https://wa.me/971506264883" target="_blank" rel="noopener" class="ai-button secondary" style="margin-top: 18px;">Claim via WhatsApp</a>
        </article>
    </div>
</section>

<?php ai_render_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
