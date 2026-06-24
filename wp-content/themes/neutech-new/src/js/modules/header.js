import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

gsap.registerPlugin(ScrollTrigger);

export default function initHeader() {
    const header = document.querySelector('.header'),
        sections = document.querySelectorAll('[data-header-theme]');

    if (!header) return;

    ScrollTrigger.create({
        start: 'top top',
        end: '+=10',

        onLeave: () => header.classList.add('is-scrolled'),
        onEnterBack: () => header.classList.remove('is-scrolled'),
    });

    if (sections.length > 0) {
        sections.forEach(section => {
            ScrollTrigger.create({
                trigger: section,
                start: "top 60px",
                end: "bottom 60px",
                
                onEnter: () => setHeaderTheme(section.dataset.headerTheme),
                onEnterBack: () => setHeaderTheme(section.dataset.headerTheme),
                onRefresh: ({isActive}) => {
                   if(isActive) setHeaderTheme(section.dataset.headerTheme)
                }
            });
        });

        checkInitialTheme();
    }

    function setHeaderTheme(theme) {
        header.classList.remove('is-light', 'is-dark', 'is-hidden');
        if (theme) header.classList.add(`is-${theme}`);
    }

    function checkInitialTheme() {
        const activeSection = Array.from(sections).find(section => {
            const rect = section.getBoundingClientRect();
            return rect.top <= 60 && rect.bottom > 60;
        });

        if (activeSection) {
            setHeaderTheme(activeSection.dataset.headerTheme);
        } else {
            if (window.scrollY < 60 && sections[0]) {
                setHeaderTheme(sections[0].dataset.headerTheme);
            }
        }
    }
}