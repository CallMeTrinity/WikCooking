document.querySelectorAll('.btn-delete').forEach(function (button) {
    button.addEventListener('click', function (e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce mail ?')) {
            e.preventDefault();
        }
    });
});
document.querySelectorAll('.email-card').forEach(function (card) {
    card.addEventListener('click', function () {
        const message = card.querySelector('.email-message');
        if (message.style.maxHeight === '0px') {
            message.style.maxHeight = '100px'; // Change this value to adjust the maximum height of the displayed message
            message.style.opacity = '1';
        } else {
            message.style.maxHeight = '0px';
            message.style.opacity = '0';
        }
    });
});

var dir = "asc"; // déplacer en dehors de la fonction pour qu'il reste entre les appels

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById("tableRecipe");
    switching = true;

    // Remove classes from all headers
    var headers = table.getElementsByTagName("TH");
    for (var h = 0; h < headers.length; h++) {
        headers[h].classList.remove('asc');
        headers[h].classList.remove('desc');
    }

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (n === 0) { // If the column is the ID, sort as number
                // Clean up the content before converting to number
                var xContent = x.innerHTML.trim();
                var yContent = y.innerHTML.trim();

                if (dir == "asc") {
                    if (parseInt(xContent) > parseInt(yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (parseInt(xContent) < parseInt(yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else { // For all other columns, sort as strings
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }

    // Add class to the clicked header after sorting
    if (dir == "asc") {
        headers[n].classList.add('desc');
    } else {
        headers[n].classList.add('asc');
    }
    dir = dir == "asc" ? "desc" : "asc"; // basculer la direction pour le prochain tri
}


document.getElementById('idHeader').addEventListener('click', function () {
    sortTable(0);
});
document.getElementById('titleHeader').addEventListener('click', function () {
    sortTable(1);
});
document.getElementById('authorHeader').addEventListener('click', function () {
    sortTable(2);
});
document.getElementById('descHeader').addEventListener('click', function () {
    sortTable(3);
});
document.getElementById('dateHeader').addEventListener('click', function () {
    sortTable(4);
});
document.getElementById('ingredientHeader').addEventListener('click', function () {
    sortTable(5);
});
document.getElementById('instructionsHeader').addEventListener('click', function () {
    sortTable(6);
});
document.getElementById("defaultSortButton").addEventListener("click", function () {
    location.reload(); // Cela recharge la page, ce qui réinitialise le tableau
});


function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tableRecipe");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Assume the search is for recipe title
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

var instructions = document.getElementsByClassName('instruction');
for (var i = 0; i < instructions.length; i++) {
    instructions[i].addEventListener('click', function () {
        this.classList.toggle('active');
    });
}

document.getElementById('editButton').addEventListener('click', function() {
    var inputs = document.querySelectorAll('#profileForm input');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
    document.getElementById('saveButton').style.display = 'block';
    this.style.display = 'none';
});
