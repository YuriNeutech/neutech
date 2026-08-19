import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import animateCursorIcon from "../../src/js/modules/cursorIcon";

gsap.registerPlugin(ScrollTrigger);

export default function initPageHero() {
    const heroSections = document.querySelectorAll('.page-hero');
    if (heroSections.length === 0) return;

    heroSections.forEach(section => {
        // Existing targets
        const lines = section.querySelectorAll('.page-hero__word-new-p');
        const highlights = section.querySelectorAll('em');
        const cursorIcon = section.querySelector('.page-hero__scroll-icon');
        
        // New targets for the full section
        const tagline = section.querySelector('.page-hero__tag');
        const subtitle = section.querySelector('.page-hero__subtitle');
        const features = section.querySelectorAll('.features-list__item');
        const button = section.querySelector('.page-hero__btn');

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 60%",
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        // 1. Tagline appears first
        if (tagline) {
            tl.fromTo(tagline,
                { y: 30, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 1 }
            );
        }

        // 2. Title lines (Existing code with an overlap offset)
        if (lines.length > 0) {
            tl.fromTo(lines, 
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
                    ease: "back.out(1.2)" 
                },
                tagline ? "-=0.6" : 0 // Overlap with tagline
            );
        }

        // 3. Em Highlights (Existing code)
        if (highlights.length > 0) {
            tl.to(highlights, {
                "--highlight-progress": "100%", 
                "--highlight-opacity": 1,
                duration: 1.5,
                stagger: 0.15,
                ease: "elastic.out(1.2, 0.6)" 
            }, "-=1.4");
        }

        // 4. Subtitle slides in
        if (subtitle) {
            tl.fromTo(subtitle,
                { y: 30, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 1 },
                "-=1.2" // Overlap with title animations
            );
        }

        // 5. Features list items stagger in
        if (features.length > 0) {
            tl.fromTo(features,
                { y: 30, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 0.8, stagger: 0.1 },
                "-=0.8"
            );
        }

        // 6. Button pops in at the end
        if (button) {
            tl.fromTo(button,
                { y: 20, autoAlpha: 0, scale: 0.95 },
                { y: 0, autoAlpha: 1, scale: 1, duration: 1, ease: "back.out(1.5)" },
                "-=0.6"
            );
        }

        animateBackground(section);

        if (cursorIcon) {
            animateCursorIcon(cursorIcon, section);
        }
    });
}

function animateBackground(section) {
    const glow = section.querySelector('.page-hero__blur-bg');
    const bgImages = section.querySelectorAll('.page-hero__bg-image');

    if (glow) {
        gsap.to(glow, {
            scale: 1.4,
            opacity: 0.45,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    }


    if (bgImages.length > 0) {

        gsap.fromTo(bgImages, 
            { autoAlpha: 0, scale: 1.05 }, 
            { autoAlpha: 1, scale: 1, duration: 2, ease: "power2.out", stagger: 0.2 }
        );


        bgImages.forEach(img => {
            gsap.to(img, {
                x: "random(-15, 15)",      
                y: "random(-15, 15)",      
                rotation: "random(-1, 1)", 
                duration: "random(5, 8)", 
                repeat: -1,                
                yoyo: true,             
                ease: "sine.inOut",    
                repeatRefresh: true        
            });
        });
    }
}