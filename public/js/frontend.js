// ====================================
// PORTFOLIO JAVASCRIPT
// Handles dynamic content loading, animations, and interactions
// ====================================

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializePortfolio();
    setupEventListeners();
    setupIntersectionObserver();
    setupSmoothScroll();
});

// ====================================
// INITIALIZE PORTFOLIO
// ====================================
function initializePortfolio() {
    renderSkills();
    renderProjects();
    updateNavOnScroll();
}

// ====================================
// RENDER SKILLS
// ====================================
function renderSkills() {
    const skillsContainer = document.getElementById('skills-container');
    if (!skillsContainer) return;

    const skillsHTML = portfolioData.skills.map(skill => `
        <div class="skill-card glass-card fade-in">
            <div class="skill-icon">${skill.icon}</div>
            <h3 class="skill-name">${skill.name}</h3>
            <p class="skill-level">${skill.level}</p>
        </div>
    `).join('');

    skillsContainer.innerHTML = skillsHTML;
}

// ====================================
// RENDER PROJECTS
// ====================================
function renderProjects() {
    const projectsContainer = document.getElementById('projects-container');
    if (!projectsContainer) return;

    const projectsHTML = portfolioData.projects.map(project => `
        <article class="project-card glass-card fade-in">
            <img src="${project.image}" 
                 alt="${project.title} project screenshot" 
                 class="project-image" 
                 loading="lazy"
                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E${project.title}%3C/text%3E%3C/svg%3E'">
            <div class="project-content">
                <h3 class="project-title">${project.title}</h3>
                <p class="project-description">${project.description}</p>
                <div class="project-tags">
                    ${project.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
                </div>
                <div class="project-links">
                    <a href="${project.githubUrl}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="View ${project.title} on GitHub">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                        </svg>
                        Code
                    </a>
                    <a href="${project.liveUrl}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="View live demo of ${project.title}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                        Live Demo
                    </a>
                </div>
            </div>
        </article>
    `).join('');

    projectsContainer.innerHTML = projectsHTML;
}

// ====================================
// EVENT LISTENERS
// ====================================
function setupEventListeners() {
    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            const isExpanded = navLinks.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded);
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // Contact Form Submission
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleFormSubmit);
    }

    // Add hover effect to glass cards
    const glassCards = document.querySelectorAll('.glass-card');
    glassCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// ====================================
// FORM SUBMISSION
// ====================================
function handleFormSubmit(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };

    // Simulate form submission (replace with actual API call)
    console.log('Form submitted:', formData);
    
    // Show success message
    showNotification('Message sent successfully! I\'ll get back to you soon.', 'success');
    
    // Reset form
    e.target.reset();
}

// ====================================
// NOTIFICATION SYSTEM
// ====================================
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? 'linear-gradient(135deg, #06b6d4, #8b5cf6)' : '#ef4444'};
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        backdrop-filter: blur(10px);
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ====================================
// INTERSECTION OBSERVER FOR ANIMATIONS
// ====================================
function setupIntersectionObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Add stagger effect for children
                const children = entry.target.querySelectorAll('.glass-card, .skill-card, .project-card');
                children.forEach((child, index) => {
                    setTimeout(() => {
                        child.style.opacity = '1';
                        child.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }
        });
    }, observerOptions);

    // Observe sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Initial setup for cards
    document.querySelectorAll('.glass-card:not(.footer-content), .skill-card, .project-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
}

// ====================================
// SMOOTH SCROLL
// ====================================
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ====================================
// UPDATE NAVIGATION ON SCROLL
// ====================================
function updateNavOnScroll() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');
    const nav = document.querySelector('.glass-nav');

    window.addEventListener('scroll', () => {
        // Add shadow to nav on scroll
        if (window.scrollY > 50) {
            nav.style.boxShadow = '0 10px 40px rgba(139, 92, 246, 0.3)';
        } else {
            nav.style.boxShadow = 'var(--glass-shadow)';
        }

        // Highlight active section
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
}

// ====================================
// PARALLAX EFFECT FOR BACKGROUND BLOBS
// ====================================
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const blobs = document.querySelectorAll('.blob');
    
    blobs.forEach((blob, index) => {
        const speed = (index + 1) * 0.05;
        blob.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// ====================================
// TYPING EFFECT FOR HERO SUBTITLE (OPTIONAL)
// ====================================
function typingEffect(element, text, speed = 100) {
    let i = 0;
    element.textContent = '';
    
    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }
    
    type();
}

// ====================================
// CURSOR FOLLOW EFFECT (OPTIONAL ENHANCEMENT)
// ====================================
function setupCursorEffect() {
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.style.cssText = `
        width: 20px;
        height: 20px;
        border: 2px solid #8b5cf6;
        border-radius: 50%;
        position: fixed;
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.2s ease;
        display: none;
    `;
    document.body.appendChild(cursor);

    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        cursor.style.display = 'block';
    });

    // Scale up on clickable elements
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(1.5)';
            cursor.style.borderColor = '#06b6d4';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
            cursor.style.borderColor = '#8b5cf6';
        });
    });
}

// Optional: Uncomment to enable custom cursor
// setupCursorEffect();

// ====================================
// PERFORMANCE OPTIMIZATION
// ====================================

// Lazy load images
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.src = img.src;
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
}

// ====================================
// THEME PERSISTENCE (FOR FUTURE DARK/LIGHT MODE)
// ====================================
function saveThemePreference(theme) {
    localStorage.setItem('portfolio-theme', theme);
}

function loadThemePreference() {
    return localStorage.getItem('portfolio-theme') || 'dark';
}

// ====================================
// KEYBOARD NAVIGATION ACCESSIBILITY
// ====================================
document.addEventListener('keydown', (e) => {
    // Escape key to close mobile menu
    if (e.key === 'Escape') {
        const navLinks = document.querySelector('.nav-links');
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        if (navLinks.classList.contains('active')) {
            navLinks.classList.remove('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
        }
    }
});

// ====================================
// CONSOLE MESSAGE
// ====================================
console.log('%c🚀 Welcome to My Portfolio! ', 'background: linear-gradient(135deg, #8b5cf6, #06b6d4); color: white; font-size: 20px; padding: 10px; border-radius: 5px;');
console.log('%cFeel free to explore the code! 💻', 'color: #06b6d4; font-size: 14px;');

// ====================================
// EXPORT FOR TESTING (IF NEEDED)
// ====================================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        renderSkills,
        renderProjects,
        handleFormSubmit,
        showNotification
    };
}
