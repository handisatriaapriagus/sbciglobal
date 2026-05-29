<?php
$file = 'd:\xampp\htdocs\sbciglobal\sbci_ai.css';
$content = file_get_contents($file);

$broken_css = <<<EOD
.ai-form-shell {
    width: min(1200px, calc(100vw - 32px));
    margin: 0 auto;
    grid-column: 1 / -1;
    margin: 12px 0 2px;
    padding: 14px 16px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: linear-gradient(90deg, rgba(155, 55, 255, 0.25), rgba(255, 141, 42, 0.08));
    font-weight: 800;
    text-transform: uppercase;
    color: #fff;
}
EOD;

$fixed_css = <<<EOD
.ai-form-shell {
    width: min(1200px, calc(100vw - 32px));
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(320px, 0.40fr) minmax(0, 1fr);
    gap: 22px;
    padding: 28px 0 90px;
}

.ai-form-sidebar,
.ai-form-card {
    padding: 24px;
}

.ai-form-sidebar {
    border: 1px solid var(--ai-border);
    border-radius: 8px;
    background: rgba(8, 10, 26, 0.84);
    align-self: start;
}

.ai-form-card {
    background: rgba(8, 10, 26, 0.9);
    backdrop-filter: blur(12px);
}

.ai-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
}

.ai-form-grid.three {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.ai-form-section {
    grid-column: 1 / -1;
    margin: 12px 0 2px;
    padding: 14px 16px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: linear-gradient(90deg, rgba(155, 55, 255, 0.25), rgba(255, 141, 42, 0.08));
    font-weight: 800;
    text-transform: uppercase;
    color: #fff;
}
EOD;

$content = str_replace($broken_css, $fixed_css, $content);
file_put_contents($file, $content);
echo "Fixed";
?>
