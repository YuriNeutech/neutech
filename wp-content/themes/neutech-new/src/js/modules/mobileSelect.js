export class MobileCategorySelect {
    constructor(element) {
        this.select = typeof element === 'string' ? document.querySelector(element) : element;
        if (!this.select) return;
        this.heading = this.select.querySelector('.custom-select__heading');
        this.mobileBreakpoint = 1024; 

        if (!this.select || !this.heading) return;

        this.init();
    }

    isMobile() {
        return window.innerWidth < this.mobileBreakpoint;
    }

    init() {
        this.heading.addEventListener('click', (e) => {
            if (!this.isMobile()) return;
            
            e.stopPropagation();
            this.toggleSelect();
        });

        document.addEventListener('click', (e) => {
            if (this.select.classList.contains('is-open')) {
                const isClickInside = this.select.contains(e.target);
                if (!isClickInside) {
                    this.closeSelect();
                }
            }
        });

        window.addEventListener('resize', () => {
            if (!this.isMobile()) {
                this.closeSelect();
            }
        });
    }

    toggleSelect() {
        this.select.classList.toggle('is-open');
        
        const isOpen = this.select.classList.contains('is-open');
        this.heading.setAttribute('aria-expanded', isOpen);
    }

    closeSelect() {
        this.select.classList.remove('is-open');
        this.heading.setAttribute('aria-expanded', 'false');
    }
}
