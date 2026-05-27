<?php
require_once 'sbci_ai_common.php';

$result = ai_handle_submission(
    $pdo,
    'partner',
    [
        'full_name' => 'Full Name',
        'email_address' => 'Email Address',
        'whatsapp_number' => 'Mobile Number / WhatsApp',
        'country' => 'Country',
        'city' => 'City',
        'partner_type' => 'Partner Type',
        'target_audience' => 'Target Audience',
        'referral_goal' => 'Referral Goal',
        'terms_agreement' => 'Terms agreement',
    ],
    ['profile_attachment' => 'Profile Attachment']
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ai_render_head('SBCI AI Partner and Referral Program'); ?>
</head>
<body class="ai-page ai-form-page">
<?php ai_render_nav('partner'); ?>

<main class="ai-form-hero" style="--form-hero-image: url('assets/0f395fbe-d33e-4557-b364-80ece7c038b9.jpg');">
    <div class="ai-form-title">
        <p class="ai-kicker">Referral & Cashback Program</p>
        <h1>Refer, Earn & Grow <span class="ai-gradient-text">with SBCI AI</span></h1>
        <p>Invite • Inspire • Earn Together<br>Empowering Egypt's Education, Today & Tomorrow.</p>
        <div class="ai-chip-line">
            <span class="ai-pill"><?php echo ai_icon('coins'); ?>Cashback Up To 20%</span>
            <span class="ai-pill"><?php echo ai_icon('gift'); ?>Earn More Unlock More</span>
            <span class="ai-pill"><?php echo ai_icon('ai'); ?>No Limits</span>
            <span class="ai-pill"><?php echo ai_icon('users'); ?>Global Community</span>
            <span class="ai-pill"><?php echo ai_icon('shield'); ?>Trusted & Secure</span>
        </div>
    </div>
</main>

<section class="ai-section">
    <div class="ai-container">
        <div class="ai-grid four">
            <article class="ai-card"><h3>Cashback Up To 20%</h3><p>Earn on every successful referral based on the selected plan.</p></article>
            <article class="ai-card warm"><h3>No Limits</h3><p>Unlimited earning potential through consistent referral activity.</p></article>
            <article class="ai-card"><h3>Global Community</h3><p>Connect, collaborate, and grow with education communities.</p></article>
            <article class="ai-card warm"><h3>Trusted and Secure</h3><p>Transparent tracking and structured partner support.</p></article>
        </div>
    </div>
</section>

<section class="ai-form-shell">
    <aside class="ai-form-sidebar">
        <h2>How it works</h2>
        <ul class="ai-list">
            <li><strong>SHARE:</strong> Share your unique referral link or code with your network.</li>
            <li><strong>JOIN:</strong> Your friend joins SBCI AI platform using your referral link/code.</li>
            <li><strong>SUBSCRIBE:</strong> They subscribe to any paid plan.</li>
            <li><strong>YOU EARN:</strong> You earn instant cashback based on their subscription plan.</li>
            <li><strong>GROW TOGETHER:</strong> Both you and your friend enjoy premium features and grow together.</li>
        </ul>

        <h2 style="margin-top: 28px;">Why Join Our Referral Program?</h2>
        <ul class="ai-list">
            <li>Easy to Join & Start Earning</li>
            <li>Instant Cashback on Success</li>
            <li>Attract More, Earn More</li>
            <li>No Investment Required</li>
            <li>Exclusive Rewards & Bonuses</li>
            <li>Transparent & Real-Time Tracking</li>
            <li>Support Education & Build a Better Future</li>
        </ul>

        <h2 style="margin-top: 28px;">Agent Levels</h2>
        <ul class="ai-list">
            <li>Starter Agent: Refer 5 Paid Users. Up to 15% Commission.</li>
            <li>Silver Agent: Refer 20 Paid Users. Up to 18% Commission.</li>
            <li>Gold Agent: Refer 50 Paid Users. Up to 20% Commission.</li>
            <li>Platinum Agent: Refer 100 Paid Users. Up to 22% Commission.</li>
            <li>Diamond Agent: Refer 200+ Paid Users. Up to 25% Commission.</li>
        </ul>
    </aside>

    <div class="ai-form-card">
        <?php ai_alert($result); ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ai_form_type" value="partner">
            <div class="ai-form-grid">
                <div class="ai-form-section">Partner Information</div>
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
                    <label for="country">Country *</label>
                    <input id="country" name="country" type="text" value="<?php echo ai_old('country'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="city">City *</label>
                    <input id="city" name="city" type="text" value="<?php echo ai_old('city'); ?>" required>
                </div>
                <div class="ai-field">
                    <label for="partner_type">Partner Type *</label>
                    <select id="partner_type" name="partner_type" required>
                        <option value="">Select</option>
                        <?php ai_options(['Student', 'Teacher', 'Institution', 'Organization', 'Marketing Partner', 'Education Consultant', 'Other'], $_POST['partner_type'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="current_role">Current Role / Profession</label>
                    <input id="current_role" name="current_role" type="text" value="<?php echo ai_old('current_role'); ?>">
                </div>

                <div class="ai-form-section">Referral Plan</div>
                <div class="ai-field">
                    <label for="target_audience">Target Audience *</label>
                    <select id="target_audience" name="target_audience" required>
                        <option value="">Select</option>
                        <?php ai_options(['Students', 'Teachers', 'Schools', 'Universities', 'Training Centers', 'Mixed Audience'], $_POST['target_audience'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="referral_goal">Referral Goal *</label>
                    <select id="referral_goal" name="referral_goal" required>
                        <option value="">Select</option>
                        <?php ai_options(['5 paid users', '20 paid users', '50 paid users', '100 paid users', '200+ paid users', 'Institution partnership'], $_POST['referral_goal'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field full">
                    <label for="promotion_channels">Promotion Channels</label>
                    <input id="promotion_channels" name="promotion_channels" type="text" placeholder="Instagram, LinkedIn, WhatsApp groups, school network, events" value="<?php echo ai_old('promotion_channels'); ?>">
                </div>
                <div class="ai-field full">
                    <p class="ai-choice-title">Which SBCI AI offers do you want to promote?</p>
                    <div class="ai-choice-grid">
                        <?php foreach (['Student Plans', 'Teacher Plans', 'Institution Plans', 'Course Sponsorship', 'Free Demo', 'Cashback Program'] as $offer): ?>
                            <label class="ai-check-card"><input type="checkbox" name="offers_to_promote[]" value="<?php echo ai_h($offer); ?>" <?php echo ai_is_checked('offers_to_promote', $offer); ?>><?php echo ai_h($offer); ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="ai-field full">
                    <label for="network_description">Describe your network and referral strategy</label>
                    <textarea id="network_description" name="network_description"><?php echo ai_old('network_description'); ?></textarea>
                </div>

                <div class="ai-form-section">Cashback and Payout</div>
                <div class="ai-field">
                    <label for="preferred_payout">Preferred Payout Method</label>
                    <select id="preferred_payout" name="preferred_payout">
                        <option value="">Select</option>
                        <?php ai_options(['Wallet', 'Bank Transfer', 'Mobile Money', 'Other'], $_POST['preferred_payout'] ?? ''); ?>
                    </select>
                </div>
                <div class="ai-field">
                    <label for="profile_attachment">Profile Attachment (Optional)</label>
                    <input id="profile_attachment" name="profile_attachment" type="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                </div>
                <div class="ai-field full">
                    <label class="ai-check-card"><input type="checkbox" name="terms_agreement" value="Agreed" required <?php echo ai_is_checked('terms_agreement', 'Agreed'); ?>>I agree to SBCI AI partner program rules, transparent tracking, and referral verification.</label>
                </div>
                <div class="ai-submit-row">
                    <a href="sbciairegistration.php" class="ai-button secondary">Back to Portals</a>
                    <button class="ai-button" type="submit">Join Now and Start Earning</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="ai-section ai-alt">
    <div class="ai-container">
        <div class="ai-section-head">
            <div>
                <p class="ai-section-kicker">Cashback structure</p>
                <h2>Earn up to 20% cashback on every successful referral.</h2>
            </div>
        </div>
        <div class="ai-comparison">
            <table>
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Student Basic</th>
                        <th>Student Advance</th>
                        <th>Student Pro</th>
                        <th>Teacher Basic</th>
                        <th>Teacher Pro</th>
                        <th>Smart School</th>
                        <th>Smart University</th>
                        <th>White Label Platform</th>
                        <th>National Partnership</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cashback Rate</td>
                        <td>10%</td>
                        <td>15%</td>
                        <td>20%</td>
                        <td>15%</td>
                        <td>20%</td>
                        <td>Up to 15%</td>
                        <td>Up to 15%</td>
                        <td>Up to 20%</td>
                        <td>Up to 20%</td>
                    </tr>
                    <tr>
                        <td>Example Earning</td>
                        <td>25 EGP</td>
                        <td>67.5 EGP</td>
                        <td>150 EGP</td>
                        <td>75 EGP</td>
                        <td>180 EGP</td>
                        <td>Custom</td>
                        <td>Custom</td>
                        <td>Custom</td>
                        <td>Custom</td>
                    </tr>
                    <tr>
                        <td>Payout</td>
                        <td colspan="10">Wallet / Bank Transfer / Mobile Money after verification</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="ai-grid three" style="margin-top: 22px;">
            <article class="ai-card">
                <h3>How To Maximize Your Earnings?</h3>
                <ul class="ai-list">
                    <li>Share your link on social media</li>
                    <li>Create educational content & promote</li>
                    <li>Connect with students, teachers & institutions</li>
                    <li>Offer value, build trust & inspire others</li>
                    <li>Track performance & improve continuously</li>
                </ul>
            </article>
            <article class="ai-card warm">
                <h3>Earn Up To 20% Cashback</h3>
                <p>On Every Successful Referral!</p>
            </article>
            <article class="ai-card">
                <h3>Who Can Join?</h3>
                <p>Students, Teachers, Institutions, Organizations, Anyone who wants to make an impact.</p>
            </article>
        </div>
    </div>
</section>

<?php ai_render_ai_footer(); ?>
<?php ai_render_scripts(); ?>
</body>
</html>
