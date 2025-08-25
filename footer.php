</main>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="footer-title">Kontaktujte nás!</h3>
                    <div class="contact-info">
                        <p class="contact-item">
                            <span class="contact-label">telefonicky:</span>
                            <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>" class="contact-link">
                                <?php echo COMPANY_PHONE; ?>
                            </a>
                        </p>
                        <p class="contact-item">
                            <span class="contact-label">e-mailem:</span>
                            <a href="mailto:<?php echo COMPANY_EMAIL; ?>" class="contact-link">
                                <?php echo COMPANY_EMAIL; ?>
                            </a>
                        </p>
                        <p class="contact-item">
                            <span class="contact-label">nebo</span>
                            <a href="contact.php" class="contact-link">kontaktním formulářem</a>
                        </p>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title"><?php echo COMPANY_NAME; ?></h3>
                    <div class="company-info">
                        <p class="company-address">
                            <?php echo COMPANY_ADDRESS; ?><br>
                            <?php echo COMPANY_CITY; ?>
                        </p>
                        <p class="company-details">
                            IČ: <?php echo COMPANY_IC; ?><br>
                            DIČ: <?php echo COMPANY_DIC; ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php echo COMPANY_NAME; ?>. Všechna práva vyhrazena.
                </p>
                <button class="back-to-top" id="back-to-top" aria-label="Zpět nahoru">
                    ↑
                </button>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="assets/js/script.js"></script>
</body>
</html>
