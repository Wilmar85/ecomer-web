// resources/js/components/scroll-to-top.js

/**
 * Initializes the scroll-to-top button functionality.
 */
const initScrollToTopButton = () => {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    if (!scrollToTopBtn) {
        // console.info('Scroll-to-top button not found on this page.');
        return;
    }

    // Function to check scroll position and toggle button visibility
    const toggleVisibility = () => {
        // Show button after scrolling down 300px (adjust this value as needed)
        if (window.scrollY > 120) {
            scrollToTopBtn.classList.add('is-visible');
        } else {
            scrollToTopBtn.classList.remove('is-visible');
        }
    };

    // Scroll to top function
    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Smooth scroll animation
        });
    };

    // Add event listeners
    window.addEventListener('scroll', toggleVisibility);
    scrollToTopBtn.addEventListener('click', scrollToTop);

    // Initial check in case the page is loaded with a scroll position
    toggleVisibility();
};

// Execute initialization when the DOM is ready
document.addEventListener('DOMContentLoaded', initScrollToTopButton);