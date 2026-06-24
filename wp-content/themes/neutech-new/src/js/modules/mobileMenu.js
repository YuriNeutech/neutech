import { gsap } from "gsap";

class MobileMenu {
    
    constructor() {
        this.container = document.querySelector('.header-nav');
        if (!this.container) return;

        this.header = document.querySelector('.header');
        this.logo = document.querySelector('.header__logo');
        this.openBtn = this.container.querySelector('.header-nav__button');
        this.closeBtn = this.container.querySelector('.header-nav__close');
        this.menuWrapper = this.container.querySelector('.header-nav__menu-wr');
        this.menuItems = this.container.querySelectorAll('.header-nav__list > li');
        this.particles = this.container.querySelectorAll('.header-nav__particle');
        this.blurBg = this.container.querySelector('.header-nav__blur-bg');
        this.ctaBtn = this.container.querySelector('.header-nav__cta-btn');
        this.headerCta = document.querySelector('.header__cta-btn');

        // SUBMENU
        this.navBg = this.container.querySelector('.header-nav__bg');
        this.parentItems = this.container.querySelectorAll('.menu-item-has-children');

        this.isOpen = false;
        this.tl = null;
        this.mm = gsap.matchMedia();

        const sections = Array.from(document.querySelectorAll('[data-header-theme]'))
        this.headerTheme = sections.length > 0 ? sections[0].dataset.headerTheme : 'dark';
        
        this.init();
    }

    
    lockScroll() {
        document.body.style.overflow = 'hidden';
        document.body.style.height = '100vh';
    }

    unlockScroll() {
        document.body.style.overflow = '';
        document.body.style.height = '';
    }

    openHandler = () => this.open();
    closeHandler = () => this.close();

