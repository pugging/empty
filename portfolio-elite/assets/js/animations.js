/**
 * Premium GSAP Animations
 * Portfolio Elite Theme
 */

(function() {
    'use strict';

    // Wait for DOM and GSAP to be ready
    document.addEventListener('DOMContentLoaded', function() {

        // Check if GSAP is loaded
        if (typeof gsap === 'undefined') {
            console.warn('GSAP not loaded. Loading from CDN...');
            loadGSAP();
            return;
        }

        initAnimations();
    });

    function loadGSAP() {
        // Load GSAP from CDN
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js';
        script.onload = function() {
            // Load ScrollTrigger plugin
            const scrollTrigger = document.createElement('script');
            scrollTrigger.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js';
            scrollTrigger.onload = initAnimations;
            document.head.appendChild(scrollTrigger);
        };
        document.head.appendChild(script);
    }

    function initAnimations() {
        // Register ScrollTrigger plugin
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        // Hero Section Animations
        animateHero();

        // Scroll-triggered animations
        animateOnScroll();

        // Portfolio Grid Animations
        animatePortfolioGrid();

        // Parallax Effects
        initParallax();

        // Magnetic Buttons
        initMagneticButtons();

        // Custom Cursor
        initCustomCursor();

        // Number Counters
        animateCounters();

        // Text Reveal
        textRevealAnimation();

        // 3D Card Effects
        init3DCards();
    }

    /* ================================
       HERO SECTION ANIMATIONS
       ================================ */
    function animateHero() {
        const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

        tl.from('.hero-title', {
            y: 100,
            opacity: 0,
            duration: 1.2,
            delay: 0.2
        })
        .from('.hero-subtitle', {
            y: 80,
            opacity: 0,
            duration: 1,
        }, '-=0.8')
        .from('.hero-description', {
            y: 60,
            opacity: 0,
            duration: 0.8,
        }, '-=0.6')
        .from('.cta-buttons .btn', {
            y: 40,
            opacity: 0,
            duration: 0.6,
            stagger: 0.2
        }, '-=0.4')
        .from('.hero-image', {
            scale: 0.8,
            opacity: 0,
            duration: 1.2,
        }, '-=1');

        // Floating animation for hero elements
        gsap.to('.hero-decoration', {
            y: 20,
            duration: 3,
            ease: 'sine.inOut',
            yoyo: true,
            repeat: -1
        });
    }

    /* ================================
       SCROLL-TRIGGERED ANIMATIONS
       ================================ */
    function animateOnScroll() {
        // Fade in elements
        gsap.utils.toArray('.animate-fade-in').forEach(element => {
            gsap.from(element, {
                opacity: 0,
                y: 60,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    end: 'top 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide in from left
        gsap.utils.toArray('.animate-slide-left').forEach(element => {
            gsap.from(element, {
                x: -100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide in from right
        gsap.utils.toArray('.animate-slide-right').forEach(element => {
            gsap.from(element, {
                x: 100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Scale up
        gsap.utils.toArray('.animate-scale').forEach(element => {
            gsap.from(element, {
                scale: 0.8,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Stagger animations
        gsap.utils.toArray('.animate-stagger').forEach(container => {
            const items = container.querySelectorAll('.stagger-item');
            gsap.from(items, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                scrollTrigger: {
                    trigger: container,
                    start: 'top 75%',
                    toggleActions: 'play none none reverse'
                }
            });
        });
    }

    /* ================================
       PORTFOLIO GRID ANIMATIONS
       ================================ */
    function animatePortfolioGrid() {
        const portfolioCards = document.querySelectorAll('.portfolio-card');

        portfolioCards.forEach((card, index) => {
            gsap.from(card, {
                y: 80,
                opacity: 0,
                duration: 0.8,
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });

            // Hover animation
            card.addEventListener('mouseenter', function() {
                gsap.to(card, {
                    y: -10,
                    scale: 1.02,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(card, {
                    y: 0,
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });
    }

    /* ================================
       PARALLAX EFFECTS
       ================================ */
    function initParallax() {
        // Parallax backgrounds
        gsap.utils.toArray('.parallax-bg').forEach(element => {
            gsap.to(element, {
                yPercent: 50,
                ease: 'none',
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });

        // Parallax elements
        gsap.utils.toArray('.parallax-element').forEach(element => {
            const speed = element.dataset.speed || 0.5;
            gsap.to(element, {
                y: () => -window.innerHeight * speed,
                ease: 'none',
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });
    }

    /* ================================
       MAGNETIC BUTTONS
       ================================ */
    function initMagneticButtons() {
        const buttons = document.querySelectorAll('.btn-magnetic');

        buttons.forEach(button => {
            button.addEventListener('mousemove', function(e) {
                const rect = button.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                gsap.to(button, {
                    x: x * 0.3,
                    y: y * 0.3,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            button.addEventListener('mouseleave', function() {
                gsap.to(button, {
                    x: 0,
                    y: 0,
                    duration: 0.5,
                    ease: 'elastic.out(1, 0.5)'
                });
            });
        });
    }

    /* ================================
       CUSTOM CURSOR
       ================================ */
    function initCustomCursor() {
        const cursor = document.createElement('div');
        cursor.className = 'custom-cursor';
        document.body.appendChild(cursor);

        const cursorFollower = document.createElement('div');
        cursorFollower.className = 'cursor-follower';
        document.body.appendChild(cursorFollower);

        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', function(e) {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        // Animate cursor
        gsap.ticker.add(() => {
            cursorX += (mouseX - cursorX) * 0.3;
            cursorY += (mouseY - cursorY) * 0.3;
            followerX += (mouseX - followerX) * 0.1;
            followerY += (mouseY - followerY) * 0.1;

            gsap.set(cursor, { x: cursorX, y: cursorY });
            gsap.set(cursorFollower, { x: followerX, y: followerY });
        });

        // Cursor interactions
        const interactiveElements = document.querySelectorAll('a, button, .portfolio-card');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                cursor.classList.add('active');
                cursorFollower.classList.add('active');
            });

            element.addEventListener('mouseleave', () => {
                cursor.classList.remove('active');
                cursorFollower.classList.remove('active');
            });
        });
    }

    /* ================================
       ANIMATED COUNTERS
       ================================ */
    function animateCounters() {
        const counters = document.querySelectorAll('.counter-number');

        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target || counter.textContent);

            ScrollTrigger.create({
                trigger: counter,
                start: 'top 80%',
                onEnter: () => {
                    gsap.from(counter, {
                        textContent: 0,
                        duration: 2,
                        ease: 'power2.out',
                        snap: { textContent: 1 },
                        onUpdate: function() {
                            counter.textContent = Math.ceil(counter.textContent);
                        }
                    });
                }
            });
        });
    }

    /* ================================
       TEXT REVEAL ANIMATION
       ================================ */
    function textRevealAnimation() {
        const textElements = document.querySelectorAll('.text-reveal');

        textElements.forEach(element => {
            const text = element.textContent;
            element.innerHTML = '';

            // Split text into spans
            text.split('').forEach(char => {
                const span = document.createElement('span');
                span.textContent = char === ' ' ? '\u00A0' : char;
                span.style.display = 'inline-block';
                element.appendChild(span);
            });

            // Animate each character
            gsap.from(element.querySelectorAll('span'), {
                y: 100,
                opacity: 0,
                rotationX: -90,
                stagger: 0.02,
                duration: 0.8,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });
    }

    /* ================================
       3D CARD EFFECTS
       ================================ */
    function init3DCards() {
        const cards = document.querySelectorAll('.card-3d');

        cards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                gsap.to(card, {
                    rotationX: rotateX,
                    rotationY: rotateY,
                    transformPerspective: 1000,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(card, {
                    rotationX: 0,
                    rotationY: 0,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });
        });
    }

    /* ================================
       SMOOTH SCROLL
       ================================ */
    function initSmoothScroll() {
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                e.preventDefault();
                const target = document.querySelector(href);

                if (target) {
                    gsap.to(window, {
                        duration: 1,
                        scrollTo: {
                            y: target,
                            offsetY: 100
                        },
                        ease: 'power3.inOut'
                    });
                }
            });
        });
    }

    // Initialize smooth scroll
    if (typeof gsap !== 'undefined') {
        initSmoothScroll();
    }

    /* ================================
       PAGE TRANSITIONS
       ================================ */
    function pageTransition() {
        const tl = gsap.timeline();

        tl.to('.page-transition', {
            duration: 0.5,
            scaleY: 1,
            transformOrigin: 'bottom',
            ease: 'power4.inOut'
        })
        .to('.page-transition', {
            duration: 0.5,
            scaleY: 0,
            transformOrigin: 'top',
            ease: 'power4.inOut',
            delay: 0.2
        });
    }

    // Add CSS for custom cursor
    const style = document.createElement('style');
    style.textContent = `
        .custom-cursor {
            position: fixed;
            width: 10px;
            height: 10px;
            background: var(--color-primary-500);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.2s ease;
        }

        .custom-cursor.active {
            transform: scale(2);
        }

        .cursor-follower {
            position: fixed;
            width: 40px;
            height: 40px;
            border: 2px solid var(--color-primary-500);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            opacity: 0.5;
            transition: transform 0.3s ease;
        }

        .cursor-follower.active {
            transform: scale(1.5);
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .custom-cursor,
            .cursor-follower {
                display: none;
            }
        }
    `;
    document.head.appendChild(style);

})();
