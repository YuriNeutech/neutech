import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import EmblaCarousel from 'embla-carousel';

gsap.registerPlugin(ScrollTrigger);

export default function initBenefitsSlider() {
    const benefitsSection = document.querySelector('.benefits');
    if (!benefitsSection) return;

    const slides = benefitsSection.querySelectorAll('.benefit-slide');
    const viewport = benefitsSection.querySelector('.benefits__slider-viewport');
    const container = benefitsSection.querySelector('.benefits__slider-container');
    const actionIcon = benefitsSection.querySelector('.benefits__scroll-icon');
    
    animateBackground(benefitsSection);

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: benefitsSection,
            start: "top 70%", 
            toggleActions: "play none none none",
            once: true
        },
        defaults: { ease: "power3.out" }
    });

    if (slides.length > 0) {
        tl.fromTo(slides,
            { y: 30, autoAlpha: 0, filter: "blur(10px)" },
            { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1, stagger: 0.1, ease: "back.out(1.2)" }
        );
    }

    let mm = gsap.matchMedia();

    mm.add({
        isDesktop: "(min-width: 1024px)",
        isMobile: "(max-width: 1023px)"
    }, (context) => {
        let { isDesktop } = context.conditions;
        let emblaApi;

        if (isDesktop) {
            const getScrollAmount = () => -(container.scrollWidth - viewport.offsetWidth);

            const tween = gsap.to(container, {
                x: getScrollAmount,
                ease: "none"
            });

            ScrollTrigger.create({
                trigger: benefitsSection,
                start: "center center",
                end: () => `+=${container.scrollWidth - viewport.offsetWidth}`,
                pin: true,
                animation: tween,
                scrub: 1,
                invalidateOnRefresh: true
            });

        } else {
            
            gsap.set(container, { clearProps: "x" });

            emblaApi = EmblaCarousel(viewport, {
                align: 'start',
                dragFree: false,
                containScroll: 'trimSnaps',
            });
        }

        return () => {
            if (emblaApi) emblaApi.destroy();
        };
    });

    return () => {
        if (tl) tl.kill();
        mm.revert();
    };
}

function animateBackground(section) {
    const particles = section.querySelectorAll('.benefits__particle');

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