import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

function initPostPageAnimation() {
    const postPage = document.querySelector('.post-page');
    if (!postPage) return;

    const breadcrumbs = postPage.querySelector('.post-page__breadcrumbs');
    const thumbnail = postPage.querySelector('.post-page__thumbnail');
    const intro = postPage.querySelector('.post-page__intro');
    const mainContent = postPage.querySelector('.post-page__main-content');
    const relatedSection = postPage.querySelector('.related-articles');
    const relatedTitle = postPage.querySelector('.related-articles__title');
    const relatedItems = postPage.querySelectorAll('.related-articles__item');


    const introTl = gsap.timeline({
        defaults: {
            duration: 1,
            ease: "power3.out"
        }
    });

    gsap.set(thumbnail, { xPercent: 20, opacity: 0 });
    gsap.set(intro, { xPercent: -20, opacity: 0 });
    gsap.set(breadcrumbs, { y: -20, opacity: 0 });

    introTl
        .to(breadcrumbs, {
            y: 0,
            opacity: 1,
            duration: 0.8
        })
        .to(thumbnail, {
            xPercent: 0,
            opacity: 1
        }, "-=0.4")
        .to(intro, {
            xPercent: 0,
            opacity: 1
        }, "<");


    if (mainContent) {
        gsap.from(mainContent, {
            opacity: 0,
            y: 40,
            duration: 1,
            scrollTrigger: {
                trigger: mainContent,
                start: "top 85%",
            }
        });
    }


    if (relatedItems.length > 0) {
        gsap.from(relatedItems, {
            y: 60,
            opacity: 0,
            duration: 0.8,
            stagger: 0.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: relatedSection || relatedItems[0],
                start: "top 80%",
            }
        });
    }

    if (relatedTitle) {
        gsap.from(relatedTitle, {
            opacity: 0,
            x: -20,
            duration: 0.6,
            scrollTrigger: {
                trigger: relatedTitle,
                start: "top 90%",
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Progress bar
    const progressBar = document.querySelector('.progress__bar');
    if (progressBar) {
        gsap.to(progressBar, {
            scaleX: 1,
            ease: "none", 
            scrollTrigger: {
                trigger: "body",      
                start: "top top",     
                end: "bottom bottom",
                scrub: 0.3,           
            }
        });
    }

    initPostPageAnimation();
});