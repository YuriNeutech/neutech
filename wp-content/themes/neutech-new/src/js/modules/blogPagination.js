import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/all";
gsap.registerPlugin(ScrollTrigger);

export default class BlogPagination {
    constructor() {

        this.button = document.getElementById('load-more');
        this.container = document.getElementById('post-container');
        this.ajaxUrl = blogSettings.ajaxUrl;

        if (!this.button || !this.container) return;

        this.init();
    }

    init() {
        this.button.addEventListener('click', (e) => this.handleLoadMore(e));
    }


    async handleLoadMore(e) {
        e.preventDefault();

        if (this.button.classList.contains('is-loading')) return;

        const config = {
            page: parseInt(this.button.getAttribute('data-page')),
            max: parseInt(this.button.getAttribute('data-max')),
            category: this.button.getAttribute('data-category') || '',
            search: this.button.getAttribute('data-search') || '',
            exclude: this.button.getAttribute('data-exclude') || '[]'
        };

        this.toggleLoading(true);

        try {
            const response = await this.fetchPosts(config);
            const html = await response.text();

            if (html.trim().length > 0) {
                this.renderPosts(html);
                this.updatePagination(config.page, config.max);
            } else {
                this.removeButton();
            }
        } catch (error) {
            console.error('BlogPagination Error:', error);
        } finally {
            this.toggleLoading(false);
        }
    }

    fetchPosts({ page, category, search, exclude }) {
        const formData = new URLSearchParams();
        formData.append('action', 'load_more_posts');
        formData.append('page', page);
        formData.append('category', category);
        formData.append('search', search);
        formData.append('exclude', exclude);

        return fetch(this.ajaxUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        });
    }

    renderPosts(html) {
        const temp = document.createElement('div');
        temp.innerHTML = html.trim();
        
        const newCards = Array.from(temp.children);
        
        this.container.append(...newCards);


        gsap.fromTo(newCards, 
            { 
                y: 30, 
                opacity: 0,
                filter: "blur(5px)" 
            }, 
            { 
                y: 0, 
                opacity: 1, 
                filter: "blur(0px)",
                duration: 0.6, 
                stagger: 0.15, 
                ease: "power2.out" 
            }
        );
    }

    updatePagination(currentPage, maxPages) {
        const nextPage = currentPage + 1;
        this.button.setAttribute('data-page', nextPage);

        if (nextPage >= maxPages) {
            this.removeButton();
        }
    }

    toggleLoading(isLoading) {
        const textWr = this.button.querySelector('.btn__text-wr');
        
        if (isLoading) {
            this.button.classList.add('is-loading');
            if (textWr) textWr.dataset.originalText = textWr.textContent;
            if (textWr) textWr.textContent = 'Loading...';
        } else {
            this.button.classList.remove('is-loading');
            if (textWr) textWr.textContent = textWr.dataset.originalText || 'View More';
        }
    }

    removeButton() {
        const parent = this.button.parentElement;
        if (parent) parent.remove();
    }
}