////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////Discution chatbot & utilisateurs//////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

// Fonction pour envoyer le message + disscussion entre le chatbot et l'utilisateur

function envoyerMessage() {
  // Récupération du texte dans le champ de texte.
  var recupererMessage = document.getElementById("envoyer").value;
  console.log(recupererMessage);

  // Vérification que le champ de texte n'est pas vide.
  if (recupererMessage.trim() !== "") {
    // Envoi du message
    // Code pour envoyer le message...
    console.log("Le message " + recupererMessage + " a été envoyé !");

    // Création d'un élément HTML <div> pour afficher le message de l'utilisateur
    var div = document.createElement("div");
    div.textContent = document.getElementById("envoyer").value;
    var msg = document.getElementById("msg");

    // Ajout des classes CSS pour afficher le message de l'utilisateur sous forme de bulle bleue
    div.classList.add("messages__item", "messages__item--operator");

    // Ajout de la div comme enfant de l'élément HTML avec l'identifiant "msg"
    msg.appendChild(div);

    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////Connexion Utilisateur///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////

    // Création d'un élément HTML <div> pour afficher la réponse du chatbot
    var divReponse = document.createElement("div");

    // Vérification du mot-clé "admin"
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
            console.log("response", '"' + response + '"');
            console.log("response", response == "connexion_reussie");
            if (response == "connexion_reussie") {
              console.log(divReponse);
              divReponse.classList.add(
                "messages__item",
                "messages__item--visitor"
              );
              divReponse.innerHTML = `
              <div class="messages__item messages__item--assistant">
                <p>Bienvenue dans votre compte !</p>
                <button class="boutonCommande">Commande</button>
                <button class="boutonPanier">Panier</button>
                <button class="boutonDeconnexion">Déconnexion</button>
              </div>
            `;

              ////////////////////////////////////////////////////////////////////////////////////////////////
              //////////////////////////////////  //////////////////////////////////////////////////////////////
              //////////////Accès aux produits après avoir cliqué sur "Commandes" dans le chatbot/////////////
              ////////////////////////////////////////////////////////////////////////////////////////////////

              // Ajoute le divReponse au DOM ici

              // Ajout de la div de réponse comme enfant de l'élément HTML avec l'identifiant "msg"
              //msg.appendChild(divReponse);

              var boutonCommande = divReponse.querySelector(".boutonCommande");
              var boutonPanier = divReponse.querySelector(".boutonPanier");
              var boutonDeconnexion =
                divReponse.querySelector(".boutonDeconnexion");

              boutonCommande.addEventListener("click", function () {
                console.log('Clic sur le bouton "Commande"');
                // Envoyer une requête AJAX pour récupérer la liste des produits
                $.ajax({
                  url: "/chatbot/php/actionsChatbot/messageDatabaseProduits.php",
                  type: "GET",
                  dataType: "json",
                  success: function (response) {
                    // Construire la liste des produits
                    var produitsListe = "";
                    for (var i = 0; i < response.length; i++) {
                      var produit = response[i];
                      produitsListe += `
                        <div>
                          <p>Marque: ${produit.marque_sneakers}</p>
                          <p>Modèle: ${produit.modele_sneakers}</p>
                          <p>Couleur: ${produit.couleur_sneakers}</p>
                          <p>Taille: ${produit.taille_sneakers}</p>
                          <p>Genre: ${produit.genre_sneakers}</p>
                          <p>Prix: ${produit.prix_sneakers} €</p>
                        </div>
                      `;
                    }
                    // Afficher la liste des produits dans une bulle du chat
                    divReponse.innerHTML = `
                      <div class="messages__item messages__item--assistant">
                        <p>Voici la liste des produits :</p>
                        ${produitsListe}
                        <button class="boutonRetour">Retour</button>
                      </div>
                    `;

                    var boutonRetour =
                      divReponse.querySelector(".boutonRetour");

                    boutonRetour.addEventListener("click", function () {
                      // Code pour revenir à l'interface avec les boutons "Commandes", "Panier" et "Déconnexion"
                      divReponse.innerHTML = `
                        <div class="messages__item messages__item--assistant">
                          <p>Bienvenue dans votre compte !</p>
                          <button class="boutonCommande">Commande</button>
                          <button class="boutonPanier">Panier</button>
                          <button class="boutonDeconnexion">Déconnexion</button>
                        </div>
                      `;

                      boutonCommande =
                        divReponse.querySelector(".boutonCommande");
                      boutonPanier = divReponse.querySelector(".boutonPanier");
                      boutonDeconnexion =
                        divReponse.querySelector(".boutonDeconnexion");

                      boutonCommande.addEventListener("click", function () {
                        // Code pour afficher la liste des produits
                      });

                      boutonPanier.addEventListener("click", function () {
                        // Code pour afficher le panier
                      });

                      boutonDeconnexion.addEventListener("click", function () {
                        // Code pour effectuer la déconnexion
                      });
                    });
                  },
                });
              });

              boutonDeconnexion.addEventListener("click", function () {
                console.log("deconnexion");
                // Envoyer une requête AJAX pour déconnecter l'utilisateur
                $.ajax({
                  url: "/chatbot/php/actionsChatbot/deconnexion.php",
                  type: "POST",
                  success: function (response) {
                    // Afficher un message de déconnexion
                    divReponse.innerHTML = `
                      <div class="messages__item messages__item--assistant">
                        <p>Vous avez été déconnecté.</p>
                      </div>
                    `;
                  },
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
          },
        });
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
      /////////////////////////Inscription Utilisateur///////////////////////////////////////////////
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
        // Empêche le comportement par défaut du formulaire
        event.preventDefault();

        // Récupère les valeurs des champs de formulaire
        var email = document.getElementById("emailInscription").value;
        var motDePasse = document.getElementById("motDePasseInscription").value;
        var motDePasseConfirmation = document.getElementById(
          "motDePasseConfirmation"
        ).value;

        // Vérifie si les mots de passe correspondent
        if (motDePasse === motDePasseConfirmation) {
          // Si les mots de passe correspondent, l'utilisateur peut continuer sont inscription
          console.log("ok les mots de passe sont identique.");
        } else {
          // Les mots de passe ne correspondent pas, j'affiche un message d'erreur
          console.log("Les mots de passe ne correspondent pas.");
          // Afficher un message d'erreur si la connexion échoue
          var nouvelleBulle = document.createElement("div");
          nouvelleBulle.classList.add("messages__item", "messages__item--bot");
          nouvelleBulle.innerHTML = `
            <form class="chatbot-form">
              <h2 class="title">Inscription</h2>
              <label for="email">E-mail :</label>
              <input type="text" placeholder="Adresse email" id="emailInscription" value="${email}" />
              <br>
              <label for="password">Mot de passe :</label>
              <input type="password" placeholder="Mot de passe" id="motDePasseInscription" />
              <br>
              <label for="passwordConfirmation">Confirmation du mot de passe :</label>
              <input type="password" placeholder="Mot de passe" id="motDePasseConfirmation" />
              <br>
              <button type="submit" class="boutonInscription">S'inscrire</button>
            </form>
            <br>
            <p class="message-erreur">Les mots de passe ne correspondent pas. Veuillez réessayer l'inscription</p>
          `;

          // Remplace la bulle de réponse précédente par la nouvelle bulle
          divReponse.parentNode.replaceChild(nouvelleBulle, divReponse);

          // Récupère le nouveau bouton d'inscription
          boutonInscription = nouvelleBulle.querySelector(".boutonInscription");

          // Ajoute à nouveau l'événement de clic au nouveau bouton d'inscription
          boutonInscription.addEventListener("click", function (event) {
            event.preventDefault();

            // Récupère les nouvelles valeurs des champs de formulaire
            email = document.getElementById("emailInscription").value;
            motDePasse = document.getElementById("motDePasseInscription").value;
            motDePasseConfirmation = document.getElementById(
              "motDePasseConfirmation"
            ).value;

            // Vérifie à nouveau si les mots de passe correspondent
            if (motDePasse === motDePasseConfirmation) {
              console.log("Les mots de passe sont identiques.");
            } else {
              console.log("Les mots de passe ne correspondent pas.");
              // Vous pouvez continuer à afficher une nouvelle bulle d'erreur ou effectuer une autre action appropriée
            }
          });
        }
      });

      // Envoie les données au fichier PHP via AJAX
      $.ajax({
        url: "/chatbot/php/actionsChatbot/actionConnexionAdminUtilisateurs.php",
        type: "POST",
        //dataType: 'json',
        data: JSON.stringify({
          email: emailInscription,
          motDePasse: motDePasse,
        }),
        processData: false,
        success: function (response) {
          response = response.trim();
          // Code à exécuter lorsque la réponse du fichier PHP est reçue
          console.log("response", '"' + response + '"');
          console.log("response", response == "inscription_reussie");
          if (response == "inscription_reussie") {
            console.log(divReponse);
            divReponse.classList.add(
              "messages__item",
              "messages__item--visitor"
            );
            divReponse.innerHTML = `
            <div class="messages__item messages__item--assistant">
              <p>Bienvenue dans votre compte !</p>
              <button class="boutonCommande">Commande</button>
              <button class="boutonPanier">Panier</button>
              <button class="boutonDeconnexion">Déconnexion</button>
            </div>
          `;
          }
        },
      });
    } else {
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      //Connexion à la base de données pour récupérer la réponse associée au message de l'utilisateur/
      ////////////////////////////////////////////////////////////////////////////////////////////////
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
            console.log(response.question);
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
      });
    }

    // Ajout de la div de réponse comme enfant de l'élément HTML avec l'identifiant "msg"
    msg.appendChild(divReponse);

    // Effacement du champ de texte
    champTexte.value = "";
  }
}

// Fin de discussion chatbot & utilisateur
