import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initCenterImgContent() {
    const sections = document.querySelectorAll('.center-img-content');
    if (sections.length === 0) return;

    sections.forEach(section => {
        
        const image = section.querySelector('.center-img-content__img');
        const title = section.querySelector('.center-img-content__title');
        const contentContainer = section.querySelector('.center-img-content__content');
        
        
        const contentBlocks = contentContainer ? contentContainer.children : [];

        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 75%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        
        if (image) {
            tl.fromTo(image,
                { scale: 0.95, autoAlpha: 0, filter: "blur(8px)" },
                { scale: 1, autoAlpha: 1, filter: "blur(0px)", duration: 1.4, ease: "power2.out" }
            );
        }

        
        if (title) {
            tl.fromTo(title,
                { y: 40, autoAlpha: 0, filter: "blur(6px)" },
                { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1.2, ease: "back.out(1.2)" },
                image ? "-=0.8" : 0 
            );
        }

        
        if (contentBlocks.length > 0) {
            tl.fromTo(contentBlocks,
                { y: 30, autoAlpha: 0, filter: "blur(4px)" }, 
                { 
                    y: 0, 
                    autoAlpha: 1, 
                    filter: "blur(0px)", 
                    duration: 1.2, 
                    stagger: 0.15, 
                    ease: "back.out(1.1)" 
                },
                (image || title) ? "-=0.8" : 0
            );
        }
    });
}