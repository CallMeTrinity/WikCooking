document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.querySelector("#footerform");
    const formMessage = document.createElement("p");
    formMessage.style.display = "none";
    contactForm.appendChild(formMessage);

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/contact.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                formMessage.textContent = "Votre message a bien été envoyé.";
                formMessage.style.display = "block";

                setTimeout(() => {
                    formMessage.style.display = "none";
                }, 5000);

                contactForm.reset();
            }
        };

        const formData = new FormData(contactForm);
        const data = new URLSearchParams();
        for (const pair of formData) {
            data.append(pair[0], pair[1]);
        }

        xhr.send(data.toString());
    });
});
