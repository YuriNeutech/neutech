import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function animateCursorIcon(cursorIcon, section) {
    const xTo = gsap.quickTo(cursorIcon, "x", { duration: 0.3, ease: "power3" });
    const yTo = gsap.quickTo(cursorIcon, "y", { duration: 0.3, ease: "power3" });

    const moveCursor = (e) => {
        const rect = section.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        xTo(x);
        yTo(y);
    };

    const onMouseEnter = (e) => {
        const rect = section.getBoundingClientRect();
        const startX = e.clientX - rect.left;
        const startY = e.clientY - rect.top;

        xTo(startX); 
        yTo(startY);
        gsap.set(cursorIcon, { x: startX, y: startY });
        gsap.to(cursorIcon, { autoAlpha: 1, scale: 1, duration: 0.3 });
        
        section.addEventListener("mousemove", moveCursor);
    };

    const onMouseLeave = () => {
        gsap.to(cursorIcon, { autoAlpha: 0, scale: 0.5, duration: 0.3 });
        section.removeEventListener("mousemove", moveCursor);
    };

    const handleDeviceChange = () => {
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
            gsap.set(cursorIcon, { display: "none" });
            section.removeEventListener("mouseenter", onMouseEnter);
            section.removeEventListener("mouseleave", onMouseLeave);
            section.removeEventListener("mousemove", moveCursor);
        }
    };

    const mediaQuery = window.matchMedia("(pointer: fine)");
    mediaQuery.addEventListener("change", handleDeviceChange);
    handleDeviceChange();
}