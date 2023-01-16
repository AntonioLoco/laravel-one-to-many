import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// Prendo tutti i button per cancellare che sono all'interno del form delete
const deleteBtns = document.querySelectorAll(".delete-btn");

//Aggiungo con un forEach a tutti i bottoni un evento
deleteBtns.forEach( (btn) => {
    btn.addEventListener("click", function(event) {
        //Blocco invio del fomr
        event.preventDefault();
        //Prendo l'attributo che passo al btn per prendere il nome
        const projectTitle = btn.getAttribute("data-project-title");
        //Prendo il modal che ho nel partials
        const modal = new bootstrap.Modal(document.getElementById("deleteModal"));
        //Inserisco nello span dove dovrei mettere il titolo, il titolo preso prima
        document.getElementById("modal-project-title").innerText = projectTitle;
        //Prendo il bottone cancella all'interno del modal e gli dico al click
        document.getElementById("delete").addEventListener("click", () => {
            // Prendo il btn nel form principale e gli dico che il parente (ovvero il form) deve essere inviato
            btn.parentElement.submit();
        });
        modal.show();
    })
})