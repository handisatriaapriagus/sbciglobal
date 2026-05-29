<?php include 'header.php'; ?>
<section class="packages-section" id="join-us" style="padding-top: 50px;">
        <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap;">
            <!-- Left: Form -->
            <div style="flex: 1; min-width: 300px;">
                <h2 class="text-teal" style="font-size: 28px; font-weight: 600; margin-bottom: 20px;">Join Our Success Story | Your Entry to Structured International Growth</h2>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">One Ticket. Four Strategic Divisions. Unlimited Possibilities.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">At SBCI Global, we don't offer generic advice.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 15px;">We deliver structured solutions aligned with your expansion goals across Indonesia, UAE, and international markets.</p>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px;">Submit your consulting ticket and our expert division will connect with you directly via WhatsApp or Email within 24 hours.</p>

                <?php if ($form_message): ?>
                    <div style="padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #fff; background-color: <?php echo $form_status === 'success' ? '#2ecc71' : '#e74c3c'; ?>;">
                        <?php echo htmlspecialchars($form_message); ?>
                    </div>
                <?php endif; ?>

                <div style="border: 1px solid #2fb0ba; padding: 30px; border-radius: 8px;">
                    <form action="join-us.php" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">Full Name:</label>
                            <input type="text" name="full_name" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">WhatsApp Number: (with country code)</label>
                            <input type="text" name="whatsapp_number" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="color: #fff; font-size: 14px;">Email Address:</label>
                            <input type="email" name="email_address" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px;">
                        </div>

                        <div>
                            <h4 class="text-teal" style="margin-bottom: 10px; font-size: 16px;">Select Your Pack*</h4>
                            <p style="color: #888; font-size: 12px; margin-bottom: 10px;">(Multi-select available)</p>
                            <div style="display: flex; flex-direction: column; gap: 8px; color: #fff; font-size: 14px;">
                                <label><input type="checkbox" name="packs[]" value="Digital Solution Pack"> Digital Solution Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Consulting Pack"> Consulting Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Company Setup Pack"> Company Setup Pack</label>
                                <label><input type="checkbox" name="packs[]" value="Training & Development Pack"> Training & Development Pack</label>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-teal" style="margin-bottom: 10px; font-size: 16px;">Describe Your Objective*</h4>
                            <p style="color: #888; font-size: 12px; margin-bottom: 10px;">Briefly explain your current situation, challenges, or expansion goals.</p>
                            <textarea name="objective" rows="4" required style="background: transparent; border: 1px solid #555; padding: 10px; color: #fff; border-radius: 4px; width: 100%; box-sizing: border-box; resize: vertical;"></textarea>
                        </div>

                        <button type="submit" style="background-color: #2fb0ba; color: #fff; border: none; padding: 12px 20px; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; align-self: flex-start;">Send Ticket</button>
                    </form>
                </div>
            </div>

            <!-- Right: Consulting Ticket Image -->
            <div style="flex: 1; min-width: 300px; display: flex; align-items: center; justify-content: center;">
                <img src="assets/consulting_ticket.png" alt="Strategic Consulting Ticket" style="width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            </div>
        </div>
    </section>

    <!-- Final Footer / Contact Section -->
    
<?php include 'footer.php'; ?>
