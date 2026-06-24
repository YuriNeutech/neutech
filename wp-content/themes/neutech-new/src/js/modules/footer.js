import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initFooter() {
    const footerSection = document.querySelector('.footer');
    if (!footerSection) return;

    const lines = footerSection.querySelectorAll('.footer__word-new-p');
    const highlights = footerSection.querySelectorAll('em');

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: footerSection,
            start: "top 60%",
            toggleActions: "play none none none",
            once: true
        },
        defaults: { ease: "power3.out" }
    });

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
            }
        );
    }

    if (highlights.length > 0) {
        tl.to(highlights, {
            "--highlight-progress": "100%", 
            "--highlight-opacity": 1,
            duration: 1.5,
            stagger: 0.15,
            ease: "elastic.out(1.2, 0.6)" 
        }, "-=1.4");
    }

    animateBackground(footerSection);
}

function animateBackground(section) {
    const glow = section.querySelector('.footer__blur-bg'),
        particles = section.querySelectorAll('.footer__particle');

    // Blug bg animation
    if (glow) {
        gsap.to(glow, {
            scale: 1.4,
            opacity: .3,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    }

    // Dotted animation
    if (particles.length > 0) {
        particles.forEach(particle => {
            const randomX = (Math.random() - 0.5) * 70,
                randomY = (Math.random() - 0.5) * 80,
                randomDuration = 4 + Math.random() * 4,
                randomDelay = Math.random() * 2;

            gsap.to(particle, {
                x: randomX,
                y: randomY,
                duration: randomDuration,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: randomDelay
            });
        });
    }
}