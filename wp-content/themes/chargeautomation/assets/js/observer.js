const $dom = {
    elements: document.querySelectorAll('[data-inviewport]')
};

const observer = () => {
    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting === true) {
                entry.target.classList.add('is-inviewport');
            }

            else {
                entry.target.classList.remove('is-inviewport');
            }
        });
    });

    $dom.elements.forEach((element) => {
        observer.observe(element)
    });
}

export default observer;