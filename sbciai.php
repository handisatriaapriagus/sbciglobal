<?php
require_once 'sbci_ai_common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI | Smart Learning. Unlimited Connections.'); ?>
</head>
<body class="ai-page">
<?php ai_render_nav('ai'); ?>

<main class="ai-hero" style="--hero-image: url('assets/0f395fbe-d33e-4557-b364-80ece7c038b9.jpg'); --panel-image: url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg');">
    <div class="ai-hero-inner">
        <div>
            <p class="ai-kicker">Powered by AI. Designed for Impact.</p>
            <h1>The Complete AI-Powered <span class="ai-gradient-text">Education Ecosystem</span></h1>
            <p class="ai-hero-copy">
                SBCI AI brings every tool needed to teach, learn, manage, collaborate, certify, and grow in one secure platform for schools, universities, teachers, students, and training centers.
            </p>
            <div class="ai-hero-actions">
                <a href="sbciairegistration.php" class="ai-button">Start Registration</a>
                <a href="#packages" class="ai-button secondary">View Packages</a>
                <a href="https://wa.me/971506264883" target="_blank" rel="noopener" class="ai-button teal">Talk on WhatsApp</a>
            </div>
            <div class="ai-pill-row" aria-label="Built for education communities">
                <span class="ai-pill">Universities</span>
                <span class="ai-pill">Schools</span>
                <span class="ai-pill">Teachers</span>
                <span class="ai-pill">Students</span>
                <span class="ai-pill">Training Centers</span>
                <span class="ai-pill">Online Academies</span>
            </div>
        </div>
        <aside class="ai-hero-panel" aria-label="SBCI AI platform preview">
            <div class="ai-hero-panel-content">
                <div class="ai-hero-panel-card">
                    <strong>One Platform</strong>
                    <p>AI learning, smart campus operations, analytics, content creation, online classes, certificates, and collaboration.</p>
                </div>
                <div class="ai-hero-panel-card">
                    <strong>AWS Secure Cloud</strong>
                    <p>Scalable infrastructure, global access, data protection, and enterprise-ready performance.</p>
                </div>
            </div>
        </aside>
    </div>
</main>

<section class="ai-section" id="ecosystem">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">One platform. Endless possibilities.</p>
                <h2>Everything your education community needs in one smart hub.</h2>
            </div>
            <p>SBCI AI helps institutions reduce subscription clutter, improve learning outcomes, and create new digital revenue streams with AI-powered infrastructure.</p>
        </div>
        <div class="ai-grid four">
            <?php
            $features = [
                ['AI Education Agents', '24/7 assistants for students, teachers, and campus teams.'],
                ['Smart Campus Management', 'Operational workflows for admissions, attendance, reports, and coordination.'],
                ['AI Exam Builder', 'AI-generated exams, smart grading, and instant evaluation.'],
                ['Online Courses Platform', 'Launch, sell, and manage digital learning experiences.'],
                ['Student Analytics', 'Track progress, engagement, completion, and performance insights.'],
                ['AI Research Assistant', 'Support research, summaries, references, and academic productivity.'],
                ['Digital Library', 'Centralized learning resources with controlled access.'],
                ['Certificate Generator', 'Digital certificates and achievements for learners and programs.'],
            ];
            foreach ($features as $index => $feature):
            ?>
                <article class="ai-card <?php echo $index % 2 ? 'warm' : ''; ?>">
                    <span class="ai-icon-badge">AI</span>
                    <h3><?php echo ai_h($feature[0]); ?></h3>
                    <p><?php echo ai_h($feature[1]); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="ai-stats-strip">
            <div class="ai-stat"><strong>200+</strong><span>Institutions</span></div>
            <div class="ai-stat"><strong>500K+</strong><span>Users</span></div>
            <div class="ai-stat"><strong>1000+</strong><span>Courses</span></div>
            <div class="ai-stat"><strong>10+</strong><span>Countries</span></div>
        </div>
    </div>
</section>