    init() {
        this.mm.add("(max-width: 1023px)", () => {

            this.createMobileTimeline();
            
            this.openBtn.addEventListener('click', this.openHandler);
            this.closeBtn.addEventListener('click', this.closeHandler);

            return () => {
                this.isOpen = false;
                document.body.classList.remove('menu-open');
                this.openBtn.removeEventListener('click', this.openHandler);
                this.closeBtn.removeEventListener('click', this.closeHandler);
                gsap.set([this.logo, this.openBtn, this.headerCta, this.menuWrapper], { clearProps: "all" });
            };
        });

        this.mm.add("(min-width: 1024px)", () => {
            this.initDesktopSubmenu();

            return () => {
                this.destroyDesktopSubmenu();
                gsap.set(this.navBg, { clearProps: "all" });
            };
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) this.close();
        });
    }

    getLogoCenterShift() {
        const logoRect = this.logo.getBoundingClientRect();
        const screenCenter = window.innerWidth / 2;
        const logoCenter = logoRect.left + (logoRect.width / 2);
        return screenCenter - logoCenter;
    }

    createMobileTimeline() {
        this.tl = gsap.timeline({ 
            paused: true,
            defaults: { ease: "expo.out", duration: 1 },
            onStart: () => {
                if (!this.header.classList.contains('is-light', 'is-dark')) {
                    this.header.classList.add(`is-${this.headerTheme}`);
                }

                this.header.classList.add('is-scrolled');
            },
        });

        this.tl
            .to([this.openBtn, this.headerCta], { 
                opacity: 0, 
                scale: 0.8,
                duration: 0.4,
                pointerEvents: 'none' 
            }, 0)
            .to(this.logo, {
                x: () => this.getLogoCenterShift(), // Динамічний розрахунок центру
                duration: 0.8,
                ease: "expo.inOut"
            }, 0)
            .set(this.menuWrapper, { display: 'flex' }, "<") // Show the wrapper
            .fromTo(this.menuWrapper, 
                { yPercent: -100, opacity: 0, visibility: 'hidden' },
                { yPercent: 0, opacity: 1, visibility: 'visible', duration: 0.8 }
            )
            .from(this.blurBg, {
                scale: 0.5,
                opacity: 0,
                y: -50,
                duration: 1.2
            }, "-=0.4")
            .from(this.menuItems, {
                y: 30,
                opacity: 0,
                stagger: 0.1
            }, "-=0.8")
            .from(this.particles, {
                scale: 0,
                opacity: 0,
                stagger: {
                    amount: 0.4,
                    from: "random"
                },
                duration: 1.5
            }, "-=1")
            .from(this.ctaBtn, {
                y: 20,
                opacity: 0
            }, "<");

        this.particles.forEach(particle => {
            const randomX = (Math.random() - 0.5) * 70,
                randomY = (Math.random() - 0.5) * 80,
                randomDuration = 4 + Math.random() * 4,
                randomDelay = Math.random() * 2;

            gsap.to(particle, {
                x: randomX,
                y: randomY,
                duration: randomDuration,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: randomDelay
            });
        });
    }

    initDesktopSubmenu() {
        gsap.set([this.navBg, ...Array.from(this.parentItems).map(i => i.querySelector('.sub-menu'))], { 
            autoAlpha: 0, 
            y: 10, 
            display: 'none' 
        });

        this.parentItems.forEach(item => {
            const link = item.querySelector('a');
            const subMenu = item.querySelector('.sub-menu');
            if (!subMenu) return;

            item._clickHandler = (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = item.classList.contains('is-active');

                if (isActive) {
                    this.closeAllSubmenus();
                    this.unlockScroll();
                } else {
                    this.openSubmenu(item);
                    this.lockScroll();
                }
            };

            link.addEventListener('click', item._clickHandler);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.header-nav__list')) this.closeAllSubmenus();
        });
    }

    openSubmenu(item) {
        const subMenu = item.querySelector('.sub-menu');
        const allSubMenus = Array.from(this.parentItems).map(i => i.querySelector('.sub-menu'));
        const otherSubmenus = allSubMenus.filter(sub => sub !== subMenu);

        gsap.killTweensOf([this.navBg, ...allSubMenus]);


        this.parentItems.forEach(i => i.classList.remove('is-active'));
        item.classList.add('is-active');


        const tl = gsap.timeline({ 
            defaults: { ease: "expo.out", duration: 0.5 },
            onStart: () => {
                if (!this.header.classList.contains('is-light') && !this.header.classList.contains('is-dark')) {
                    this.header.classList.add(`is-${this.headerTheme}`);
                }
                this.header.classList.add('is-scrolled');
            },
        });

        tl.to(otherSubmenus, { 
                autoAlpha: 0, 
                y: 10, 
                display: 'none', 
                duration: 0.2,
                overwrite: true 
            }, 0)

            .to(this.navBg, { 
                display: 'block', 
                autoAlpha: 1, 
                y: 0,
                duration: 0.4 
            }, 0)
            .fromTo(subMenu, 
                { display: 'none', autoAlpha: 0, y: 10 },
                { 
                    display: 'flex', 
                    autoAlpha: 1, 
                    y: 0, 
                    clearProps: "transform",
                    duration: 0.5 
                }, 
                "-=0.3" 
            );
    }

    closeAllSubmenus() {
        this.parentItems.forEach(i => i.classList.remove('is-active'));
        
        const allSubmenus = this.container.querySelectorAll('.sub-menu');
        
        gsap.to([this.navBg, ...allSubmenus], { 
            autoAlpha: 0, 
            y: 10, 
            duration: 0.3, 
            ease: "power2.inOut",
            overwrite: true,
            onComplete: () => {
                gsap.set([...allSubmenus, this.navBg], { display: 'none' });
            }
        });
        this.unlockScroll();
    }

    destroyDesktopSubmenu() {
        document.removeEventListener('click', this.outsideClickHandler);
        this.parentItems.forEach(item => {
            const link = item.querySelector('a');
            if (item._clickHandler) link.removeEventListener('click', item._clickHandler);
            
            const subMenu = item.querySelector('.sub-menu');
            if (subMenu) gsap.set(subMenu, { clearProps: "all" });
            
            item.classList.remove('is-active');
        });
    }

    open() {
        if (this.isOpen) return;
        this.isOpen = true;
        document.body.classList.add('menu-open');
        this.lockScroll();
        this.tl.play();
    }

    close() {
        if (!this.isOpen) return;
        this.isOpen = false;
        this.tl.reverse();
        this.unlockScroll();
        document.body.classList.remove('menu-open');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new MobileMenu();
});