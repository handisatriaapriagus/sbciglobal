<?php

function sbci_admin_notification_recipients() {
    return [
        'info@sbciglobal.com',
        'info.sbciglobalgroup@gmail.com',
    ];
}

function sbci_notification_label($key) {
    return ucwords(str_replace('_', ' ', (string) $key));
}

function sbci_notification_scalar($value) {
    if (is_bool($value)) {
        return $value ? 'Yes' : 'No';
    }

    if ($value === null || trim((string) $value) === '') {
        return '(not provided)';
    }

    return (string) $value;
}

function sbci_append_notification_detail(&$lines, $label, $value, $indent = '') {
    if (!is_array($value)) {
        $lines[] = $indent . $label . ': ' . sbci_notification_scalar($value);
        return;
    }

    $lines[] = $indent . $label . ':';
    if (!$value) {
        $lines[] = $indent . '  (none)';
        return;
    }

    foreach ($value as $key => $item) {
        if (is_int($key)) {
            if (is_array($item)) {
                sbci_append_notification_detail($lines, '-', $item, $indent . '  ');
            } else {
                $lines[] = $indent . '  - ' . sbci_notification_scalar($item);
            }
            continue;
        }

        sbci_append_notification_detail($lines, sbci_notification_label($key), $item, $indent . '  ');
    }
}

function sbci_build_admin_notification_body($intro, $details) {
    $lines = [
        $intro,
        '',
        'Submitted At: ' . date('Y-m-d H:i:s T'),
        'Source Page: ' . basename($_SERVER['PHP_SELF'] ?? ''),
        '',
        '--- SUBMISSION DETAILS ---',
    ];

    foreach ($details as $key => $value) {
        sbci_append_notification_detail($lines, sbci_notification_label($key), $value);
    }

    return implode("\n", $lines) . "\n";
}

function sbci_send_admin_notification($subject, $intro, $details, $replyTo = '') {
    $headers = [
        'From: noreply@sbciglobal.com',
        'Content-Type: text/plain; charset=utf-8',
        'X-Mailer: PHP/' . phpversion(),
    ];

    if (filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    $safeSubject = trim(preg_replace('/[\r\n]+/', ' ', (string) $subject));
    $recipients = implode(', ', sbci_admin_notification_recipients());
    $body = sbci_build_admin_notification_body($intro, $details);

    $sent = @mail($recipients, $safeSubject, $body, implode("\r\n", $headers));
    if (!$sent) {
        error_log('SBCI admin notification could not be sent: ' . $safeSubject);
    }

    return $sent;
}

function sbci_mail_html($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function sbci_build_client_confirmation_html($options = []) {
    $brand = $options['brand'] ?? 'SBCI AI';
    $requestName = $options['request_name'] ?? 'registration request';
    $confirmation = $options['confirmation'] ?? 'Our customer support team will review your request and contact you shortly to arrange your FREE demo session and activate your selected package as soon as possible.';
    $nextSteps = $options['next_steps'] ?? [
        'Free personalized demo presentation',
        'Package activation support',
        'AI platform onboarding assistance',
        'Dedicated customer service follow-up',
    ];
    $referral = $options['referral'] ?? 'Invite your friends, university, school, or educational institution to join SBCI AI and enjoy cashback rewards up to 20% through our referral partnership program.';
    $closing = $options['closing'] ?? 'Thank you for choosing SBCI AI - Empowering Smart Education & Integrated Digital Solutions.';
    $signature = $options['signature'] ?? [
        'SBCI AI | Integrated Digital Solutions',
        'Powered by DigiGate AI',
    ];

    $stepsHtml = '';
    foreach ($nextSteps as $step) {
        $stepsHtml .= '<li style="margin:0 0 4px;">' . sbci_mail_html($step) . '</li>';
    }

    $signatureHtml = '';
    foreach ($signature as $line) {
        $signatureHtml .= sbci_mail_html($line) . '<br>';
    }

    return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Confirmation</title>
    <style>
        @media only screen and (max-width: 600px) {
            .sbci-mail-wrap { padding: 24px 18px 32px !important; }
            .sbci-mail-title { font-size: 23px !important; overflow-wrap: anywhere; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background:#ffffff;color:#111111;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:1.55;">
    <div class="sbci-mail-wrap" style="box-sizing:border-box;width:100%;max-width:1240px;margin:0 auto;padding:34px 32px 42px;">
        <h1 class="sbci-mail-title" style="margin:0 0 14px;padding:0 0 6px;border-bottom:2px solid #111111;font-size:27px;font-weight:400;line-height:1.25;">Client confirmation that received</h1>
        <p style="margin:18px 0;"><strong>Dear Valued Client,</strong></p>
        <p style="margin:18px 0;">Thank you for submitting your ' . sbci_mail_html($requestName) . ' with ' . sbci_mail_html($brand) . '.</p>
        <p style="margin:18px 0;">We are pleased to confirm that your form has been received successfully. ' . sbci_mail_html($confirmation) . '</p>
        <p style="margin:22px 0 0;"><strong>&#128640; What&apos;s Next?</strong></p>
        <ul style="margin:0 0 22px;padding-left:20px;">' . $stepsHtml . '</ul>
        <p style="margin:20px 0 0;"><strong>&#127873; Referral &amp; Cashback Program</strong></p>
        <p style="margin:0 0 22px;">' . sbci_mail_html($referral) . '</p>
        <p style="margin:22px 0;">' . sbci_mail_html($closing) . '</p>
        <p style="margin:22px 0 0;"><strong>Best Regards,</strong><br>' . $signatureHtml . '</p>
    </div>
</body>
</html>';
}

function sbci_send_client_confirmation($email, $options = []) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $subject = $options['subject'] ?? 'SBCI AI - Submission Received Successfully';
    $safeSubject = trim(preg_replace('/[\r\n]+/', ' ', (string) $subject));
    $headers = [
        'From: info@sbciglobal.com',
        'Reply-To: info@sbciglobal.com',
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=utf-8',
        'X-Mailer: PHP/' . phpversion(),
    ];

    $sent = @mail($email, $safeSubject, sbci_build_client_confirmation_html($options), implode("\r\n", $headers));
    if (!$sent) {
        error_log('SBCI client confirmation could not be sent to ' . $email . ': ' . $safeSubject);
    }

    return $sent;
}

function sbci_public_upload_url($path) {
    $path = ltrim(str_replace('\\', '/', (string) $path), '/');
    $host = $_SERVER['HTTP_HOST'] ?? '';

    if ($path === '' || $host === '' || !preg_match('/^[A-Za-z0-9.:-]+$/', $host)) {
        return $path;
    }

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $basePath = $basePath === '/' || $basePath === '.' ? '' : rtrim($basePath, '/');

    return $scheme . '://' . $host . $basePath . '/' . $path;
}
