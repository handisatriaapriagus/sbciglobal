<?php
$files = [
    'sbciaipartner.php',
    'sbciairegistration.php',
    'sbciaisponsor.php',
    'sbciaistudentregistration.php',
    'sbciteacherregistration.php',
    'universityschoolregistration.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    // Replace header
    $content = preg_replace('/<!DOCTYPE html>\s*<html lang="en">\s*<head>\s*<\?php ai_render_head\([^\)]+\);\s*\?>\s*<\/head>\s*<body[^>]*>\s*<\?php ai_render_nav\([^)]*\);\s*\?>/s', "<?php include 'header.php'; ?>", $content);
    
    // Replace footer
    $content = preg_replace('/<\?php ai_render_ai_footer\(\);\s*\?>\s*<\?php ai_render_scripts\(\);\s*\?>\s*<\/body>\s*<\/html>/s', "<?php ai_render_scripts(); ?>\n<?php include 'footer.php'; ?>", $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
?>
