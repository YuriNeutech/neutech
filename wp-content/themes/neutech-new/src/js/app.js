import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

import initBenefitsSlider from '../../blocks/benefits-section/script';
import initVideoSection from '../../blocks/video-section/script';
import initHeader from './modules/header';
import initMagneticButton from "./modules/magneticButton";
import initHero from '../../blocks/hero-section/script';
import Preloader from './modules/preloader';
import initActionIcon from './modules/actionIcon';
import initStepsSection from '../../blocks/process-steps-section/script';
import initFaq from '../../blocks/faq-section/script';
import initLeadForm from '../../blocks/lead-form-section/script';
import initFooter from './modules/footer';
import initSectionReveal from './modules/sectionReveal';
import "./modules/mobileMenu";

// Ported client marketing-page block scripts (from Kinsta staging).
import initPageHero from '../../blocks/page-hero-section/script';
import initTwoColSection from '../../blocks/two-columns-section/script';
import initTextContentSection from '../../blocks/text-content-section/script';
import initTextButtonSection from '../../blocks/text-button-block-section/script';
import initCenterImgContent from '../../blocks/content-centered-image-section/script';
import initFeaturesGridSection from '../../blocks/features-grid-section/script';
import initWheelSection from '../../blocks/wheel-section/script';
import initProjectsSlider from '../../blocks/projects-slider-section/script';
import initTilesSection from '../../blocks/tiles-section/script';

document.addEventListener('DOMContentLoaded', () => {
    new Preloader();

    const initPage = () => {
        initHero();
        initActionIcon();
        initBenefitsSlider();
        initVideoSection();
        initHeader();
        initMagneticButton();
        initStepsSection();
        initFaq();
        initLeadForm();
        // Ported client marketing-page blocks.
        initPageHero();
        initTwoColSection();
        initTextContentSection();
        initTextButtonSection();
        initCenterImgContent();
        initFeaturesGridSection();
        initWheelSection();
        initProjectsSlider();
        initTilesSection();
        initFooter();
        initSectionReveal();
    }

    if (document.querySelector('#preloader')) {
        window.addEventListener('preloader-done', () => {
            console.log('Preloader finished! Starting Hero animation...');
            initPage();
        });
    } else {
        initPage();
    }
    
});
