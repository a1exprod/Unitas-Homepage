document.addEventListener('DOMContentLoaded', function() {
    let valueDisplays = document.querySelectorAll(".num");
    let interval = 1300;

    let observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.9 // Change this value as needed
    };

    let observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                let valueDisplay = entry.target;
                let startValue = 0;
                let endValue = parseInt(valueDisplay.getAttribute("data-val"));
                let duration = Math.floor(interval / endValue);
                let counter = setInterval(function () {
                    startValue += 1;
                    valueDisplay.textContent = startValue;
                    if (startValue == endValue) {
                        clearInterval(counter);
                    }
                }, duration);
                observer.unobserve(valueDisplay); // Stop observing the element once the animation has started
            }
        });
    }, observerOptions);

    valueDisplays.forEach(valueDisplay => {
        observer.observe(valueDisplay);
    });
});