<section class="ai-section ai-alt">
    <div class="ai-container ai-showcase">
        <div class="ai-image-band" style="--band-image: url('assets/8cdc4aa3-6f80-4a28-a39f-3f18c6494ced.jpg');"></div>
        <div>
            <p class="ai-section-kicker">Why pay for multiple platforms?</p>
            <div class="ai-section-head" style="display:block; margin-bottom: 20px;">
                <h2>DigiGate AI includes everything in one smart platform.</h2>
                <p>Save time, reduce cost, strengthen outcomes, and give students and teachers a modern experience that works across devices.</p>
            </div>
            <div class="ai-grid two">
                <article class="ai-card">
                    <h3>Save Time</h3>
                    <p>Automate repetitive tasks so academic teams can focus on learning, support, and growth.</p>
                </article>
                <article class="ai-card warm">
                    <h3>Save Money</h3>
                    <p>Replace fragmented subscriptions with one integrated education ecosystem.</p>
                </article>
                <article class="ai-card warm">
                    <h3>Secure and Reliable</h3>
                    <p>Enterprise-grade hosting, cloud storage, and structured access controls.</p>
                </article>
                <article class="ai-card">
                    <h3>Better Results</h3>
                    <p>Data-driven insights for stronger teaching, student engagement, and executive decisions.</p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="ai-section">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Core branding advantages</p>
                <h2>Built for institutions, teachers, and students.</h2>
            </div>
        </div>
        <div class="ai-grid three">
            <article class="ai-card">
                <span class="ai-icon-badge">UNI</span>
                <h3>For Universities and Schools</h3>
                <ul class="ai-list">
                    <li>Digital transformation and smart campus operations.</li>
                    <li>Student engagement, reporting, and international learning.</li>
                    <li>Secure AWS infrastructure and revenue growth opportunities.</li>
                </ul>
            </article>
            <article class="ai-card warm">
                <span class="ai-icon-badge">TCH</span>
                <h3>For Teachers</h3>
                <ul class="ai-list">
                    <li>Create AI exams, lessons, courses, and teaching portfolios.</li>
                    <li>Sell premium learning material and host workshops.</li>
                    <li>Access international promotion and teaching certification.</li>
                </ul>
            </article>
            <article class="ai-card">
                <span class="ai-icon-badge">STD</span>
                <h3>For Students</h3>
                <ul class="ai-list">
                    <li>AI learning assistant, smart notes, and summaries.</li>
                    <li>Online courses, certificates, and study planning tools.</li>
                    <li>Career, internship, and global exchange opportunities.</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="ai-section ai-alt">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">AWS infrastructure branding</p>
                <h2>Secure, scalable, and reliable for modern education.</h2>
            </div>
            <p>Designed for high availability, global network reach, data protection, and multi-device access across schools and universities.</p>
        </div>
        <div class="ai-grid four">
            <?php foreach (['Secure UK/UAE Hosting', 'Enterprise-Level Protection', 'Cloud Scalability', 'High-Speed Performance', 'Data Protection Standards', 'Multi-Device Access', 'Backup and Recovery', 'Global Network'] as $item): ?>
                <article class="ai-card">
                    <span class="ai-icon-badge">AWS</span>
                    <h3><?php echo ai_h($item); ?></h3>
                    <p>Reliable cloud infrastructure for education leaders, teachers, and learners.</p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="ai-section" id="packages">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Recommended partnership packages</p>
                <h2>Flexible packages for schools, universities, teachers, and students.</h2>
            </div>
        </div>
        <div class="ai-grid four">
            <article class="ai-package-card" data-number="1">
                <h3>Smart School Package</h3>
                <p>Ideal for private and international schools.</p>
                <ul class="ai-list">
                    <li>Student, teacher, and parent portals.</li>
                    <li>AI exam system and video classes.</li>
                    <li>Smart attendance, reports, library, and cloud storage.</li>
                </ul>
                <img src="assets/c146f6e7-a7c5-42ec-92db-20844f4134ef.jpg" alt="Smart school package">
            </article>
            <article class="ai-package-card" data-number="2">
                <h3>Smart University Package</h3>
                <p>Built for full AI smart campus transformation.</p>
                <ul class="ai-list">
                    <li>University ERP integration and faculty management.</li>
                    <li>AI research assistant and student analytics.</li>
                    <li>Digital certification and online course marketplace.</li>
                </ul>
                <img src="assets/42cef3e2-de18-4705-854f-8b9767876379.jpg" alt="Smart university package">
            </article>
            <article class="ai-package-card" data-number="3">
                <h3>DigiGate AI Teacher Pro</h3>
                <p>Designed for individual teachers and instructors.</p>
                <ul class="ai-list">
                    <li>AI exam builder and teaching hub.</li>
                    <li>Student management and content generator.</li>
                    <li>Video classes and course selling system.</li>
                </ul>
                <img src="assets/bb061704-3018-46e8-af80-467e8f1124aa.jpg" alt="Teacher pro package">
            </article>
            <article class="ai-package-card" data-number="4">
                <h3>DigiGate AI Student Pro</h3>
                <p>For students who want smarter learning support.</p>
                <ul class="ai-list">
                    <li>AI learning assistant and smart notes.</li>
                    <li>Study tools, online courses, and community access.</li>
                    <li>Career, internship, and international activities.</li>
                </ul>
                <img src="assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg" alt="Student pro package">
            </article>
        </div>
    </div>
