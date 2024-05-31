document.addEventListener('DOMContentLoaded', function () {
    let boutonCategorie = document.querySelectorAll('.bouton__categorie');

    for (const bouton of boutonCategorie) {
        bouton.addEventListener('click', function (e) {
            let country = e.target.getAttribute('data-country').toLowerCase();

            // Récupérer tous les articles
            fetch('https://gftnth00.mywhc.ca/tim38/wp-json/wp/v2/posts')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("La requête a échoué avec le statut " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    let restapi = document.querySelector(".contenu__restapi");
                    restapi.innerHTML = "";

                    // Filtrer les articles en fonction du pays (insensible à la casse)
                    let filteredData = data.filter(article => {
                        return article.title.rendered.toLowerCase().includes(country);
                    });

                    // Afficher les articles filtrés
                    filteredData.forEach(article => {
                        let titre = article.title.rendered;
                        let contenu = article.content.rendered;
                        let lien = article.link;
                        contenu = contenu.substr(0, 75) + " ... ";

                        let carte = document.createElement("div");
                        carte.classList.add("restapi__carte2");
                        carte.innerHTML = `
                            <h2>${titre}</h2>
                            <p>${contenu}</p>
                            <p><a href="${lien}">Voir la suite</a></p>
                        `;
                        restapi.appendChild(carte);
                    });

                    // Afficher un message si aucun article trouvé
                    if (filteredData.length === 0) {
                        let message = document.createElement("p");
                        message.textContent = "Aucun article trouvé pour ce pays.";
                        restapi.appendChild(message);
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des données :", error);
                });
        });
    }
});