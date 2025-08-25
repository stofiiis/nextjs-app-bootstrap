```markdown
# Detailed Implementation Plan for Cloning Vectoriana.com

This plan outlines how to recreate the website using only vanilla PHP, HTML, CSS, and JavaScript with a modern, timeless design and improved functionality.

---

## Project Structure

• Root directory:
  - index.php
  - about.php
  - contact.php
  - process_contact.php
  - header.php
  - footer.php
  - config.php (optional, for global settings)
• assets/
  - css/style.css
  - js/script.js
  - images/ (for any fallback/default images)

---

## File-by-File Changes and Steps

### header.php
- **Purpose:** Contains the `<head>` section (meta tags, title, links to CSS and JS) and the navigation menu.
- **Steps:**
  - Add meta tags for responsive design.
  - Link to `assets/css/style.css` and `assets/js/script.js`.
  - Create a responsive navigation menu with text links: Home (index.php), O NÁS (about.php), KONTAKT (contact.php). Include a hamburger-action for mobile devices.
  - Use semantic HTML (e.g., `<nav>`, `<ul>`, `<li>`) and incorporate JavaScript error handling by logging failures if assets fail to load.

### footer.php
- **Purpose:** Contains the footer with company contact details.
- **Steps:**
  - Display contact information (phone, email, address, company details).
  - Include copyright info.
  - Optionally, add a “back-to-top” button with smooth scrolling functionality handled in JS.

### index.php
- **Purpose:** The landing page integrating the header, hero section, service offerings, and footer.
- **Steps:**
  - Include `header.php` at the top and `footer.php` at the bottom via PHP include statements.
  - Create a hero section with a full-width `<img>` element:
    ```html
    <img src="https://placehold.co/1920x1080?text=Modern+timeless+hero+banner+for+Vectoriana+Clone" alt="Modern timeless hero banner for Vectoriana clone" onerror="this.onerror=null;this.src='assets/images/default-hero.jpg';" />
    ```
  - Add a services section with visually separated cards (using CSS Flexbox or Grid) for:
    - Architekti
    - Stavební firmy
    - Fyzické osoby
    - Státní instituce
  - Each card should include a title and a brief description, styled with modern typography and spacing.

### about.php
- **Purpose:** The “O NÁS” page presenting company background and mission.
- **Steps:**
  - Include header and footer.
  - Populate the page with descriptive text about the company.
  - Add a tasteful placeholder image:
    ```html
    <img src="https://placehold.co/800x600?text=Modern+timeless+about+us+section+image" alt="A detailed modern image showcasing the company culture and background" onerror="this.onerror=null;this.src='assets/images/default-about.jpg';" />
    ```
  - Use clean layout sections to separate content blocks for readability.

### contact.php
- **Purpose:** Displays all contact details and includes a modern contact form.
- **Steps:**
  - Include header and footer.
  - List contact information (phone, email, address, and company registration details).
  - Build a contact form with fields:
    - Jméno (Name)
    - Emailová adresa (Email)
    - Telefonní číslo (Phone)
    - Vaše zpráva (Message)
  - Set form method to POST and action to `process_contact.php`.
  - Include HTML5 attributes (e.g., `required`, `type="email"`) to enforce client-side validation.
  - Style the form with clear input fields and ample spacing.

### process_contact.php
- **Purpose:** Handles submission of the contact form and validates input.
- **Steps:**
  - Retrieve POST data and sanitize inputs using `htmlspecialchars()` or filters.
  - Validate each field (non-empty; proper email format).
  - If any input fails validation, display error messages and offer a link back to `contact.php`.
  - On successful validation, simulate emailing the details using PHP’s `mail()` function or log the entry.
  - Use proper try/catch error handling to capture unforeseen server errors and provide user-friendly error messages.

### assets/css/style.css
- **Purpose:** Provides modern styling for all pages.
- **Steps:**
  - Include a CSS reset and define base typography (e.g., font-family, line-heights).
  - Implement a timeless color palette (a dark header, light background, and accent colors for buttons).
  - Create responsive layouts using CSS Grid or Flexbox for navigation, hero, service cards, and form sections.
  - Add hover states for interactive elements and use media queries to adjust layout for mobile devices.

### assets/js/script.js
- **Purpose:** Adds interactivity and client-side behaviors.
- **Steps:**
  - Implement a hamburger menu toggle for small screens.
  - Add client-side form validation for immediate feedback on the contact page.
  - Enable smooth scroll effects and any necessary animation for content loading.
  - Ensure error handling (e.g., try-catch in event listeners) and log any critical JS errors to the console.

### config.php (Optional)
- **Purpose:** Centralizes configuration settings.
- **Steps:**
  - Define constants such as `SITE_TITLE`, contact email addresses, or error log paths.
  - Include configurations in other PHP files using `include` or `require`.

---

## Integration, Testing, and Best Practices

• **Error Handling:**  
  - Validate all user inputs both on the client side and server side.
  - Use PHP error logging and JavaScript console logs to quickly identify issues.
  - Provide fallback mechanisms (e.g., image onerror attributes) to preserve layout integrity.

• **Responsive Design & Accessibility:**  
  - Ensure that all pages work seamlessly on various devices with clear typography and sufficient contrast.
  - Include detailed and descriptive alt texts for images.
  - Use semantic HTML elements, ARIA labels, and screen-reader friendly layouts.

• **Testing:**  
  - Use browser testing (and curl commands if necessary for form submission endpoints) to ensure proper functionality.
  - Validate form submissions to check both successful responses and error scenarios.
  - Test navigation across all pages and confirm that includes (header/footer) load without error.

---

## Summary

• Set up a vanilla PHP project with separate files for the header, footer, landing page, about page, and contact handling.  
• Use modern, timeless design principles in CSS with responsive layouts and clear typography.  
• Create interactive, client-side functionality via JavaScript, including menu toggles and form validations.  
• Handle contact form submissions in process_contact.php with complete server-side validation and error handling.  
• Ensure all assets have fallbacks (e.g., onerror for images) and that input sanitation is used to prevent security issues.  
• Validate user inputs in both client-side and server-side for robust, secure functionality.  
• Test each page and endpoint to confirm responsive design and cross-device compatibility.  
• Maintain semantic HTML and accessibility best practices throughout the design.
