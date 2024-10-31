import './bootstrap';
import 'flowbite';
// hamburger menu
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu-2');

    function toggleMenu() {
        const isMenuOpen = mobileMenu.classList.contains('active');
        
        if (!isMenuOpen) {
            // Open menu
            document.body.style.overflow = 'hidden';
            mobileMenu.classList.add('active');
            menuToggle.classList.add('active');
        } else {
            // Close menu
            document.body.style.overflow = '';
            mobileMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        }
    }

    menuToggle.addEventListener('click', toggleMenu);
    
    // Close menu when clicking menu items
    const menuItems = document.querySelectorAll('.menu-item a');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            toggleMenu();
        });
    });
});


// swiper js pada testimoni
document.addEventListener('DOMContentLoaded', function() {
    new Swiper(".testimonialSwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            // when window width is >= 640px
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // when window width is >= 1024px
            1024: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        },
        on: {
            init: function() {
                updateSlides(this);
            },
            slideChange: function() {
                updateSlides(this);
            }
        }
    });

    function updateSlides(swiper) {
        const slides = swiper.slides;
        slides.forEach((slide, index) => {
            if (index === swiper.activeIndex) {
                slide.style.transform = 'scale(1)';
            } else {
                slide.style.transform = 'scale(0.9)';
            }
        });
    }
});


// hero
document.addEventListener('DOMContentLoaded', function() {
    const heroSwiper = new Swiper('.hero-swiper', {
        loop: true,
        speed: 500,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.hero-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return `<span class="${className}"></span>`;
            }
        },
        navigation: {
            nextEl: '.hero-next',
            prevEl: '.hero-prev',
        }
    });
});
