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
import initFooter from './modules/footer';
import "./modules/mobileMenu";

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
        initFooter();
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
