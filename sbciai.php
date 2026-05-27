<?php
require_once 'sbci_ai_common.php';

function ai_tile($icon, $title, $copy = '') {
    ?>
    <div class="ai-feature-tile">
        <?php echo ai_icon($icon); ?>
        <strong><?php echo ai_h($title); ?></strong>
        <?php if ($copy !== ''): ?><p><?php echo ai_h($copy); ?></p><?php endif; ?>
    </div>
    <?php
}

function ai_row_tile($icon, $title, $copy = '') {
    ?>
    <div class="ai-feature-tile row">
        <?php echo ai_icon($icon); ?>
        <span>
            <strong><?php echo ai_h($title); ?></strong>
            <?php if ($copy !== ''): ?><p><?php echo ai_h($copy); ?></p><?php endif; ?>
        </span>
    </div>
    <?php
}

function ai_design_list($items) {
    echo '<ul class="ai-list design">';
    foreach ($items as $item) {
        echo '<li>' . ai_h($item) . '</li>';
    }
    echo '</ul>';
}

function ai_metric($icon, $value, $label) {
    ?>
    <div class="ai-metric">
        <?php echo ai_icon($icon); ?>
        <span><strong><?php echo ai_h($value); ?></strong><?php echo ai_h($label); ?></span>
    </div>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI | Smart Learning. Unlimited Connections.'); ?>
</head>
<body class="ai-page">
<?php ai_render_nav('ai'); ?>

<main class="ai-brochure-hero" id="ecosystem">
    <div class="ai-brochure-container">
        <div class="ai-brochure-grid">
            <div>
                <div class="ai-logo-wordmark">
                    <span class="ai-logo-mark">∞</span>
                    <span>SBCI <span class="ai-text-gradient">AI</span><small>SMART LEARNING. UNLIMITED CONNECTIONS.</small></span>
                </div>
                <p class="ai-brochure-kicker">The Complete AI-Powered</p>
                <h1 class="ai-brochure-title"><span class="ai-text-gradient">Education Ecosystem</span></h1>
                <p class="ai-brochure-subtitle">Smarter Education. Stronger Institutions. Better Outcomes.</p>

                <div class="ai-brochure-card" style="margin-top: 26px;">
                    <h2 class="ai-card-heading small"><span class="ai-text-gradient">Built for Every Education Community</span></h2>
                    <div class="ai-feature-grid six">
                        <?php
                        ai_tile('library', 'Universities');
                        ai_tile('school', 'Schools');
                        ai_tile('teacher', 'Teachers');
                        ai_tile('users', 'Students');
                        ai_tile('graduation', 'Training Centers');
                        ai_tile('training', 'Online Academies');
                        ?>
                    </div>
                </div>

                <div class="ai-brochure-card" style="margin-top: 18px;">
                    <h2 class="ai-card-heading small"><span class="ai-text-gradient">One Platform. Endless Possibilities.</span></h2>
                    <p class="ai-brochure-copy">SBCI AI brings every tool you need to teach, learn, manage, and grow — all powered by Artificial Intelligence.</p>
                    <div class="ai-feature-grid four" style="margin-top: 16px;">
                        <?php
                        ai_tile('users', 'All-in-One AI Platform');
                        ai_tile('analytics', 'Boost Productivity');
                        ai_tile('graduation', 'Enhance Learning');
                        ai_tile('globe', 'Impact the Future');
                        ?>
                    </div>
                </div>
            </div>

            <aside class="ai-glow-panel">
                <span class="ai-section-label">Powered by AI. Designed for Impact.</span>
                <div class="ai-feature-grid two">
                    <?php
                    $ecosystemTools = [
                        ['ai', 'AI Education Agents'],
                        ['school', 'Smart Campus Management'],
                        ['exam', 'AI Exam Builder'],
                        ['training', 'Online Courses Platform'],
                        ['analytics', 'Student Analytics'],
                        ['book', 'AI Research Assistant'],
                        ['library', 'Digital Library'],
                        ['video', 'Video Classes'],
                        ['certificate', 'Certificate Generator'],
                        ['analytics', 'AI Reports & Insights'],
                        ['exam', 'AI Content Creation'],
                        ['training', 'YouTube Studio Pro'],
                        ['briefcase', 'Office Productivity Tools'],
                        ['cloud', 'Cloud Storage & Collaboration'],
                        ['analytics', 'AI Student Performance Tracking'],
                    ];
                    foreach ($ecosystemTools as $tool) {
                        ai_row_tile($tool[0], $tool[1]);
                    }
                    ?>
                </div>
            </aside>
        </div>

        <div class="ai-grid three" style="margin-top: 22px;">
            <article class="ai-brochure-card">
                <h2 class="ai-card-heading small"><span class="ai-text-gradient">Strategic Partnership</span></h2>
                <p class="ai-brochure-copy"><strong>Global Holding Group UK</strong><br>UNDER SERVICE PROVIDER<br><strong>SBCI AI PARTNER</strong></p>
            </article>
            <article class="ai-brochure-card">
                <h2 class="ai-card-heading small">Powered by <span class="ai-text-gradient">DigiGate AI UK</span></h2>
                <p class="ai-brochure-copy">REGIONAL DIGITAL SOLUTIONS PARTNER</p>
                <div class="ai-feature-grid four">
                    <?php
                    ai_tile('ai', 'Digital Innovation');
                    ai_tile('gear', 'System Integration');
                    ai_tile('shield', 'Managed Services');
                    ai_tile('headset', '24/7 Support');
                    ?>
                </div>
            </article>
            <article class="ai-brochure-card">
                <h2 class="ai-card-heading small"><span class="ai-text-gradient">Infrastructure & Security</span></h2>
                <p class="ai-brochure-copy"><strong>Amazon AWS Secure Cloud Infrastructure</strong></p>
                <div class="ai-feature-grid four">
                    <?php
                    ai_tile('cloud', 'Scalable Infrastructure');
                    ai_tile('shield', 'Enterprise Security');
                    ai_tile('analytics', 'High Availability');
                    ai_tile('globe', 'Global Network');
                    ?>
                </div>
            </article>
        </div>
    </div>
</main>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <div class="ai-brochure-grid">
            <div>
                <h2 class="ai-brochure-title medium">Why Pay for Multiple Platforms?</h2>
                <p class="ai-brochure-subtitle">DigiGate AI Includes Everything in <span class="ai-text-gradient"><strong>ONE Smart Platform</strong></span></p>
                <p class="ai-brochure-copy">Everything you need. All in one place. Smarter teaching. Better learning. Stronger outcomes.</p>
                <div class="ai-feature-grid two" style="margin-top: 22px;">
                    <?php
                    ai_row_tile('clock', 'Save Time', 'Automate tasks & focus on what matters');
                    ai_row_tile('dollar', 'Save Money', 'No more subscriptions or hidden costs');
                    ai_row_tile('shield', 'Secure & Reliable', 'Enterprise-grade security & cloud infrastructure');
                    ai_row_tile('analytics', 'Better Results', 'Data-driven insights for real impact');
                    ?>
                </div>
            </div>
            <div class="ai-glow-panel">
                <span class="ai-section-label">One Platform Unlimited Possibilities</span>
                <div class="ai-feature-grid three">
                    <?php
                    foreach ([
                        ['cloud', 'Cloud Drive'],
                        ['bot', 'AI Assistant'],
                        ['exam', 'Exam Generator'],
                        ['users', 'Student Management'],
                        ['video', 'Video Classes'],
                        ['analytics', 'AI Analytics'],
                        ['book', 'Digital Library'],
                        ['certificate', 'Certificates'],
                        ['exam', 'AI Reports'],
                        ['graduation', 'Online Courses'],
                        ['bot', 'AI Agent Automation'],
                    ] as $item) {
                        ai_tile($item[0], $item[1]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="ai-metric-strip">
            <?php
            ai_metric('library', '200+', 'Institutions');
            ai_metric('users', '500K+', 'Users');
            ai_metric('graduation', '1000+', 'Courses');
            ai_metric('globe', '10+', 'Countries');
            ?>
        </div>
        <div class="ai-grid four" style="margin-top: 14px;">
            <?php
            ai_row_tile('database', 'Stop Paying for Multiple Tools', 'Switch to SBCI AI & Save Big Every Month!');
            ai_row_tile('shield', 'One Platform Everything You Need', 'All essential tools. One seamless experience.');
            ai_row_tile('rocket', 'Up To 80%', 'Cost Savings');
            ai_row_tile('users', 'Built for Education Driven by AI', 'Empowering minds. Transforming education globally.');
            ?>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <div class="ai-brochure-grid align-start">
            <div>
                <p class="ai-brochure-kicker">Powering Education.</p>
                <h2 class="ai-brochure-title medium"><span class="ai-text-gradient">Transforming Futures.</span></h2>
                <p class="ai-brochure-subtitle">One Smart AI Platform. Infinite Possibilities.</p>
                <span class="ai-section-label">Core Branding Advantages</span>
                <div class="ai-grid three">
                    <article class="ai-brochure-card">
                        <h3 class="ai-card-heading small">For Universities & Schools</h3>
                        <?php ai_design_list(['Digital Transformation', 'AI Smart Campus', 'Student Engagement', 'International Learning', 'Revenue Growth Opportunities', 'Smart Academic Management', 'Secure AWS Infrastructure']); ?>
                    </article>
                    <article class="ai-brochure-card">
                        <h3 class="ai-card-heading small">For Teachers</h3>
                        <?php ai_design_list(['AI Exam Creation', 'Smart Classroom Management', 'Course Selling Platform', 'Student Analytics', 'AI Teaching Assistant', 'Online Teaching Hub']); ?>
                    </article>
                    <article class="ai-brochure-card">
                        <h3 class="ai-card-heading small">For Students</h3>
                        <?php ai_design_list(['AI Learning Assistant', 'Smart Notes & Summaries', 'Career & Internship Access', 'Global Exchange Opportunities', 'Digital Certificates', 'Learning Anywhere Anytime']); ?>
                    </article>
                </div>
            </div>
            <aside class="ai-brochure-card">
                <h3 class="ai-card-heading small">Partnering with Leading Universities in Indonesia & Malaysia</h3>
                <?php
                $partners = [
                    ['Budi Luhur University', 'Indonesia', 'Innovating education through technology and digital transformation.'],
                    ['University of Indonesia', 'Indonesia', 'Advancing education, research and innovation for a better future.'],
                    ['Atma Jaya Catholic University of Indonesia', 'Indonesia', 'Excellence in education with values, integrity and global vision.'],
                    ['Universiti Malaya (UM)', 'Malaysia', 'A leading university driving innovation and global impact.'],
                    ['Universiti Kebangsaan Malaysia (UKM)', 'Malaysia', 'Inspiring futures, nurturing leaders, advancing knowledge.'],
                    ['Universiti Teknologi Malaysia (UTM)', 'Malaysia', 'Engineering a better world through technology and talent.'],
                    ['And Many More Universities', 'Across Malaysia...', ''],
                ];
                foreach ($partners as $partner):
                ?>
                    <div class="ai-feature-tile row" style="margin-top: 10px;">
                        <?php echo ai_icon('library'); ?>
                        <span><strong><?php echo ai_h($partner[0]); ?></strong><p><?php echo ai_h($partner[1]); ?><?php echo $partner[2] ? '<br>' . ai_h($partner[2]) : ''; ?></p></span>
                    </div>
                <?php endforeach; ?>
            </aside>
        </div>
        <div class="ai-feature-grid six" style="margin-top: 22px;">
            <?php
            ai_row_tile('gear', 'All in One Platform', 'Everything You Need In One Place');
            ai_row_tile('ai', 'AI Powered', 'Smarter Automation Better Outcomes');
            ai_row_tile('cloud', 'Cloud Secure', 'AWS Powered Secure & Scalable');
            ai_row_tile('globe', 'Global Connect', 'Learn. Collaborate. Grow Together');
            ai_row_tile('analytics', 'Data Driven', 'Insights That Drive Success');
            ai_row_tile('rocket', 'Future Ready', 'Innovate Today, Lead Tomorrow');
            ?>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <div class="ai-brochure-grid align-start">
            <div>
                <h2 class="ai-brochure-title medium">One Platform for <span class="ai-text-gradient">The Entire Education Journey</span></h2>
                <p class="ai-brochure-copy">DigiGate AI transforms traditional education into a smart AI-powered ecosystem designed for modern schools and universities.</p>
                <div class="ai-brochure-card" style="margin-top: 22px;">
                    <p class="ai-brochure-copy">From AI-generated exams and smart analytics to online learning, collaboration, content creation, and global education opportunities — everything is integrated into one secure platform powered by AWS infrastructure.</p>
                </div>
                <div class="ai-feature-grid six" style="margin-top: 22px;">
                    <?php
                    ai_tile('library', 'Universities');
                    ai_tile('school', 'Schools');
                    ai_tile('teacher', 'Teachers');
                    ai_tile('users', 'Students');
                    ai_tile('graduation', 'Training Centers');
                    ai_tile('training', 'Online Academies');
                    ?>
                </div>
            </div>
            <aside class="ai-brochure-card">
                <span class="ai-section-label">AWS Infrastructure Branding</span>
                <h3 class="ai-card-heading">Secure • Scalable • Reliable</h3>
                <p class="ai-brochure-copy">Built on advanced Amazon AWS cloud infrastructure with:</p>
                <div class="ai-feature-grid two" style="margin-top: 16px;">
                    <?php
                    ai_tile('shield', 'Secure UK/UAE Hosting');
                    ai_tile('lock', 'Enterprise-Level Protection');
                    ai_tile('cloud', 'Cloud Scalability');
                    ai_tile('analytics', 'High-Speed Performance');
                    ai_tile('database', 'Data Protection Standards');
                    ai_tile('laptop', 'Multi-Device Access');
                    ai_tile('cloud', 'Backup & Recovery Systems');
                    ?>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Why Egyptian Universities & Schools <span class="ai-text-gradient">Need DigiGate AI</span></h2>
        <p class="ai-brochure-subtitle">Smarter Education. Stronger Egypt. Global Future.</p>
        <p class="ai-brochure-copy">DigiGate AI is the all-in-one intelligent platform built to empower Egyptian education with AI, automation, and global opportunities.</p>
        <div class="ai-brochure-grid align-start" style="margin-top: 26px;">
            <aside class="ai-brochure-card">
                <h3 class="ai-card-heading small">Reduce Costs</h3>
                <p class="ai-brochure-copy">No need for multiple expensive systems:</p>
                <?php ai_design_list(['ChatGPT subscriptions', 'Microsoft Office tools', 'Zoom subscriptions', 'LMS systems', 'Online exam systems', 'Cloud storage subscriptions', 'Course platforms', 'Student management systems', 'Everything is integrated into ONE platform.']); ?>
            </aside>
            <div class="ai-grid three">
                <article class="ai-brochure-card">
                    <h3 class="ai-card-heading small">AI-Powered Education Revolution</h3>
                    <p class="ai-brochure-copy">Transform classrooms with:</p>
                    <?php ai_design_list(['AI-generated exams', 'Smart grading', 'AI lesson preparation', 'AI student analytics', 'AI reports & performance tracking', 'AI content creation', 'AI research assistance', 'AI learning recommendations']); ?>
                </article>
                <article class="ai-brochure-card">
                    <h3 class="ai-card-heading small">International Education Opportunities</h3>
                    <p class="ai-brochure-copy">Connect Egyptian students and teachers with:</p>
                    <?php ai_design_list(['UK universities', 'GCC education partners', 'International online classrooms', 'Exchange programs', 'Global workshops', 'Online international certifications', 'Cross-border academic collaboration']); ?>
                </article>
                <article class="ai-brochure-card">
                    <h3 class="ai-card-heading small">Smart Campus Transformation</h3>
                    <p class="ai-brochure-copy">Digitize university & school operations:</p>
                    <?php ai_design_list(['Student enrollment', 'Attendance tracking', 'Academic activities', 'Assignments & exams', 'Online communication', 'Learning management', 'Financial & subscription systems', 'Teacher productivity tools']); ?>
                </article>
            </div>
        </div>
        <div class="ai-feature-grid six" style="margin-top: 22px;">
            <?php
            ai_row_tile('dollar', 'Lower Costs', 'Higher Efficiency');
            ai_row_tile('analytics', 'Better Learning Outcomes');
            ai_row_tile('globe', 'Global Exposure for Students');
            ai_row_tile('ai', 'Smarter Decisions with AI Analytics');
            ai_row_tile('rocket', 'Future-Ready Education');
            ai_row_tile('shield', 'One Platform. Endless Possibilities.', 'Empowering Egypt\'s Education, Today & Tomorrow.');
            ?>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Added Value for <span class="ai-text-gradient">University Management</span></h2>
        <p class="ai-brochure-subtitle">For University Owners & Board Members</p>
        <p class="ai-brochure-kicker">"From Local University to International Education Hub"</p>
        <div class="ai-brochure-grid align-start" style="margin-top: 24px;">
            <div>
                <div class="ai-brochure-card">
                    <h3 class="ai-card-heading small">Transforming Egypt. Connecting the World.</h3>
                    <p class="ai-brochure-copy">SBCI AI & DigiGate AI empower Egyptian universities to become global leaders through AI, innovation, and international collaboration.</p>
                </div>
                <div class="ai-brochure-card" style="margin-top: 18px;">
                    <h3 class="ai-card-heading small">Revenue Opportunity Model</h3>
                    <div class="ai-grid three">
                        <div>
                            <strong>Option 1</strong>
                            <p class="ai-brochure-copy">Revenue Sharing Model</p>
                            <?php ai_design_list(['No large upfront investment', 'Monthly/annual student subscriptions', 'Revenue sharing with university', 'SBCI & DigiGate handle platform support']); ?>
                        </div>
                        <div>
                            <strong>Option 2</strong>
                            <p class="ai-brochure-copy">White Label University Platform</p>
                            <?php ai_design_list(['Custom university branding', 'Dedicated mobile app', 'AI campus system', 'Dedicated AWS cloud environment', 'Custom domain & integrations']); ?>
                        </div>
                        <div>
                            <strong>Option 3</strong>
                            <p class="ai-brochure-copy">National Smart Campus Partnership</p>
                            <?php ai_design_list(['Multi-campus integration', 'AI education transformation roadmap', 'Teacher AI certification', 'International partnerships', 'Student exchange ecosystem']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="ai-brochure-card">
                <h3 class="ai-card-heading small">Key Benefits</h3>
                <div class="ai-feature-grid two">
                    <?php
                    foreach ([
                        ['users', 'Increase Student Enrollment'],
                        ['analytics', 'Improve University Ranking'],
                        ['globe', 'Attract International Students'],
                        ['dollar', 'Generate Recurring Revenue Streams'],
                        ['ai', 'Modern AI Campus Transformation'],
                        ['briefcase', 'Reduce Operational Workload'],
                        ['star', 'Improve Digital Reputation'],
                        ['rocket', 'Future-Ready Education System'],
                    ] as $item) {
                        ai_tile($item[0], $item[1]);
                    }
                    ?>
                </div>
                <h3 class="ai-card-heading small" style="margin-top: 18px;">Egypt's Prime Locations Building a Smart Future</h3>
                <?php ai_design_list(['The Pyramids of Giza', 'New Administrative Capital', 'Cairo Tower', 'Al Alamein City', 'Bibliotheca Alexandrina', 'El Gouna Red Sea']); ?>
            </aside>
        </div>
        <div class="ai-feature-grid six" style="margin-top: 22px;">
            <?php
            ai_row_tile('users', 'Higher Enrollment', 'More Students');
            ai_row_tile('analytics', 'Stronger Reputation', 'Global Ranking');
            ai_row_tile('dollar', 'New Revenue Streams');
            ai_row_tile('gear', 'Operational Efficiency', 'Cost Reduction');
            ai_row_tile('graduation', 'AI-Powered Campus', 'Modern & Smart');
            ai_row_tile('globe', 'Global Connections', 'Endless Opportunities');
            ?>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Empowering Every Teacher. <span class="ai-text-gradient">Inspiring Every Student.</span></h2>
        <p class="ai-brochure-subtitle">DigiGate AI - The All-in-One Education Ecosystem</p>
        <div class="ai-grid three" style="margin-top: 28px;">
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Powerful Benefits for Teachers</h3>
                <p class="ai-brochure-copy">Teach Smarter. Save Time. Earn More.</p>
                <p class="ai-brochure-copy">Teachers can:</p>
                <?php ai_design_list(['Create AI exams instantly', 'Manage classes easily', 'Upload courses online', 'Sell premium learning materials', 'Monitor student progress', 'Create live video classes', 'Generate reports automatically', 'Build digital teaching portfolios']); ?>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Teacher Added Value</h3>
                <div class="ai-feature-grid two">
                    <?php
                    ai_tile('clock', 'Save Time', 'With AI Automation');
                    ai_tile('analytics', 'Increase Impact', 'With Smart Tools');
                    ai_tile('dollar', 'Earn More', 'With Multiple Income Streams');
                    ai_tile('rocket', 'Professional Growth', 'Continuous Learning');
                    ai_tile('globe', 'Global Exposure', 'Expand Your Reach');
                    ai_tile('gear', 'Work Smarter', 'Not Harder');
                    ?>
                </div>
                <div class="ai-brochure-card" style="margin-top: 18px; box-shadow: none;">
                    <h3 class="ai-card-heading small">DigiGate Teacher Marketplace</h3>
                    <p class="ai-brochure-copy">Teachers can:</p>
                    <?php ai_design_list(['Monetize online courses', 'Offer paid workshops', 'Create premium educational content', 'Build personal academic branding', 'Access international teaching collaboration']); ?>
                </div>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Powerful Benefits for Students</h3>
                <p class="ai-brochure-copy">Learn Beyond the Classroom</p>
                <p class="ai-brochure-copy">Students receive:</p>
                <?php ai_design_list(['AI learning assistant', 'Smart study tools', 'Online live classes', 'Digital certificates', 'AI summaries & notes', 'International learning opportunities', 'Career & internship access', 'Personalized learning paths']); ?>
            </article>
        </div>
        <div class="ai-brochure-card" style="margin-top: 22px;">
            <p class="ai-brochure-subtitle" style="margin: 0;">DigiGate AI brings teachers and students together in one smart platform to teach better, learn better, and achieve more — together.</p>
        </div>
    </div>
</section>

<section class="ai-brochure-section" id="packages">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Recommended <span class="ai-text-gradient">Partnership Packages</span></h2>
        <p class="ai-brochure-subtitle">Flexible Packages for Schools, Universities, Teachers & Students</p>
        <div class="ai-chip-line">
            <?php foreach ([['ai','AI-Powered'], ['shield','Secure'], ['cloud','Scalable'], ['dollar','Smart'], ['rocket','Future-Ready']] as $chip): ?>
                <span class="ai-pill"><?php echo ai_icon($chip[0]); ?><?php echo ai_h($chip[1]); ?></span>
            <?php endforeach; ?>
        </div>
        <div class="ai-package-grid">
            <?php
            $packages = [
                ['1', 'Smart School Package', 'Ideal For: Private Schools & International Schools', ['Student Portal', 'Teacher Portal', 'Parent Access', 'AI Exam System', 'Video Classes', 'Smart Attendance', 'Digital Library', 'School Reports', 'Cloud Storage'], "url('assets/c146f6e7-a7c5-42ec-92db-20844f4134ef.jpg')"],
                ['2', 'Smart University Package', '', ['Full AI Smart Campus', 'University ERP Integration', 'AI Research Assistant', 'Online Learning System', 'AI Student Analytics', 'Faculty Management', 'International Exchange Hub', 'Digital Certification', 'Online Course Marketplace'], "url('assets/42cef3e2-de18-4705-854f-8b9767876379.jpg')"],
                ['3', 'DigiGate AI Teacher Pro Package', 'Designed For Individual Teachers', ['AI Exam Builder', 'Online Teaching Hub', 'Student Management', 'AI Content Generator', 'Video Classes', 'Course Selling System'], "url('assets/bb061704-3018-46e8-af80-467e8f1124aa.jpg')"],
                ['4', 'DigiGate AI Student Pro Package', '', ['AI Learning Assistant', 'Smart Notes', 'AI Study Tools', 'Online Courses', 'Student Community', 'Career & Internship Access', 'International Activities'], "url('assets/edee9894-54d5-4057-93cc-dcb520f31896.jpg')"],
            ];
            foreach ($packages as $package):
            ?>
                <article class="ai-design-package" style="--package-image: <?php echo $package[4]; ?>;">
                    <span class="ai-package-number"><?php echo ai_h($package[0]); ?></span>
                    <h3><?php echo ai_h($package[1]); ?></h3>
                    <?php if ($package[2] !== ''): ?><p><?php echo ai_h($package[2]); ?></p><?php endif; ?>
                    <p><strong>Includes:</strong></p>
                    <?php ai_design_list($package[3]); ?>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="ai-brochure-card" style="margin-top: 22px;">
            <h3 class="ai-card-heading small">Why Partner with SBCI AI & DigiGate AI?</h3>
            <div class="ai-feature-grid seven">
                <?php
                foreach ([
                    ['analytics', 'Increase Enrollment'],
                    ['graduation', 'Improve Academic Performance'],
                    ['dollar', 'Reduce Operational Costs'],
                    ['globe', 'Access Global Opportunities'],
                    ['ai', 'AI-Powered Transformation'],
                    ['rocket', 'Future-Ready Education'],
                    ['headset', 'Dedicated Support & Training'],
                ] as $item) {
                    ai_row_tile($item[0], $item[1]);
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="ai-brochure-section" id="plans">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Flexible Plans for <span class="ai-text-gradient">Every Learner & Educator</span></h2>
        <p class="ai-brochure-subtitle">Powerful. Affordable. AI-Driven Education for Egypt & Beyond</p>
        <div class="ai-chip-line">
            <?php foreach ([['graduation','All-in-One Platform'], ['ai','AI-Powered Tools'], ['analytics','Smart Analytics'], ['shield','Secure & Reliable'], ['globe','Global Opportunities']] as $chip): ?>
                <span class="ai-pill"><?php echo ai_icon($chip[0]); ?><?php echo ai_h($chip[1]); ?></span>
            <?php endforeach; ?>
        </div>
        <div class="ai-price-grid">
            <?php
            $plans = [
                ['Basic', '250', 'EGP', 'All platform features except DigiGate AI', ['Smart Study Tools', 'Online Courses', 'Digital Library', 'Community Access', 'Career & Internship Access'], 'Get Started', ''],
                ['Advance', '450', 'EGP', 'All features + Limited AI Access', ['Limited AI Assistant', 'AI Summaries & Notes', 'Smart Exam Generator', 'AI Study Planner', 'Performance Analytics'], 'Upgrade Now', 'purple'],
                ['Pro', '750', 'EGP', 'Unlimited DigiGate AI + Premium Features', ['Unlimited DigiGate AI', 'AI Learning Assistant', 'Advanced Analytics', 'Priority Support', 'Exclusive Premium Content', 'International Opportunities'], 'Go Pro', 'gold'],
                ['Teacher Basic', '500', 'EGP', 'AI Teaching Tools + Student Management', ['AI Lesson Planner', 'AI Exam Builder', 'Student Management', 'Classroom Tools', 'Basic Reports', 'Resource Library'], 'Get Started', ''],
                ['Teacher Pro', '900', 'EGP', 'Full AI Education Suite + Analytics', ['Unlimited AI Tools', 'Advanced Analytics', 'Auto Grading', 'Live Classes', 'Digital Portfolio', 'Priority Support'], 'Upgrade Now', 'purple'],
                ['Institution Pro', 'Custom', '', 'University & School Enterprise Solution', ['Full AI Smart Campus', 'Multi-User Management', 'Custom Integrations', 'Advanced Security', 'Dedicated Support', 'Custom Branding'], 'Contact Us', 'gold'],
            ];
            foreach ($plans as $plan):
            ?>
                <article class="ai-design-price <?php echo ai_h($plan[7]); ?>">
                    <h3><?php echo ai_h($plan[0]); ?></h3>
                    <div><span class="amount"><?php echo ai_h($plan[1]); ?><?php if ($plan[2] !== ''): ?><small><?php echo ai_h($plan[2]); ?></small><?php endif; ?></span><div class="unit">/ Month</div></div>
                    <p class="ai-brochure-copy"><?php echo ai_h($plan[3]); ?></p>
                    <?php ai_design_list($plan[4]); ?>
                    <a class="ai-button" href="sbciairegistration.php"><?php echo ai_h($plan[5]); ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="ai-brochure-section">
    <div class="ai-brochure-container">
        <h2 class="ai-brochure-title medium">Empowering <span class="ai-text-gradient">Egyptian Education</span></h2>
        <p class="ai-brochure-subtitle">With Artificial Intelligence</p>
        <h3 class="ai-brochure-title small">DigiGate <span class="ai-text-gradient">AI</span></h3>
        <p class="ai-brochure-subtitle">The All-in-One AI-Powered Education Ecosystem</p>
        <div class="ai-brochure-grid align-start" style="margin-top: 28px;">
            <aside class="ai-brochure-card">
                <h3 class="ai-card-heading small">Key Executive Message</h3>
                <p class="ai-brochure-copy"><strong>"DigiGate AI is not just another LMS platform."</strong></p>
                <p class="ai-brochure-copy">It is a complete AI-powered education ecosystem that:</p>
                <?php ai_design_list(['Reduces operational costs', 'Increases efficiency', 'Creates new revenue opportunities', 'Enhances student engagement', 'Expands international partnerships', 'Positions the institution as future-ready']); ?>
            </aside>
            <article class="ai-brochure-card">
                <p class="ai-brochure-copy">DigiGate AI, in partnership with SBCI Egypt | UAE, delivers a next-generation smart education ecosystem powered by advanced AI technology and Amazon AWS secure cloud infrastructure helping Egyptian schools and universities compete globally while providing students and teachers with a smarter, more connected future.</p>
                <div class="ai-grid three" style="margin-top: 18px;">
                    <div>
                        <h3 class="ai-card-heading small">For Universities & Management</h3>
                        <?php ai_design_list(['Smart Campus Transformation', 'AI-Powered Administration', 'Data-Driven Decision Making', 'New Revenue Generation', 'Global University Partnerships']); ?>
                    </div>
                    <div>
                        <h3 class="ai-card-heading small">For Teachers</h3>
                        <?php ai_design_list(['AI Teaching Assistant', 'Instant Exam Creation', 'Smart Classroom Management', 'Course Monetization', 'Professional Growth']); ?>
                    </div>
                    <div>
                        <h3 class="ai-card-heading small">For Students</h3>
                        <?php ai_design_list(['AI Learning Assistant', 'Smart Study Tools', 'Global Learning Opportunities', 'Digital Certificates', 'Career & Internship Access']); ?>
                    </div>
                </div>
            </article>
            <aside class="ai-brochure-card">
                <h3 class="ai-card-heading small">Why DigiGate AI?</h3>
                <?php ai_design_list(['AI-Powered Advanced AI tools for teaching, learning, and administration', 'All-in-One Platform Everything you need in one seamless, integrated ecosystem', 'Cost Effective Reduce costs with a single platform instead of multiple tools', 'Global Opportunities Connect with international universities, partners, and programs', 'Secure & Reliable Enterprise-grade security with Amazon AWS Cloud', 'Scalable for Growth Built to grow with your institution and future needs']); ?>
            </aside>
        </div>
        <div class="ai-feature-grid four" style="margin-top: 22px;">
            <?php
            ai_row_tile('ai', 'Local Expertise', 'Global Vision');
            ai_row_tile('gear', 'Partnering Today', 'for a Smarter Tomorrow');
            ai_row_tile('globe', 'Building the Future of Education', 'in Egypt and Beyond');
            ai_row_tile('rocket', 'Together, Let\'s Build a Smarter, Stronger, Future-Ready Education!');
            ?>
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
                        <th>Features Comparison</th>
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
                    $comparisonRows = [
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
                    foreach ($comparisonRows as $row):
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

        <div class="ai-action-panel" style="margin-top: 22px;">
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">What You Get in Every Plan</h3>
                <?php ai_design_list(['1 Month Free Access', 'Free Demo Session', 'Cashback Up To 20%', 'Secure & Reliable (AWS)', 'Access To Global Community', 'AI-Powered Smart Tools']); ?>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Cashback & Referral Program</h3>
                <p class="ai-brochure-copy">Invite. Earn. Grow Together!</p>
                <p class="ai-brochure-copy"><strong>Earn Cashback Up To 20% On Every Successful Referral</strong></p>
                <a href="sbciaipartner.php" class="ai-button">Learn More</a>
            </article>
            <article class="ai-brochure-card">
                <h3 class="ai-card-heading small">Teacher Course Sponsorship</h3>
                <p class="ai-brochure-copy">Get Sponsored & Go Global</p>
                <?php ai_design_list(['Free Course Sponsorship', 'International Promotion', 'Marketing & Branding Support', 'Access To Global Students', 'AI Tools & Content Support', 'Monetize Your Knowledge']); ?>
                <a href="sbciaisponsor.php" class="ai-button">Apply for Sponsorship</a>
            </article>
        </div>

        <div class="ai-brochure-card" style="margin-top: 22px;">
            <div class="ai-grid three">
                <div>
                    <h3 class="ai-card-heading small">One Platform. Endless Possibilities.</h3>
                    <p class="ai-brochure-copy">Empowering Egypt's Education, Today & Tomorrow.</p>
                </div>
                <a href="sbciairegistration.php" class="ai-button">Register Now<br><small>Get 1 Month Free Access</small></a>
                <a href="https://wa.me/971506264883" target="_blank" rel="noopener" class="ai-button teal">Contact Us<br><small>We're Here To Help</small></a>
            </div>
        </div>
    </div>
</section>

<?php ai_render_ai_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
