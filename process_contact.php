<?php
require_once 'config.php';

// Initialize variables
$errors = [];
$form_data = [];

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['form_error'] = 'Neplatný způsob odeslání formuláře.';
    header('Location: contact.php');
    exit;
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['form_error'] = 'Bezpečnostní token není platný. Zkuste to prosím znovu.';
    header('Location: contact.php');
    exit;
}

// Sanitize and validate input data
function validate_input($data) {
    return trim(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}

// Get and sanitize form data
$name = validate_input($_POST['name'] ?? '');
$email = validate_input($_POST['email'] ?? '');
$phone = validate_input($_POST['phone'] ?? '');
$message = validate_input($_POST['message'] ?? '');

// Store form data for repopulation on error
$form_data = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message
];

// Validation rules
if (empty($name)) {
    $errors[] = 'Jméno je povinné pole.';
} elseif (strlen($name) < 2) {
    $errors[] = 'Jméno musí obsahovat alespoň 2 znaky.';
} elseif (strlen($name) > 100) {
    $errors[] = 'Jméno je příliš dlouhé (maximum 100 znaků).';
}

if (empty($email)) {
    $errors[] = 'Emailová adresa je povinné pole.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Emailová adresa není ve správném formátu.';
} elseif (strlen($email) > 255) {
    $errors[] = 'Emailová adresa je příliš dlouhá.';
}

if (!empty($phone)) {
    // Remove spaces and validate phone format
    $phone_clean = preg_replace('/\s+/', '', $phone);
    if (!preg_match('/^(\+420)?[0-9]{9}$/', $phone_clean)) {
        $errors[] = 'Telefonní číslo není ve správném formátu.';
    }
}

if (empty($message)) {
    $errors[] = 'Zpráva je povinné pole.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Zpráva musí obsahovat alespoň 10 znaků.';
} elseif (strlen($message) > 2000) {
    $errors[] = 'Zpráva je příliš dlouhá (maximum 2000 znaků).';
}

// Check for spam (simple honeypot and rate limiting)
if (isset($_POST['website']) && !empty($_POST['website'])) {
    // Honeypot field filled - likely spam
    $_SESSION['form_error'] = 'Formulář nebyl odeslán správně.';
    header('Location: contact.php');
    exit;
}

// Rate limiting - check if user submitted form recently
$rate_limit_key = 'last_form_submission_' . $_SERVER['REMOTE_ADDR'];
if (isset($_SESSION[$rate_limit_key])) {
    $last_submission = $_SESSION[$rate_limit_key];
    if (time() - $last_submission < 60) { // 1 minute cooldown
        $errors[] = 'Formulář můžete odeslat pouze jednou za minutu.';
    }
}

// If there are validation errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['form_error'] = implode('<br>', $errors);
    $_SESSION['form_data'] = $form_data;
    header('Location: contact.php');
    exit;
}

// Process the form (send email, save to database, etc.)
try {
    // Set rate limit
    $_SESSION[$rate_limit_key] = time();
    
    // Prepare email content
    $email_subject = 'Nová zpráva z kontaktního formuláře - ' . SITE_TITLE;
    $email_body = "
Nová zpráva z kontaktního formuláře:

Jméno: {$name}
Email: {$email}
Telefon: " . (!empty($phone) ? $phone : 'Neuvedeno') . "

Zpráva:
{$message}

---
Odesláno: " . date('d.m.Y H:i:s') . "
IP adresa: {$_SERVER['REMOTE_ADDR']}
";

    // Email headers
    $headers = [
        'From' => 'noreply@' . $_SERVER['HTTP_HOST'],
        'Reply-To' => $email,
        'X-Mailer' => 'PHP/' . phpversion(),
        'Content-Type' => 'text/plain; charset=UTF-8'
    ];
    
    $headers_string = '';
    foreach ($headers as $key => $value) {
        $headers_string .= $key . ': ' . $value . "\r\n";
    }
    
    // Send email (in production, you might want to use a proper mail library)
    $mail_sent = mail(COMPANY_EMAIL, $email_subject, $email_body, $headers_string);
    
    // Log the submission (you can also save to database here)
    $log_entry = date('Y-m-d H:i:s') . " - Form submission from: {$name} ({$email})\n";
    error_log($log_entry, 3, 'contact_submissions.log');
    
    // Success message
    $_SESSION['form_success'] = 'Děkujeme za vaši zprávu! Odpovíme vám co nejdříve na uvedený email.';
    
    // Generate new CSRF token for security
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    
} catch (Exception $e) {
    // Log the error
    error_log('Contact form error: ' . $e->getMessage());
    
    // User-friendly error message
    $_SESSION['form_error'] = 'Při odesílání zprávy došlo k chybě. Zkuste to prosím později nebo nás kontaktujte přímo na ' . COMPANY_EMAIL . '.';
    $_SESSION['form_data'] = $form_data;
}

// Redirect back to contact page
header('Location: contact.php');
exit;
?>
