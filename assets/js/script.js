// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all functionality
    initMobileNavigation();
    initBackToTop();
    initFormValidation();
    initSmoothScrolling();
    
    console.log('Vectoriana website initialized successfully');
});

// Mobile Navigation Toggle
function initMobileNavigation() {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            try {
                navToggle.classList.toggle('active');
                navMenu.classList.toggle('active');
                
                // Prevent body scroll when menu is open
                if (navMenu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            } catch (error) {
                console.error('Error toggling mobile navigation:', error);
            }
        });
        
        // Close menu when clicking on nav links
        const navLinks = navMenu.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
}

// Back to Top Button
function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            try {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            } catch (error) {
                console.error('Error handling scroll event:', error);
            }
        });
        
        // Smooth scroll to top when clicked
        backToTopButton.addEventListener('click', function() {
            try {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.error('Error scrolling to top:', error);
                // Fallback for older browsers
                window.scrollTo(0, 0);
            }
        });
    }
}

// Form Validation
function initFormValidation() {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        // Real-time validation
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(input);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(input);
            });
        });
        
        // Form submission validation
        contactForm.addEventListener('submit', function(event) {
            try {
                let isValid = true;
                
                // Validate all fields
                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    event.preventDefault();
                    
                    // Focus on first error field
                    const firstError = contactForm.querySelector('.form-input.error, .form-textarea.error');
                    if (firstError) {
                        firstError.focus();
                    }
                }
            } catch (error) {
                console.error('Error validating form:', error);
                event.preventDefault();
            }
        });
    }
}

// Field Validation Function
function validateField(field) {
    const fieldName = field.name;
    const fieldValue = field.value.trim();
    const errorElement = document.getElementById(fieldName + '-error');
    
    let isValid = true;
    let errorMessage = '';
    
    try {
        // Clear previous errors
        clearFieldError(field);
        
        switch (fieldName) {
            case 'name':
                if (!fieldValue) {
                    errorMessage = 'Jméno je povinné pole.';
                    isValid = false;
                } else if (fieldValue.length < 2) {
                    errorMessage = 'Jméno musí obsahovat alespoň 2 znaky.';
                    isValid = false;
                } else if (fieldValue.length > 100) {
                    errorMessage = 'Jméno je příliš dlouhé (maximum 100 znaků).';
                    isValid = false;
                }
                break;
                
            case 'email':
                if (!fieldValue) {
                    errorMessage = 'Emailová adresa je povinné pole.';
                    isValid = false;
                } else if (!isValidEmail(fieldValue)) {
                    errorMessage = 'Emailová adresa není ve správném formátu.';
                    isValid = false;
                } else if (fieldValue.length > 255) {
                    errorMessage = 'Emailová adresa je příliš dlouhá.';
                    isValid = false;
                }
                break;
                
            case 'phone':
                if (fieldValue && !isValidPhone(fieldValue)) {
                    errorMessage = 'Telefonní číslo není ve správném formátu.';
                    isValid = false;
                }
                break;
                
            case 'message':
                if (!fieldValue) {
                    errorMessage = 'Zpráva je povinné pole.';
                    isValid = false;
                } else if (fieldValue.length < 10) {
                    errorMessage = 'Zpráva musí obsahovat alespoň 10 znaků.';
                    isValid = false;
                } else if (fieldValue.length > 2000) {
                    errorMessage = 'Zpráva je příliš dlouhá (maximum 2000 znaků).';
                    isValid = false;
                }
                break;
        }
        
        if (!isValid) {
            showFieldError(field, errorMessage);
        }
        
    } catch (error) {
        console.error('Error validating field:', error);
        isValid = false;
    }
    
    return isValid;
}

// Show Field Error
function showFieldError(field, message) {
    const errorElement = document.getElementById(field.name + '-error');
    
    field.classList.add('error');
    field.style.borderColor = '#dc2626';
    
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

// Clear Field Error
function clearFieldError(field) {
    const errorElement = document.getElementById(field.name + '-error');
    
    field.classList.remove('error');
    field.style.borderColor = '';
    
    if (errorElement) {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
}

// Email Validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone Validation (Czech format)
function isValidPhone(phone) {
    const phoneClean = phone.replace(/\s+/g, '');
    const phoneRegex = /^(\+420)?[0-9]{9}$/;
    return phoneRegex.test(phoneClean);
}

// Smooth Scrolling for Anchor Links
function initSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            try {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    event.preventDefault();
                    
                    const offsetTop = targetElement.offsetTop - 80; // Account for fixed header
                    
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            } catch (error) {
                console.error('Error with smooth scrolling:', error);
            }
        });
    });
}

// Image Error Handling
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    
    images.forEach(img => {
        img.addEventListener('error', function() {
            console.warn('Image failed to load:', this.src);
            
            // Add a fallback class for styling
            this.classList.add('image-error');
            
            // You could also set a default fallback image here
            // this.src = 'assets/images/default-fallback.jpg';
        });
    });
});

// Performance: Lazy Loading for Images (if supported)
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    });
    
    // Observe images with data-src attribute
    document.addEventListener('DOMContentLoaded', function() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    });
}

// Accessibility: Keyboard Navigation
document.addEventListener('keydown', function(event) {
    // ESC key closes mobile menu
    if (event.key === 'Escape') {
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        
        if (navMenu && navMenu.classList.contains('active')) {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
});

// Error Handling for Global JavaScript Errors
window.addEventListener('error', function(event) {
    console.error('JavaScript error:', event.error);
    // You could send this to a logging service in production
});

// Utility Functions
const Utils = {
    // Debounce function for performance
    debounce: function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    // Throttle function for scroll events
    throttle: function(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
};

// Export for potential module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initMobileNavigation,
        initBackToTop,
        initFormValidation,
        initSmoothScrolling,
        Utils
    };
}
