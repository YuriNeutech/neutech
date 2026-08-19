import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initTwoColSection() {
    const sections = document.querySelectorAll('.two-col');
    if (sections.length === 0) return;

    sections.forEach(section => {
        
        const title = section.querySelector('.two-col__heading .two-col__title');
        const subtitle = section.querySelector('.two-col__heading .two-col__subtitle');
        
        
        const columns = section.querySelectorAll('.two-col__col');
        
        
        const images = section.querySelectorAll('.two-col__col .two-col__img');

        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 70%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        
        if (title) {
            tl.fromTo(title, 
                { y: 50, autoAlpha: 0, filter: "blur(8px)" },
                { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1.4, ease: "back.out(1.2)" }
            );
        }

        
        if (subtitle) {
            tl.fromTo(subtitle,
                { y: 30, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 1 },
                title ? "-=1" : 0 
            );
        }

        
        columns.forEach((col, index) => {
            const blocks = col.children; 
            
            if (blocks.length > 0) {
                
                let offset = (index === 0 && (title || subtitle)) ? "-=0.6" : "-=0.8";
                if (index === 0 && !title && !subtitle) offset = 0; 
                
                tl.fromTo(blocks,
                    { y: 40, autoAlpha: 0 },
                    { 
                        y: 0, 
                        autoAlpha: 1, 
                        duration: 1, 
                        stagger: 0.15, 
                        ease: "back.out(1.1)" 
                    },
                    offset
                );
            }
        });

        
        if (images.length > 0) {
            tl.fromTo(images, 
                { scale: 0.95, filter: "blur(5px)" },
                { scale: 1, filter: "blur(0px)", duration: 1.5, ease: "power2.out" },
                "-=1.2" 
            );
        }
    });
}