import gsap from 'gsap';
import { ScrollToPlugin } from 'gsap/all';
gsap.registerPlugin(ScrollToPlugin);

export default class Preloader {
    constructor() {
        this.DOM = {
            wrap: document.querySelector('#preloader'),
            svg: document.querySelector('#preloader svg'),
            texts: document.querySelectorAll('#preloader .logo-text'),
            dot: document.querySelector('#preloader .logo-dot'),
            body: document.body
        };

        if (!this.DOM.wrap) return;
        gsap.to(window, {
            scrollTo: {y: 0,},
        })
        this.init();
    }

    init() {
        this.lockScroll();

        gsap.set(this.DOM.texts, { autoAlpha: 0, y: 15 });

        if (this.DOM.dot) {
            const bbox = this.DOM.dot.getBBox(); 
            // const cx = bbox.x + (bbox.width / 2);
            // const cy = bbox.y + (bbox.height / 2);
            
            gsap.set(this.DOM.dot, { 
                // transformOrigin: `${cx}px ${cy}px`,
                autoAlpha: 0,
                scale: 0 
            });
        }

        if (document.readyState === 'complete') {
            this.runAnimation();
        } else {
            window.addEventListener('load', () => this.runAnimation(), { once: true });
        }
    }

    lockScroll() {
        this.DOM.body.style.overflow = 'hidden';
        this.DOM.body.style.height = '100vh';
    }

    unlockScroll() {
        this.DOM.body.style.overflow = '';
        this.DOM.body.style.height = '';
    }

    runAnimation() {
        const tl = gsap.timeline({
            onComplete: () => this.completeAnimation()
        });

        tl.to(this.DOM.texts, {
            y: 0,
            autoAlpha: 1,
            duration: 0.8,
            stagger: 0.05,
            ease: "power2.out"
        });

        tl.to(this.DOM.dot, {
            scale: 1,
            autoAlpha: 1,
            duration: 0, 
            ease: "back.out(1)" 
        }, "-=0.2");

        tl.to(this.DOM.dot, {
            opacity: 0, 
            duration: 0.2, 
            yoyo: true, 
            repeat: 1, 
            ease: "power1.inOut"
        });

        tl.to(this.DOM.wrap, {
            height: 0,
            autoAlpha: 0,
            duration: 1.2,
            ease: "expo.inOut"
        });
    }

    completeAnimation() {
        this.unlockScroll();
        // this.DOM.wrap.remove();
        
        window.dispatchEvent(new CustomEvent('preloader-done'));
        document.body.classList.add('is-loaded');
    }
}