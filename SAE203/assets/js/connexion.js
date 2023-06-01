let cardInner = document.querySelector('.flip-card-inner');
let flipButtons = document.querySelectorAll('.flip');

flipButtons.forEach(button => {
    button.addEventListener('click', () => {
        cardInner.classList.toggle('active');
    });
});

