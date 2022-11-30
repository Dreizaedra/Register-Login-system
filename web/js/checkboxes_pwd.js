const checkboxes = document.getElementsByClassName("show-checkbox");

// on ajoute un onclick event pour chaque checkbox cliquée
for (let i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener("click", function() {
        // envoie l'id de la checkbox cliquée au sélecteur d'id
        // envoie aussi le boolean false parce que 
        // on ne passe PAS par le bouton générer un mdp aléatoire
        id_selector(this.id, false);
    });
}

function id_selector(checkbox_id, generated_pwd_bool) {
    let checkbox_selector = document.getElementById(checkbox_id);
    // on va chercher l'input field et le cb_help correspondants via .replace()
    let input_selector = 
        document.getElementById(checkbox_id.replace('-cb', ''))
    ;

    let checkbox_help_selector = 
        document.getElementById(checkbox_id.replace('-cb', '-cb-help'))
    ;

    // call la fonction qui check si on est passés par la génération aléatoire
    generate_checker(checkbox_selector, generated_pwd_bool);
    // envoie les données 
    update_fields(checkbox_selector, input_selector, checkbox_help_selector);
}

function generate_checker(checkbox, generated) {
    if (generated) {
        checkbox.checked = true;
    }
}

function update_fields(checkbox, input, help) {
    // si la checkbox est cochée affiche le mot de passe
    if (checkbox.checked) {
        input.type = "text";
        help.textContent = 'Visible';
    // sinon le cache
    } else {
        input.type = "password";
        help.textContent = 'Hidden';
    }
}
