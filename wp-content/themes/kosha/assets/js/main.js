/**
 * Kosha Theme JavaScript
 * 
 * @package Kosha
 */

(function() {
    'use strict';

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');

    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            navigation.classList.toggle('toggled');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navigation.contains(event.target) || menuToggle.contains(event.target);
            
            if (!isClickInside && navigation.classList.contains('toggled')) {
                navigation.classList.remove('toggled');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navigation.classList.contains('toggled')) {
                navigation.classList.remove('toggled');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.focus();
            }
        });
    }

    // Smooth Scrolling for Anchor Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Don't smooth scroll for # only
            if (href === '#') {
                return;
            }

            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                const headerOffset = 100;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Auto-generate Table of Contents for Long Articles
    function generateTableOfContents() {
        const article = document.querySelector('.entry-content');
        
        if (!article || !document.body.classList.contains('single-article')) {
            return;
        }

        const headings = article.querySelectorAll('h2, h3');
        
        if (headings.length < 3) {
            return; // Don't create TOC for short articles
        }

        const toc = document.createElement('div');
        toc.className = 'table-of-contents';
        toc.innerHTML = '<h3>Table of Contents</h3><ul class="toc-list"></ul>';
        
        const tocList = toc.querySelector('.toc-list');
        
        headings.forEach((heading, index) => {
            // Add ID to heading if it doesn't have one
            if (!heading.id) {
                heading.id = 'heading-' + index;
            }
            
            const li = document.createElement('li');
            li.className = heading.tagName.toLowerCase() === 'h3' ? 'toc-sub-item' : 'toc-item';
            
            const link = document.createElement('a');
            link.href = '#' + heading.id;
            link.textContent = heading.textContent;
            
            li.appendChild(link);
            tocList.appendChild(li);
        });
        
        // Insert TOC after the first paragraph
        const firstParagraph = article.querySelector('p');
        if (firstParagraph) {
            firstParagraph.after(toc);
        } else {
            article.insertBefore(toc, article.firstChild);
        }
    }

    // Add Table of Contents styling
    const tocStyles = `
        .table-of-contents {
            background: var(--color-cream);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            margin: var(--spacing-xl) 0;
            border-left: 4px solid var(--color-saffron);
        }
        
        .table-of-contents h3 {
            margin-top: 0;
            margin-bottom: var(--spacing-md);
            color: var(--color-deep-saffron);
        }
        
        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .toc-item {
            margin-bottom: var(--spacing-xs);
        }
        
        .toc-sub-item {
            margin-left: var(--spacing-lg);
            margin-bottom: var(--spacing-xs);
        }
        
        .toc-list a {
            color: var(--color-slate);
            text-decoration: none;
            transition: color var(--transition-base);
        }
        
        .toc-list a:hover {
            color: var(--color-deep-saffron);
        }
    `;

    const styleSheet = document.createElement('style');
    styleSheet.textContent = tocStyles;
    document.head.appendChild(styleSheet);

    // Generate TOC when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', generateTableOfContents);
    } else {
        generateTableOfContents();
    }

    // Lazy Loading for Images (if browser doesn't support native lazy loading)
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src || img.src;
        });
    } else {
        // Fallback for browsers that don't support lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }

    // Add animation on scroll
    function animateOnScroll() {
        const elements = document.querySelectorAll('.article-card, .category-card, .featured-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        entry.target.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        elements.forEach(element => {
            observer.observe(element);
        });
    }

    // Initialize animations
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', animateOnScroll);
    } else {
        animateOnScroll();
    }

    // Search Form Enhancement
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        const searchInput = searchForm.querySelector('input[type="search"]');
        
        if (searchInput) {
            searchInput.setAttribute('placeholder', 'Search cultural knowledge...');
            
            // Add search icon if not present
            if (!searchForm.querySelector('.search-icon')) {
                const searchButton = searchForm.querySelector('button');
                if (searchButton && !searchButton.textContent.trim()) {
                    searchButton.innerHTML = '<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>';
                    searchButton.setAttribute('aria-label', 'Search');
                }
            }
        }
    }

    // Back to Top Button
    const backToTop = document.createElement('button');
    backToTop.className = 'back-to-top';
    backToTop.innerHTML = '<svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor"><path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/></svg>';
    backToTop.setAttribute('aria-label', 'Back to top');
    backToTop.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--gradient-sunrise);
        color: white;
        border: none;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all var(--transition-base);
        box-shadow: var(--shadow-lg);
        z-index: 999;
    `;
    
    document.body.appendChild(backToTop);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTop.style.opacity = '1';
            backToTop.style.visibility = 'visible';
        } else {
            backToTop.style.opacity = '0';
            backToTop.style.visibility = 'hidden';
        }
    });
    
    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

})();
