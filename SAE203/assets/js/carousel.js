window.onload = function() {
    var track = document.querySelector('.carousel__track');
    var slides = Array.from(track.children);
    var slideWidth = slides[0].getBoundingClientRect().width;

    // Arrange les diapositives les unes à côté des autres
    slides.forEach((slide, index) => {
        slide.style.left = slideWidth * index + 'px';
    });

    var currentIndex = 0;
    setInterval(() => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
            track.style.transform = 'translateX(0)';
            return;
        }
        track.style.transform = 'translateX(-' + slideWidth * currentIndex + 'px)';
    }, 3000);
}
