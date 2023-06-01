const stars = document.querySelectorAll('.etoile');
const btn = document.querySelector('input[type="submit"]');


// Add click event listener to each star
stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        // Update clicked star and preceding stars to yellow
        for (let i = 0; i <= index; i++) {
            stars[i].classList.add('jaune');
            let number = parseInt(star.id)
            console.log('id est : ' + number);
            const numero = document.getElementById('numero')
            numero.setAttribute('value' , number)

            if (typeof numero <= 5 && numero >= 1) {
                btn.classList.add('invisible');

            } else {
                btn.classList.remove('invisible')
            }

        }

        // Update succeeding stars to gray
        for (let i = index + 1; i < stars.length; i++) {
            stars[i].classList.remove('jaune');
        }
    });
});

