import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initWheelSection() {
    const sections = document.querySelectorAll(".wheel");
    if (sections.length === 0) return;

    sections.forEach((section) => {
        const title = section.querySelector(".wheel__title");
        const subtitle = section.querySelector(".wheel__subtitle");

        const graphic = section.querySelector(".wheel__graphic svg");
        const blurBg = section.querySelector(".wheel__blur-bg");
        const numbers = section.querySelectorAll(".wheel__item-num");

        const cards = section.querySelectorAll(".wheel__card");

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
            tl.fromTo(title, { y: 40, autoAlpha: 0, filter: "blur(6px)" }, { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1.2, ease: "back.out(1.2)" });
        }

        if (subtitle) {
            tl.fromTo(subtitle, { y: 30, autoAlpha: 0, filter: "blur(4px)" }, { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1 }, title ? "-=0.8" : 0);
        }

        if (graphic) {
            gsap.set(graphic, { transformOrigin: "center center" });

            tl.fromTo(graphic, { scale: 0.8, rotation: -90, autoAlpha: 0 }, { scale: 1, rotation: 0, autoAlpha: 1, duration: 1.6, ease: "power2.out" }, "-=0.6");

            // tl.add(() => {
            //     gsap.to(graphic, {
            //         rotation: 360,
            //         duration: 60,
            //         repeat: -1,
            //         ease: "none"
            //     });
            // });
        }

        if (blurBg) {
            tl.fromTo(blurBg, { scale: 0.5, autoAlpha: 0 }, { scale: 1, autoAlpha: 1, duration: 2, ease: "sine.out" }, "-=1.4");
        }

        if (numbers.length > 0) {
            gsap.set(numbers, { transformOrigin: "center center" });

            tl.fromTo(numbers, { scale: 0, autoAlpha: 0 }, { scale: 1, autoAlpha: 1, duration: 0.6, stagger: 0.15, ease: "back.out(2)" }, "-=1");
        }

        if (cards.length > 0) {
            tl.fromTo(
                cards,
                { y: 40, autoAlpha: 0, filter: "blur(5px)" },
                {
                    y: 0,
                    autoAlpha: 1,
                    filter: "blur(0px)",
                    duration: 1.2,
                    stagger: 0.2,
                    ease: "back.out(1.1)"
                },
                "-=0.8"
            );
        }
    });
}
