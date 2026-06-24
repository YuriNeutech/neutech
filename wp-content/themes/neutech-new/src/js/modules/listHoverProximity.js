import { gsap } from "gsap";

export default function initListHoverProximity(listClass, singleItemClass) {
    const list = document.querySelector(listClass);
    const options = document.querySelectorAll(singleItemClass);

    if (!list || options.length === 0) return;

    const intro = gsap.fromTo(options, 
        { x: -20, opacity: 0, filter: "blur(5px)" }, 
        { x: 0, opacity: 1, filter: "blur(0px)", duration: 0.8, stagger: 0.1, ease: "power3.out" }
    );

    const mm = gsap.matchMedia();
    const sizes = [2.2, 2, 1.8, 1.6, 1.4, 1.2]; 

    mm.add("(pointer: fine)", () => {
        const handleMouseEnter = (index) => {
            if (intro.isActive()) return;

            options.forEach((other, otherIndex) => {
                const distance = Math.abs(index - otherIndex);
                const targetSize = sizes[distance] || sizes[sizes.length - 1];
                gsap.to(other, { fontSize: `${targetSize}rem`, duration: 0.4, ease: "power2.out", overwrite: true });
            });
        };

        const handleMouseLeave = () => {
            if (intro.isActive()) return;
            gsap.to(options, { fontSize: "1.8rem", duration: 0.4, ease: "power2.out", overwrite: true });
        };

        options.forEach((el, index) => {
            el.addEventListener('mouseenter', () => handleMouseEnter(index));
        });

        list.addEventListener('mouseleave', handleMouseLeave);

        return () => {
            options.forEach((el) => el.removeEventListener('mouseenter', handleMouseEnter));
            list.removeEventListener('mouseleave', handleMouseLeave);
            gsap.set(options, { clearProps: "fontSize" });
        };
    });
}