function generate_pwd() {
    let fetch_status;
    fetch(local_datas.urls.ajax, {
        method: "GET",
        headers: {
            "Content-type": "application/json;charset=UTF-8"
        }
    })
    .then(function(response) {
        fetch_status = response.status;
        return response.json();
    })
    .then(function(json) {
        if (fetch_status === 200) {
            const input_pwd = document.getElementById("pwd");
            input_pwd.value = json;

            // affiche le mot de passe généré & coche la checkbox correspondante 
            // en envoyant les données au sélecteur d'id & le bool true 
            // pour lui dire qu'on est passés par le générateur aléatoire
            id_selector("pwd-cb", true);
        }
    })
    .catch(function(error) {
        console.log(error);
    })
}