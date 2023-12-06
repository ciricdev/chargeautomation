// Accordion
const toggleAccordion = ($accordionRoot) => {
    // Global accordion
    $accordionRoot.find('.ca-accordion').toggleClass('active');
    $accordionRoot.find('.ca-accordion__trigger').toggleClass('active');
    $accordionRoot.find('.ca-accordion__content').toggleClass('active');
};

/** Global accordion */
const createAccordion = ($root) => {
    $root.find('.ca-accordion__trigger').on('click', () => toggleAccordion($root));
};

 $('.ca-accordion').each(function() {
    createAccordion($(this));
});

$('.ca-home-accordion-trigger').on('click', () => {
    $('html, body').animate({ scrollTop: "0" }, 200);
    toggleAccordion($('.ca-accordionHomeHero'));
});