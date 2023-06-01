document.addEventListener("DOMContentLoaded", function () {
    const commentForm = document.querySelector("#commentForm");
    const formMessage = document.createElement("p");
    formMessage.style.display = "none";
    commentForm.appendChild(formMessage);

    commentForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "a_propos.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    formMessage.textContent = response.message;
                    formMessage.style.display = "block";

                    setTimeout(() => {
                        formMessage.style.display = "none";
                    }, 5000);
                } else {
                    // Gérer l'erreur ici
                    formMessage.textContent = "Une erreur s'est produite : " + response.message;
                    formMessage.style.display = "block";

                    setTimeout(() => {
                        formMessage.style.display = "none";
                    }, 5000);
                }

                commentForm.reset();
            }
        };

        const formData = new FormData(commentForm);
        const data = new URLSearchParams();
        for (const pair of formData) {
            data.append(pair[0], pair[1]);
        }

        xhr.send(data.toString());
    });
});