</section>

<section class="ai-section ai-alt" id="plans">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Flexible plans</p>
                <h2>Powerful, affordable, AI-driven education plans.</h2>
            </div>
            <a href="sbciairegistration.php#comparison" class="ai-button secondary">View Full Comparison</a>
        </div>
        <div class="ai-grid three">
            <article class="ai-price-card">
                <h3>Student Basic</h3>
                <div class="ai-price">250 <small>EGP / Month<br>5 USD / Month</small></div>
                <p>Smart study tools, online courses, digital library, and community access.</p>
                <a href="sbciaistudentregistration.php" class="ai-button">Get Started</a>
            </article>
            <article class="ai-price-card">
                <h3>Student Advance</h3>
                <div class="ai-price">450 <small>EGP / Month<br>9 USD / Month</small></div>
                <p>Basic features plus limited AI access, summaries, notes, and analytics.</p>
                <a href="sbciaistudentregistration.php" class="ai-button">Upgrade Now</a>
            </article>
            <article class="ai-price-card featured">
                <h3>Student Pro</h3>
                <div class="ai-price">750 <small>EGP / Month<br>15 USD / Month</small></div>
                <p>Unlimited DigiGate AI, premium features, priority support, and global opportunities.</p>
                <a href="sbciaistudentregistration.php" class="ai-button">Go Pro</a>
            </article>
            <article class="ai-price-card">
                <h3>Teacher Basic</h3>
                <div class="ai-price">500 <small>EGP / Month<br>10 USD / Month</small></div>
                <p>AI teaching tools, lesson planner, exam builder, classroom tools, and reports.</p>
                <a href="sbciteacherregistration.php" class="ai-button">Get Started</a>
            </article>
            <article class="ai-price-card">
                <h3>Teacher Pro</h3>
                <div class="ai-price">900 <small>EGP / Month<br>17 USD / Month</small></div>
                <p>Full AI education suite, advanced analytics, live classes, portfolio, and marketplace.</p>
                <a href="sbciteacherregistration.php" class="ai-button">Upgrade Now</a>
            </article>
            <article class="ai-price-card featured">
                <h3>Institution Pro</h3>
                <div class="ai-price">Custom <small>/ Month</small></div>
                <p>Smart campus, multi-user management, custom integrations, security, and branding.</p>
                <a href="universityschoolregistration.php" class="ai-button">Contact Us</a>
            </article>
        </div>
    </div>
</section>

<section class="ai-section">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Choose your registration type</p>
                <h2>Start with the sector that matches your goal.</h2>
            </div>
        </div>
        <div class="ai-grid four">
            <a class="ai-portal-card" href="sbciaistudentregistration.php" style="--card-image: url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg');">
                <span class="media"></span><span class="content"><h3>Student Portal</h3><p>Register for student plans, AI learning tools, certificates, and career support.</p></span>
            </a>
            <a class="ai-portal-card" href="sbciteacherregistration.php" style="--card-image: url('assets/bb061704-3018-46e8-af80-467e8f1124aa.jpg');">
                <span class="media"></span><span class="content"><h3>Teacher Portal</h3><p>Apply as a teacher, instructor, or course creator.</p></span>
            </a>
            <a class="ai-portal-card" href="universityschoolregistration.php" style="--card-image: url('assets/c146f6e7-a7c5-42ec-92db-20844f4134ef.jpg');">
                <span class="media"></span><span class="content"><h3>University / School</h3><p>Request institutional smart campus and partnership options.</p></span>
            </a>
            <a class="ai-portal-card" href="sbciaisponsor.php" style="--card-image: url('assets/8cdc4aa3-6f80-4a28-a39f-3f18c6494ced.jpg');">
                <span class="media"></span><span class="content"><h3>Sponsorship Form</h3><p>Apply for teacher course sponsorship and global promotion.</p></span>
            </a>
        </div>
    </div>
</section>

<?php ai_render_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
