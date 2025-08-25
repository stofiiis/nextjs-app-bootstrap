<?php
$page_title = 'Kontakt';
include 'header.php';

// Handle form submission feedback
$success_message = '';
$error_message = '';

if (isset($_SESSION['form_success'])) {
    $success_message = $_SESSION['form_success'];
    unset($_SESSION['form_success']);
}

if (isset($_SESSION['form_error'])) {
    $error_message = $_SESSION['form_error'];
    unset($_SESSION['form_error']);
}
?>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="contact-hero-container">
        <div class="contact-hero-content">
            <div class="section-badge">Kontakt</div>
            <h1 class="contact-hero-title">Pojďme spolupracovat</h1>
            <p class="contact-hero-subtitle">
                Máte projekt? Potřebujete poradit? Kontaktujte nás a získejte nezávaznou cenovou nabídku do 24 hodin.
            </p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="contact-content-v2">
    <div class="contact-content-v2-container">
        
        <!-- Contact Form Section -->
        <div class="contact-form-v2-section">
            <div class="contact-form-v2-header">
                <h2 class="contact-form-v2-title">Pošlete nám zprávu</h2>
                <p class="contact-form-v2-subtitle">Vyplňte formulář a my se vám ozveme co nejdříve</p>
            </div>
            
            <!-- Success/Error Messages -->
            <?php if ($success_message): ?>
                <div class="alert-v2 alert-success-v2">
                    <div class="alert-icon-v2">✅</div>
                    <div class="alert-text-v2"><?php echo safe_output($success_message); ?></div>
                </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="alert-v2 alert-error-v2">
                    <div class="alert-icon-v2">❌</div>
                    <div class="alert-text-v2"><?php echo safe_output($error_message); ?></div>
                </div>
            <?php endif; ?>
            
            <form class="contact-form-v2" method="POST" action="process_contact.php" novalidate>
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="form-row">
                    <!-- Name Field -->
                    <div class="form-group-v2">
                        <label for="name" class="form-label-v2">Jméno *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input-v2" 
                               placeholder="Vaše jméno"
                               required
                               value="<?php echo isset($_SESSION['form_data']['name']) ? safe_output($_SESSION['form_data']['name']) : ''; ?>">
                        <span class="form-error-v2" id="name-error"></span>
                    </div>
                    
                    <!-- Email Field -->
                    <div class="form-group-v2">
                        <label for="email" class="form-label-v2">Email *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-input-v2" 
                               placeholder="vas@email.cz"
                               required
                               value="<?php echo isset($_SESSION['form_data']['email']) ? safe_output($_SESSION['form_data']['email']) : ''; ?>">
                        <span class="form-error-v2" id="email-error"></span>
                    </div>
                </div>
                
                <!-- Phone Field -->
                <div class="form-group-v2">
                    <label for="phone" class="form-label-v2">Telefonní číslo</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           class="form-input-v2" 
                           placeholder="+420 123 456 789"
                           value="<?php echo isset($_SESSION['form_data']['phone']) ? safe_output($_SESSION['form_data']['phone']) : ''; ?>">
                    <span class="form-error-v2" id="phone-error"></span>
                </div>
                
                <!-- Message Field -->
                <div class="form-group-v2">
                    <label for="message" class="form-label-v2">Vaše zpráva *</label>
                    <textarea id="message" 
                              name="message" 
                              class="form-textarea-v2" 
                              placeholder="Popište váš projekt nebo dotaz..."
                              rows="6"
                              required><?php echo isset($_SESSION['form_data']['message']) ? safe_output($_SESSION['form_data']['message']) : ''; ?></textarea>
                    <span class="form-error-v2" id="message-error"></span>
                </div>
                
                <!-- Submit Button -->
                <div class="form-group-v2">
                    <button type="submit" class="form-submit-v2">
                        <span>Odeslat zprávu</span>
                        <div class="btn-arrow">→</div>
                    </button>
                </div>
                
                <p class="form-note-v2">* Povinná pole</p>
            </form>
        </div>
        
        <!-- Contact Information -->
        <div class="contact-info-v2-section">
            <div class="contact-info-v2-header">
                <h2 class="contact-info-v2-title">Kontaktní informace</h2>
                <p class="contact-info-v2-subtitle">Můžete nás kontaktovat také přímo</p>
            </div>
            
            <div class="contact-cards-v2">
                <!-- Main Office -->
                <div class="contact-card-v2">
                    <div class="contact-card-v2-header">
                        <div class="contact-card-v2-icon">🏢</div>
                        <h3 class="contact-card-v2-title"><?php echo COMPANY_NAME; ?></h3>
                    </div>
                    <div class="contact-card-v2-content">
                        <div class="contact-item-v2">
                            <div class="contact-item-v2-icon">📍</div>
                            <div class="contact-item-v2-text">
                                <?php echo COMPANY_ADDRESS; ?><br>
                                <?php echo COMPANY_CITY; ?>
                            </div>
                        </div>
                        <div class="contact-item-v2">
                            <div class="contact-item-v2-icon">📞</div>
                            <div class="contact-item-v2-text">
                                <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>" class="contact-link-v2">
                                    <?php echo COMPANY_PHONE; ?>
                                </a>
                            </div>
                        </div>
                        <div class="contact-item-v2">
                            <div class="contact-item-v2-icon">✉️</div>
                            <div class="contact-item-v2-text">
                                <a href="mailto:<?php echo COMPANY_EMAIL; ?>" class="contact-link-v2">
                                    <?php echo COMPANY_EMAIL; ?>
                                </a>
                            </div>
                        </div>
                        <div class="contact-details-v2">
                            <p>IČ: <?php echo COMPANY_IC; ?></p>
                            <p>DIČ: <?php echo COMPANY_DIC; ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Plzen Branch -->
                <div class="contact-card-v2">
                    <div class="contact-card-v2-header">
                        <div class="contact-card-v2-icon">🏪</div>
                        <h3 class="contact-card-v2-title">Pobočka Plzeň</h3>
                    </div>
                    <div class="contact-card-v2-content">
                        <div class="contact-item-v2">
                            <div class="contact-item-v2-icon">📍</div>
                            <div class="contact-item-v2-text">
                                <?php echo PLZEN_ADDRESS; ?><br>
                                <?php echo PLZEN_CITY; ?>
                            </div>
                        </div>
                        <div class="contact-item-v2">
                            <div class="contact-item-v2-icon">✉️</div>
                            <div class="contact-item-v2-text">
                                <a href="mailto:<?php echo PLZEN_EMAIL; ?>" class="contact-link-v2">
                                    <?php echo PLZEN_EMAIL; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Contact -->
            <div class="quick-contact-v2">
                <h3 class="quick-contact-v2-title">Rychlý kontakt</h3>
                <div class="quick-contact-v2-items">
                    <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>" class="quick-contact-v2-item">
                        <div class="quick-contact-v2-icon">📞</div>
                        <div class="quick-contact-v2-text">
                            <div class="quick-contact-v2-label">Zavolejte nám</div>
                            <div class="quick-contact-v2-value"><?php echo COMPANY_PHONE; ?></div>
                        </div>
                    </a>
                    <a href="mailto:<?php echo COMPANY_EMAIL; ?>" class="quick-contact-v2-item">
                        <div class="quick-contact-v2-icon">✉️</div>
                        <div class="quick-contact-v2-text">
                            <div class="quick-contact-v2-label">Napište nám</div>
                            <div class="quick-contact-v2-value"><?php echo COMPANY_EMAIL; ?></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- Contact CTA -->
<section class="contact-cta-v2">
    <div class="contact-cta-v2-container">
        <div class="contact-cta-v2-content">
            <h2 class="contact-cta-v2-title">Potřebujete rychlou odpověď?</h2>
            <p class="contact-cta-v2-subtitle">
                Pro urgentní dotazy nás kontaktujte přímo telefonicky
            </p>
            <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>" class="contact-cta-v2-button">
                <span class="contact-cta-v2-icon">📞</span>
                <span>Zavolat nyní: <?php echo COMPANY_PHONE; ?></span>
            </a>
        </div>
    </div>
</section>

<?php 
// Clear form data after displaying
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
}
include 'footer.php'; 
?>
