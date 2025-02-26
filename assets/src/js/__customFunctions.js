import $ from 'jquery';


export function filterAccordion(accordionHeaderSelector) {
    const $headers = $(accordionHeaderSelector);

    $headers.on('click', function () {
        const $header = $(this);
        $header.toggleClass('active');

        // Toggle content visibility
        const $content = $header.next();
        $content.slideToggle(300);
    });
}


export function initializeAccordion(accordionSelector) {
    $(document).ready(function ($) {
        // Close all accordion items except the first one
        const $accordionItems = $(accordionSelector).find(".accordion-item");
        $accordionItems.removeClass("active").find(".accordion-content").hide();
        $accordionItems.find(".accordion-arrow").css("transform", "rotate(45deg)");

        // Open only the first accordion item by default
        const $firstItem = $accordionItems.first();
        $firstItem.addClass("active");
        $firstItem.find(".accordion-content").show();
        $firstItem.find(".accordion-arrow").css("transform", "rotate(-135deg)");

        $(accordionSelector).find(".accordion-header").on("click", function (event) {
            event.preventDefault(); // Prevent page jump
            const $accordionItem = $(this).parent();
            const $content = $(this).next();
            const $arrow = $(this).find(".accordion-arrow");
            const isActive = $accordionItem.hasClass("active");

            // Close all other accordions
            $accordionItems.not($accordionItem).removeClass("active").find(".accordion-content").slideUp(300);
            $accordionItems.not($accordionItem).find(".accordion-arrow").css("transform", "rotate(45deg)");

            // Toggle the clicked accordion item
            if (!isActive) {
                $accordionItem.addClass("active");
                $content.slideDown(300);
                $arrow.css("transform", "rotate(-135deg)");
            } else {
                $accordionItem.removeClass("active");
                $content.slideUp(300);
                $arrow.css("transform", "rotate(45deg)");
            }
        });
    });
}

export function initializeTabsContainer(tabsSelector) {
    $(document).ready(function ($) {
        $(tabsSelector).each(function () {
            const $tabsContainer = $(this);
            const $tabs = $tabsContainer.find(".tab");
            const $tabContents = $tabsContainer.find(".tab-content");

            // Ensure only the first tab is active by default
            $tabs.removeClass("active").first().addClass("active");
            $tabContents.removeClass("active").first().addClass("active");

            $tabs.on("click", function () {
                const tabId = $(this).data("tab");
                const $targetContent = $tabsContainer.find("#" + tabId);

                // Ensure target content exists before toggling
                if ($targetContent.length) {
                    $tabs.removeClass("active");
                    $tabContents.removeClass("active");

                    $(this).addClass("active");
                    $targetContent.addClass("active");
                }
            });
        });
    });
}

export function copyAccountNumber(selector) {
    $(document).ready(function ($) {
        $(document).on("click", selector, function () {
            const accountNumber = $(this).text().trim();
            const tempInput = $("<input>");
            $("body").append(tempInput);
            tempInput.val(accountNumber).select();
            document.execCommand("copy");
            tempInput.remove();

            // Show tooltip
            const $tooltip = $("<span class='copy-tooltip'>Copied!</span>");
            $(this).append($tooltip);
            $tooltip.fadeIn(200).delay(1000).fadeOut(300, function () {
                $(this).remove();
            });
        });
    });
}

export function enableSkipLink(selector = ".skip-link") {
    $(document).ready(function ($) {
        const $skipLink = $(selector);
        const $mainContent = $("#primary");

        if ($skipLink.length && $mainContent.length) {
            $skipLink.on("click", function (event) {
                event.preventDefault();
                $mainContent.attr("tabindex", "-1").focus();
            });
        }
    });
}

/**
 *  Universal function to update images dynamically based on screen size.
 * @param {string} selector - The CSS selector for images (default: '.responsive-image')
 */
export function updateResponsiveImages(selector = '.responsive-image') {
    if (typeof selector !== 'string') {
        console.error('updateResponsiveImages: Selector must be a string.');
        return;
    }

    const images = document.querySelectorAll(selector);

    if (!images || images.length === 0) {
        console.warn(`updateResponsiveImages: No images found for selector "${selector}"`);
        return; // ✅ Prevents running if no images exist
    }

    Array.from(images).forEach(img => {
        const mobileSrc = img.getAttribute('data-mobile');
        const desktopSrc = img.getAttribute('data-desktop');

        let newSrc = desktopSrc; // Default to desktop

        if (window.innerWidth <= 480 && mobileSrc) {
            newSrc = mobileSrc;
        }

        if (img.getAttribute('src') !== newSrc) { // ✅ Prevent unnecessary updates
            img.setAttribute('src', newSrc);
        }
    });
}
