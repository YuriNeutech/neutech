import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

import { MobileCategorySelect } from "./modules/mobileSelect";
import initListHoverProximity from "./modules/listHoverProximity";
import BlogPagination from "./modules/blogPagination";
import initRippleButtons from "./modules/rippleButtons";
import initNewsletterForm from "./modules/newsletterForm";


document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.category-select')) new MobileCategorySelect('.category-select');
    new BlogPagination();

    // --- ANIMATIONS ---
    const animatedEls = {
        title: document.querySelector('.blog-page__title'),
        searchForm: document.querySelector('.search-form'),
        searchInput: document.querySelector('.search-form__field'),
    }

    initListHoverProximity('.category-select__categories-list', '.category-select__option');
    initRippleButtons();

    // -- TITLE
    if (animatedEls.title) {
        gsap.fromTo(animatedEls.title, 
            { 
                y: 80, 
                autoAlpha: 0, 
                filter: "blur(10px)"
            },
            { 
                y: 0, 
                autoAlpha: 1, 
                filter: "blur(0px)", 
                duration: 1.8, 
                stagger: 0.2, 
                ease: "back.out(1.2)",
                clearProps: 'all',
            }
        );
    }

    // -- SEARCH FORM
    if (animatedEls.searchForm || animatedEls.searchInput) {
        const tl = gsap.timeline({ defaults: { duration: 1, ease: "power4.out" } });
    
        tl.from(animatedEls.searchForm, {
            width: '6.8rem',
            duration: '1.5',
            clearProps: 'all',
        }).from(animatedEls.searchInput, {
            autoAlpha: 0,
            ease: "power1",
            clearProps: 'all',
        }, "-=1")
    }

    // -- BLOG CARDS
    const cards = document.querySelectorAll('.blog-card');
    if (cards.length > 0) {
        cards.forEach((card) => {
            gsap.fromTo(card, 
                { 
                    y: 40, 
                    opacity: 0,
                }, 
                { 
                    y: 0, 
                    opacity: 1, 
                    duration: 0.8, 
                    ease: "power2.out",
                    clearProps: 'all',
                    scrollTrigger: {
                        trigger: card,         
                        start: "top 90%",    
                        toggleActions: "play none none reverse",
                        once: true 
                    }
                }
            );
        })
    }

    // NEWS LETTER
    const newsletterBlock = document.querySelector('.blog-newsletter');
    if (newsletterBlock) {
        const inner = newsletterBlock?.querySelector('.blog-newsletter__inner');
        const title = newsletterBlock?.querySelector('.blog-newsletter__title');
        const text = newsletterBlock?.querySelector('.blog-newsletter__text');
        const form = newsletterBlock?.querySelector('.blog-newsletter__form');

        gsap.set(inner, { 
            scale: 0.9, 
            opacity: 0, 
        });
        
        gsap.set([text, form], { 
            y: 30, 
            opacity: 0 
        });

        const tl = gsap.timeline({
            clearProps: 'all',
            scrollTrigger: {
                trigger: newsletterBlock,
                start: "top 85%",
                toggleActions: "play none none reverse",
            }
        });

        tl.to(inner, {
            scale: 1,
            opacity: 1,
            duration: 1,
            ease: "power4.out"
        })
        .fromTo(title, { 
            y: 80, 
            autoAlpha: 0, 
            filter: "blur(10px)"
        },
        { 
            y: 0, 
            autoAlpha: 1, 
            filter: "blur(0px)", 
            duration: 1.8, 
            stagger: 0.2, 
            ease: "back.out(1.2)" 
        })
        .to([text, form], {
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.15,
            ease: "power3.out"
        }, "-=0.6"); 
    }

    initNewsletterForm();
});