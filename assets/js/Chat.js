////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////Disscution chatbot & utilisateurs//////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

// Fonction pour envoyer le message + disscussion entre le chatbot et l'utilisateur

function envoyerMessage() {
  // Récupération du texte dans le champ de texte.
  var recupererMessage = document.getElementById("envoyer").value;

  // Vérification que le champ de texte n'est pas vide.
  if (recupererMessage.trim() !== "") {
    // Création d'un élément HTML <div> pour afficher le message de l'utilisateur
    var div = document.createElement("div");
    div.textContent = document.getElementById("envoyer").value;
    var msg = document.getElementById("msg");

    // Ajout des classes CSS pour afficher le message de l'utilisateur sous forme de bulle bleue
    div.classList.add("messages__item", "messages__item--operator");

    // Ajout de la div comme enfant de l'élément HTML avec l'identifiant "msg"
    msg.appendChild(div);

    // Création d'un élément HTML <div> pour afficher la réponse du chatbot
    var divReponse = document.createElement("div");

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////Connexion Utilisateur via chat/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
    if (recupererMessage.toLowerCase() === "connexion") {
      // Réponse spécifique pour le mot-clé "admin"
      divReponse.classList.add("messages__item", "messages__item--visitor");
      divReponse.innerHTML = `
    <form class="chatbot-form">
      <h2 class="title">Connexion</h2>
      <label for="email">E-mail :</label>
      <input type="text" placeholder="Adresse email" id="email" />
      <br>
      <label for="password">Mot de passe :</label>
      <input type="password" placeholder="Mot de passe" id="motDePasse" />
      <br>
      <button type="submit" class="boutonConnexion">Se connecter</button>
    </form>
  `;
      // Récupère le bouton de connexion et ajoute un gestionnaire d'événements pour le clic
      var boutonConnexion = divReponse.querySelector(".boutonConnexion");
      boutonConnexion.addEventListener("click", function (event) {
        // Empêche le comportement par défaut du formulaire
        event.preventDefault();

        // Récupère les valeurs des champs de formulaire
        var email = document.getElementById("email").value;
        var motDePasse = document.getElementById("motDePasse").value;
        // Envoie les données au fichier PHP via AJAX
        $.ajax({
          url: "/chatbot/php/actionsChatbot/actionConnexionAdminUtilisateurs.php",
          type: "POST",
          //dataType: 'json',
          data: JSON.stringify({
            email: email,
            motDePasse: motDePasse,
          }),
          processData: false,
          success: function (response) {
            response = response.trim();
            // Code à exécuter lorsque la réponse du fichier PHP est reçue
            console.log("response", response == "connexion_reussie");
            if (response == "connexion_reussie") {
              console.log(divReponse);
              divReponse.classList.add(
                "messages__item",
                "messages__item--visitor"
              );
              divReponse.innerHTML = `
                <p>Vous êtes connecté !</p>
                <button class="boutonCommande">Commandes</button>
                <button class="boutonCategorie">Catégories produit</button>
                <button class="boutonPanier">Panier</button>
                <button class="boutonDeconnexion">Déconnexion</button>
            `;
              // Ajouter l'événement de déconnexion au bouton de déconnexion
              var boutonDeconnexion = divReponse.querySelector(".boutonDeconnexion");
              boutonDeconnexion.addEventListener("click", function () {
                console.log('ici');
                // Envoyer une requête AJAX pour déconnecter l'utilisateur
                $.ajax({
                  url: "/chatbot/php/actionsChatbot/actionDeconnexionSession.php",
                  type: "POST",
                  data: JSON.stringify({
                    deconnexion: boutonDeconnexion
                  }),
                  processData: false,
                  success: function (responseDeconnexion) {
                    console.log(responseDeconnexion);
                    if (responseDeconnexion.status == "success") {
                      // Afficher un message d'erreur si la connexion échoue
                      divReponse.classList.add(
                        "messages__item",
                        "messages__item--assistant"
                      );
                      divReponse.innerHTML = `
                    <p>Vous avez été déconnecté.</p>
                  `;
                    }
                  },
                });
              });

                ///////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////  ///////////////////////////////////////////////////////////////
                // Accès aux produits ou au panier après avoir cliqué sur "Commandes" ou "Panier" dans le chatbot//
                ///////////////////////////////////////////////////////////////////////////////////////////////////

                // Ajout de la div de réponse comme enfant de l'élément HTML avec l'identifiant "msg"
                //msg.appendChild(divReponse);

                var boutonCommande = divReponse.querySelector(".boutonCommande");
                boutonCommande.addEventListener("click", function () {
                  // Envoyer une requête AJAX pour récupérer la liste des produits
                  $.ajax({
                    url: "/chatbot/php/actionsChatbot/messageDatabaseProduits.php",
                    type: "GET",
                    dataType: "json",
                    processData: false,
                    success: function (response) {
                      // Construire la liste des produits
                      var produitsListe = "";
                      for (var i = 0; i < response.length; i++) {
                        produitsListe += "<p>" + response[i].photo_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].marque_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].modele_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].couleur_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].taille_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].prix_sneakers + "</p>";
                        produitsListe += "<p>" + response[i].genre_sneakers + "</p>";
                      }

                      // Créer un élément div pour contenir la liste des produits
                      var listeProduits = document.createElement("div");
                      listeProduits.id = "listeProduits";
                      listeProduits.classList.add("messages__item", "messages__item--assistant");

                      // Ajouter la liste des produits à la div
                      listeProduits.innerHTML = `
                      <p>Voici la liste des produits :</p>
                      ${produitsListe}
                      <button class="boutonRetour">Retour</button>
                    `;

                      // Ajouter la div au DOM, en tant qu'enfant de l'élément HTML avec l'identifiant "msg"
                      msg.appendChild(listeProduits);

                      // Clic sur le bouton "Retour" pour supprimer la bulle chatbot
                      var boutonRetour = listeProduits.querySelector(".boutonRetour");
                      boutonRetour.addEventListener("click", function () {
                        listeProduits.remove();
                      });
                      
                    }
                  });
                });

                var boutonCategorie = divReponse.querySelector(".boutonCategorie");
                boutonCategorie.addEventListener("click", function () {
                  // Envoyer une requête AJAX pour récupérer la liste des produits
                  $.ajax({
                    url: "/chatbot/php/actionsChatbot/actionConsultationCategorieProduit.php",
                    type: "GET",
                    dataType: "json",
                    processData: false,
                    success: function (response) {
                      // Construire la liste des catégories
                      var categoriesListe = "";
                      for (var i = 0; i < response.length; i++) {
                        categoriesListe += "<option value='" + response[i].categories_produits_id + "'>" + response[i].categories_produits_nom + "</option>";
                      }

                      // Créer un élément div pour contenir la liste déroulante des catégories
                      var listeCategories = document.createElement("div");
                      listeCategories.id = "listeCategories";
                      listeCategories.classList.add("messages__item", "messages__item--assistant");

                      // Ajouter la liste déroulante des catégories à la div
                      listeCategories.innerHTML = `
                              <p>Voici la liste des catégories de produits :</p>
                              <select id="categorieSelect">
                                  ${categoriesListe}
                              </select>
                              <button class="boutonRetour">Retour</button>
                              <button class="boutonValider">Valider</button>
                          `;

                      // Ajouter la div au DOM, en tant qu'enfant de l'élément HTML avec l'identifiant "msg"
                      msg.appendChild(listeCategories);

                      // Clic sur le bouton "Retour" pour supprimer la bulle chatbot
                      var boutonRetour = listeCategories.querySelector(".boutonRetour");
                      boutonRetour.addEventListener("click", function () {
                        listeCategories.remove();
                      });

                      // Obtenir la valeur de la catégorie sélectionnée lorsque l'utilisateur clique sur "Valider"
                      var boutonValider = listeCategories.querySelector(".boutonValider");
                      boutonValider.addEventListener("click", function () {
                        var categorieSelect = listeCategories.querySelector("#categorieSelect");
                        var categorieId = categorieSelect.value;
                        var categorieNom = categorieSelect.options[categorieSelect.selectedIndex].text;

                        // Faire quelque chose avec la catégorie sélectionnée (par exemple, l'envoyer au serveur)

                        // Supprimer la bulle chatbot
                        listeCategories.remove();
                      });
                    }
                  });
                });


                var boutonPanier = divReponse.querySelector(".boutonPanier");
                boutonPanier.addEventListener("click", function () {
                  // Envoyer une requête AJAX pour récupérer la liste des produits
                  $.ajax({
                    url: "/chatbot/php/actionsChatbot/messageDatabaseProduits.php",
                    type: "GET",
                    dataType: "json",
                    processData: false,
                    success: function (response) {
                      // Construire la liste des produits
                      var produitsPanier = "";
                      for (var i = 0; i < response.length; i++) {
                        produitsPanier += "<p>" + response[i].photo_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].marque_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].modele_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].couleur_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].taille_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].prix_sneakers + "</p>";
                        produitsPanier += "<p>" + response[i].genre_sneakers + "</p>";
                      }

                      // Créer un élément div pour contenir la liste des produits
                      var listePanier = document.createElement("div");
                      listePanier.id = "listePanier";
                      listePanier.classList.add("messages__item", "messages__item--assistant");

                      // Ajouter la liste des produits à la div
                      listePanier.innerHTML = `
                      <p>Voici la liste du panier :</p>
                      ${produitsPanier}
                      <button class="boutonRetour">Retour</button>
                    `;

                      // Ajouter la div au DOM, en tant qu'enfant de l'élément HTML avec l'identifiant "msg"
                      msg.appendChild(listePanier);

                      // Clic sur le bouton "Retour" pour supprimer la bulle chatbot
                      
                      var boutonRetour = listePanier.querySelector(".boutonRetour");
                      boutonRetour.addEventListener("click", function () {
                        listePanier.remove();
                      });
                    }
                  });
                });


              } else {

                // Afficher un message d'erreur si la connexion échoue
                divReponse.classList.add(
                  "messages__item",
                  "messages__item--assistant"
                );
                divReponse.innerHTML = `
              <p>Votre adresse e-mail ou mot de passe est incorrect. Veuillez réessayer de vous connecter.</p>
              `;
              }
            }
          }
        )
      });


      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////Connexion Admin///////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
    } else if (recupererMessage.toLowerCase() === "admin") {
      // Réponse spécifique pour le mot-clé "admin"
      divReponse.classList.add("messages__item", "messages__item--visitor");
      divReponse.innerHTML = `
    <div class="dashboard"><a href="/chatbot/php/connexion.php">Connexion au dashboard.</a></div>
    `;

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////Inscription Utilisateur via chat/////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
    } else if (recupererMessage.toLowerCase() === "inscription") {
      // Réponse spécifique pour le mot-clé "inscription"
      divReponse.classList.add("messages__item", "messages__item--visitor");
      divReponse.innerHTML = `
        <form class="chatbot-form">
          <h2 class="title">Inscription</h2>
          <label for="email">E-mail :</label>
          <input type="text" placeholder="Adresse email" id="emailInscription" />
          <br>
          <label for="password">Mot de passe :</label>
          <input type="password" placeholder="Mot de passe" id="motDePasseInscription" />
          <br>
          <label for="passwordConfirmation">Confirmation du mot de passe :</label>
          <input type="password" placeholder="Mot de passe" id="motDePasseConfirmation" />
          <br>
          <button type="submit" class="boutonInscription">S'inscrire</button>
        </form>
      `;
      var boutonInscription = divReponse.querySelector(".boutonInscription");
      boutonInscription.addEventListener("click", function (event) {
        event.preventDefault();
    
        var email = document.getElementById("emailInscription").value;
        var motDePasse = document.getElementById("motDePasseInscription").value;
        var motDePasseConfirmation = document.getElementById(
          "motDePasseConfirmation"
        ).value;
    
        if (motDePasse === motDePasseConfirmation) {
    
          // Envoie les données au fichier PHP via AJAX
          $.ajax({
            url: "/chatbot/php/actionsChatbot/actionConnexionAdminUtilisateurs.php",
            type: "POST",
            data: JSON.stringify({
              email: email,
              motDePasse: motDePasse,
            }),
            processData: false,
            success: function (responseInscription) {
              responseInscription = responseInscription.trim();
              console.log("response", '"' + responseInscription + '"');
              console.log("response", responseInscription == "inscription_reussie"
              );
              if (responseInscription == "inscription_reussie") {
                divReponse.classList.add(
                  "messages__item",
                  "messages__item--visitor"
                );
                divReponse.innerHTML = `
                  <div class="messages__item messages__item--assistant">
                    <p>Bienvenue dans votre compte !</p>
                    <button class="boutonCommande">Commande</button>
                    <button class="boutonCategorie">Commande</button>
                    <button class="boutonPanier">Panier</button>
                    <button class="boutonDeconnexion">Déconnexion</button>
                  </div>
                `;
    
                // Ajouter l'événement de déconnexion au bouton de déconnexion
                var boutonDeconnexion = divReponse.querySelector(".boutonDeconnexion");
                boutonDeconnexion.addEventListener("click", function () {
                  // Envoyer une requête AJAX pour déconnecter l'utilisateur
                  $.ajax({
                    url: "/chatbot/php/actionsChatbot/actionDeconnexionSession.php",
                    type: "POST",
                    data: JSON.stringify({
                      deconnexion: boutonDeconnexion
                    }),
                    processData: false,
                    success: function (responseDeconnexion) {
                      console.log(responseDeconnexion);
                      if (responseDeconnexion.status == "success") {
                        divReponse.innerHTML = `
                        <div class="messages__item messages__item--assistant">
                          <p>Vous avez été déconnecté.</p>
                        </div>
                      `;
                      }
                    },
                  });
                });
              }
            },
          });
    
        }
      });
    
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////Accès panier via chat////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

    } else if (recupererMessage.toLowerCase() === "consulter panier") {

              // Création de l'élément div
              var divReponse = document.createElement("div");
              divReponse.classList.add("messages__item", "messages__item--visitor");
              divReponse.innerHTML = `
                <p>Contenu du panier :</p>
                <ul>
                  <li id="produit1">Converse Chuck Taylor</li>
                  <li id="produit2">Adidas Web Boost</li>
                  <li id="produit3">New Balance GR997</li>
                  <li id="produit4">Nike Airforce One</li>
                  <li id="produit5">Nike Airmax</li>
                </ul>
                <button class="boutonRetour">Retour</button>
              `;

              // Ajout de divReponse au document
              document.body.appendChild(divReponse);

              // Variables pour stocker les produits
              var produits = document.getElementById("produitsPanier");

              // Attacher l'événement "click" au bouton "Retour"
              var boutonRetour = divReponse.querySelector(".boutonRetour");
              boutonRetour.addEventListener("click", function () {
                // Logique pour revenir en arrière
              });


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//Connexion à la base de données pour récupérer la réponse associée au message de l'utilisateur/
////////////////////////////////////////////////////////////////////////////////////////////////

   } else { 
    
              $.ajax({
                url: "/chatbot/php/actionsChatbot/messageDatabaseMotsCles.php",
                type: "POST",
                dataType: "json",
                data: JSON.stringify({ motscles: recupererMessage }),
                processData: false,
                success: function (response) {
                  if (response.question !== "") {
                    // Si une réponse est trouvée dans la base de données
                    var phraseAssociee = response.question;
                    divReponse.classList.add(
                      "messages__item",
                      "messages__item--visitor"
                    );
                    divReponse.textContent = phraseAssociee;

          } else {

            // Si aucun résultat n'est trouvé dans la base de données, afficher une réponse aléatoire
            var reponsesAleatoires = [
              "Désolé, je ne comprends pas.",
              "Je ne peux pas répondre à cette question.",
              "Pouvez-vous reformuler votre question ?",
            ];
            var reponseAleatoire =
              reponsesAleatoires[
              Math.floor(Math.random() * reponsesAleatoires.length)
              ];
            divReponse.classList.add(
              "messages__item",
              "messages__item--visitor"
            );
            divReponse.textContent = reponseAleatoire;
          }

        },
      })
    }
  }
    // Ajout de la div de réponse comme enfant de l'élément HTML avec l'identifiant "msg"
    msg.appendChild(divReponse);

    // Effacement du champ de texte
    champTexte.value = "";
}
