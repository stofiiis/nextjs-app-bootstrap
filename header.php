<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_TITLE : SITE_TITLE; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <!-- Logo/Brand -->
            <a href="index.php" class="logo">vectoriana</a>
            
            <!-- Navigation Menu -->
            <nav class="nav">
                <a href="index.php" class="nav-link <?php echo is_current_page('index.php') ? 'active' : ''; ?>">
                    HOME
                </a>
                <a href="about.php" class="nav-link <?php echo is_current_page('about.php') ? 'active' : ''; ?>">
                    O NÁS
                </a>
                <a href="contact.php" class="nav-link <?php echo is_current_page('contact.php') ? 'active' : ''; ?>">
                    KONTAKT
                </a>
            </nav>
        </div>
    </header>
    
    <main class="main-content">
