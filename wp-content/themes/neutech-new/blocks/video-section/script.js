import Player from '@vimeo/player';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.config({ 
    ignoreMobileResize: true 
});

export default function initVideoSection() {
    const sections = document.querySelectorAll('.full-video');

    if (sections.length > 0) {
        sections.forEach(section => {
            const players = [];
            const containers = section.querySelectorAll('.full-video__iframe');

            if (containers.length === 0) return;

            containers.forEach(container => {
                const vId = container.dataset.vimeoId || container.dataset.vimeomobileId;
                if (!vId) return;

                const p = new Player(container, {
                    id: vId,
                    background: true,
                    autoplay: false,
                    muted: true,
                    loop: true,
                    controls: false,
                    dnt: true
                });
                players.push(p);
            });
    
            let isAnimationFinished = false;
    


            // Control Logic
            const startVideo = () => {
                players.forEach(p => {
                    p.play().catch(error => console.error("Autoplay blocked:", error));
                });
                section.classList.add('is-playing');
            };

            const stopVideo = () => {
                players.forEach(p => p.pause());
                // section.classList.remove('is-playing');
            };

    
            section.addEventListener('click', (e) => {
                e.preventDefault();
   
                if (section.classList.contains('is-playing')) {
                    players[0].getPaused().then(paused => {
                        if (paused) {
                            startVideo();
                        } else {
                            stopVideo();
                        }
                    });
                }
            });

            // Text animation
            const lines = section.querySelectorAll('.full-video__word-new-p'),
                highlights = section.querySelectorAll('em'),
                desc = section.querySelectorAll('.full-video__desc-wr');
            const cursorIcon = section.querySelector('.full-video__scroll-icon');

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: section,
                    start: "top 60%",
                    toggleActions: "play none none none",
                    once: true
                },
                defaults: { ease: "power3.out" },
                onStart: () => {
                    if (cursorIcon) gsap.set(cursorIcon, {autoAlpha: 0});
                },
                onComplete: () => {
                    isAnimationFinished = true; 
                    startVideo(); 
                    if (cursorIcon) gsap.to(cursorIcon, { autoAlpha: 1, scale: 1, duration: 0.3 });
                }
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

            if (desc.length > 0) {
                tl.fromTo(desc, 
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

            ScrollTrigger.create({
                trigger: section,
                start: "top bottom", 
                end: "bottom top",
                snap: {
                    snapTo: (progress, self) => {
                        // Calculate exact progress where the TOP of the section hits the TOP of the viewport
                        const vh = window.innerHeight;
                        const totalDistance = self.end - self.start;
                        
                        // This replaces the hardcoded 0.5 center
                        const exactTopProgress = vh / totalDistance; 
                        
                        // Your percentage threshold (e.g., 20% of the section area)
                        const threshold = 0.2; 

                        if (progress > (exactTopProgress - threshold) && progress < (exactTopProgress + threshold)) {
                            return exactTopProgress; // Snaps exactly to top-to-top
                        }
                        
                        return progress; 
                    },
                    duration: { min: 0.5, max: 1 },
                    delay: 0,
                    // Changed to power2.inOut for mobile. 'back' eases can fight touch momentum and cause stuttering.
                    ease: "power2.inOut", 
                    inertia: false
                },
                onEnter: () => {
                    if (isAnimationFinished) startVideo();
                },
                onEnterBack: () => {
                    if (isAnimationFinished) startVideo();
                },
                onLeave: () => stopVideo(),
                onLeaveBack: () => stopVideo()
            });
            const bgImage = section.querySelector('.full-video__bg');

            if (bgImage) {
                gsap.fromTo(bgImage, 
                    {
                        yPercent: -15,
                        scale: 1.15
                    },
                    {
                        yPercent: 15,
                        ease: "none",
                        scrollTrigger: {
                            trigger: section,
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true,
                        }
                    }
                );
            }

            // --- CURSOR FOLLOWER LOGIC ---

            if (cursorIcon) gsap.set(cursorIcon, {autoAlpha: 0});
            const xTo = gsap.quickTo(cursorIcon, "x", { duration: 0.3, ease: "power3" });
            const yTo = gsap.quickTo(cursorIcon, "y", { duration: 0.3, ease: "power3" });

            const moveCursor = (e) => {
                const rect = section.getBoundingClientRect();
                xTo(e.clientX - rect.left);
                yTo(e.clientY - rect.top);
            };

            const onMouseEnter = (e) => {
                const rect = section.getBoundingClientRect();
                const startX = e.clientX - rect.left;
                const startY = e.clientY - rect.top;
                gsap.set(cursorIcon, { x: startX, y: startY });
                if (section.classList.contains('is-playing')) {
                    gsap.to(cursorIcon, { autoAlpha: 1, scale: 1, duration: 0.3 });
                }
                section.addEventListener("mousemove", moveCursor);
            };

            const onMouseLeave = () => {
                gsap.to(cursorIcon, { autoAlpha: 0, scale: 0.5, duration: 0.3 });
                section.removeEventListener("mousemove", moveCursor);
            };

            const updateCursorPresence = () => {
                const isMouseDevice = window.matchMedia("(pointer: fine)").matches;
                if (isMouseDevice) {
                    gsap.set(cursorIcon, { 
                        display: "block", 
                        xPercent: -50, 
                        yPercent: -50, 
                        autoAlpha: 0, 
                        scale: 0.5, 
                        pointerEvents: "none", 
                        left: 0, 
                        top: 0, 
                        position: 'absolute' 
                    });
                    section.addEventListener("mouseenter", onMouseEnter);
                    section.addEventListener("mouseleave", onMouseLeave);
                } else {
                    gsap.killTweensOf(cursorIcon);
                    gsap.set(cursorIcon, { display: "none" });
                    section.removeEventListener("mouseenter", onMouseEnter);
                    section.removeEventListener("mouseleave", onMouseLeave);
                    section.removeEventListener("mousemove", moveCursor);
                }
            };

            const mediaQuery = window.matchMedia("(pointer: fine)");
            try {
                mediaQuery.addEventListener("change", updateCursorPresence);
            } catch (e) {
                mediaQuery.addListener(updateCursorPresence);
            }

            updateCursorPresence();
        });
    }
}