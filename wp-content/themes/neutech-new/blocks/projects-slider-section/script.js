import EmblaCarousel from 'embla-carousel';

export default function initProjectsSlider() {
    
    const sliders = document.querySelectorAll('.projects-slider__slider');
    if (sliders.length === 0) return;

    sliders.forEach(sliderNode => {
        const viewportNode = sliderNode.querySelector('.embla__viewport');
        const prevBtnNode = sliderNode.querySelector('.projects-slider__btn--prev');
        const nextBtnNode = sliderNode.querySelector('.projects-slider__btn--next');
        const paginationNode = sliderNode.querySelector('.projects-slider__pagination');

        if (!viewportNode) return;

        const options = { 
            loop: false, 
            align: 'start', 
            containScroll: 'trimSnaps' 
        };
        
        const emblaApi = EmblaCarousel(viewportNode, options);

        
        if (prevBtnNode) prevBtnNode.addEventListener('click', () => emblaApi.scrollPrev(), false);
        if (nextBtnNode) nextBtnNode.addEventListener('click', () => emblaApi.scrollNext(), false);

        const updateNavButtons = () => {
            if (!prevBtnNode || !nextBtnNode) return;

            emblaApi.canScrollPrev() ? prevBtnNode.disabled = false : prevBtnNode.disabled = true;
            emblaApi.canScrollNext() ? nextBtnNode.disabled = false : nextBtnNode.disabled = true;
        };

        
        let dotNodes = [];

        const generateDots = () => {
            if (!paginationNode) return;
            paginationNode.innerHTML = ''; 
            
            const scrollSnaps = emblaApi.scrollSnapList();
            
            dotNodes = scrollSnaps.map((_, index) => {
                const dot = document.createElement('button');
                dot.classList.add('embla__dot', 'projects-slider__dot');
                dot.setAttribute('type', 'button');
                dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
                
                
                dot.addEventListener('click', () => emblaApi.scrollTo(index), false);
                
                paginationNode.appendChild(dot);
                return dot;
            });
        };

        const updateDots = () => {
            const previous = emblaApi.previousScrollSnap();
            const selected = emblaApi.selectedScrollSnap();
            
            if (dotNodes[previous]) dotNodes[previous].classList.remove('is-active');
            if (dotNodes[selected]) dotNodes[selected].classList.add('is-active');
        };

        
        
        emblaApi.on('init', () => {
            generateDots();
            updateDots();
            updateNavButtons();
        });

        
        emblaApi.on('reInit', () => {
            generateDots();
            updateDots();
            updateNavButtons();
        });

        
        emblaApi.on('select', () => {
            updateDots();
            updateNavButtons();
        });
    });
}