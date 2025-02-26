import $ from 'jquery';
import {
    initializeMainSlider,
    initializeNewWhyStudySlider,
    initializeImageContentSlider,
    initializePartnerLogosSlider, initializeOffersCategoriesSlider
} from './__sliders';
import {fetchYouTubeShorts} from './__YouTubeSlider';
import {
    filterAccordion,
    copyAccountNumber,
    initializeAccordion,
    initializeTabsContainer,
    enableSkipLink, updateResponsiveImages
} from './__customFunctions';

class General {
    constructor() {
        console.log('General initialized!');
        this.youTubeSlider();
        this.bindEvents();
        enableSkipLink();

    }

    youTubeSlider() {
        // Fetch YouTube Shorts for all instances of .youtube-slider
        document.querySelectorAll(".youtube-slider").forEach(slider => {
            fetchYouTubeShorts(slider);
        });
    }

    bindEvents() {
        filterAccordion('.filter_accordion_header');
        initializeOffersCategoriesSlider('.offer_category_slider');
        initializeAccordion('.accordion_container');
        initializeTabsContainer('.tabs_container');
        copyAccountNumber('.copy_account_number');
        initializePartnerLogosSlider('.partner_logos_slider');
        initializeNewWhyStudySlider('.new_study_slider');


        document.querySelectorAll('.main_slider').forEach(slider => {
            initializeMainSlider(slider);
        });

        // Initialize for all instances of .image_content_slider
        document.querySelectorAll('.image_content_slider').forEach(slider => {
            initializeImageContentSlider(slider);
        });

        //  Run immediately on script execution
        updateResponsiveImages('.responsive-image');

        //  Run again when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => updateResponsiveImages('.responsive-image'));

        // Run when all assets (including images) are fully loaded
        window.addEventListener('load', () => updateResponsiveImages('.responsive-image'));

        // Run on window resize
        window.addEventListener('resize', () => updateResponsiveImages('.responsive-image'));

    }

}

export default General;
