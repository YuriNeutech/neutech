import { gsap } from "gsap";

export default function initActionIcon()
{
    const actionIcons = document.querySelectorAll('.action-icon');

    if (!actionIcons.length) return;

    actionIcons.forEach(actionIcon => {
        const animateArrowEl = actionIcon.querySelector('[data-animate="animate"]') ?? null;

        // gsap.to(actionIcon, {
        //     autoAlpha: 1,
        //     duration: 0.3,
        //     ease: 'power2.out'
        // });

        if (animateArrowEl) {
            const path = animateArrowEl.querySelector('path');

            const loopTl = gsap.timeline({
                repeat: -1,
                yoyo: true,
                defaults: { 
                    ease: "sine.inOut",
                    duration: 0.8
                }
            });

            if (animateArrowEl.dataset.dir == 'down') {
                loopTl.to(animateArrowEl, {
                    y: 5
                }, 0);
            } else if (animateArrowEl.dataset.dir == 'right') {
                loopTl.to(animateArrowEl, {
                    x: 5
                }, 0);
            }

            if (path) {
                loopTl.to(path, {
                    attr: { "stroke-opacity": 1 } 
                }, 0);
            }
        }
    });
}