 ////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////Discution chatbot & utilisateurs//////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


// Fonction pour envoyer le message + disscussion entre le chatbot et l'utilisateur 

function envoyerMessage() {
  // Récupération du texte dans le champ de texte.
  var recupererMessage = document.getElementById('envoyer').value;
  console.log(recupererMessage);

  // Vérification que le champ de texte n'est pas vide.
  if (recupererMessage.trim() !== '') {
    // Envoi du message
    // Code pour envoyer le message...
    console.log("Le message " + recupererMessage + " a été envoyé !");

    // Création d'un élément HTML <div> pour afficher le message de l'utilisateur
    var div = document.createElement("div");
    div.textContent = document.getElementById('envoyer').value;
    var msg = document.getElementById('msg');

    // Ajout des classes CSS pour afficher le message de l'utilisateur sous forme de bulle bleue
    div.classList.add('messages__item', 'messages__item--operator');

    // Ajout de la div comme enfant de l'élément HTML avec l'identifiant "msg"
    msg.appendChild(div);


  ////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////Connexion Utilisateur///////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////



// Création d'un élément HTML <div> pour afficher la réponse du chatbot
var divReponse = document.createElement("div");

// Vérification du mot-clé "admin"
if (recupererMessage.toLowerCase() === 'connexion') {
  // Réponse spécifique pour le mot-clé "admin"
  divReponse.classList.add('messages__item', 'messages__item--visitor');
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
  var boutonConnexion = divReponse.querySelector('.boutonConnexion');
  boutonConnexion.addEventListener('click', function(event) {
    // Empêche le comportement par défaut du formulaire
    event.preventDefault(); 

    // Récupère les valeurs des champs de formulaire
    var email = document.getElementById('email').value;
    var motDePasse = document.getElementById('motDePasse').value;
console.log('ici');
    // Envoie les données au fichier PHP via AJAX
    $.ajax({
      url: '/chatbot/php/actionsChatbot/actionConnexionAdminUtilisateurs.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify({
        email: email,
        motDePasse: motDePasse
      }),
      success: function(response) {
        // Code à exécuter lorsque la réponse du fichier PHP est reçue
        console.log("response", response);
        if (response === 'connexion_reussie') {
          divReponse.innerHTML = `
            <div class="messages__item messages__item--assistant">
              <p>Bienvenue dans votre compte !</p>
              <button class="boutonCommande">Commande</button>
              <button class="boutonPanier">Panier</button>
              <button class="boutonDeconnexion">Déconnexion</button>
            </div>
          `;
          // Gérer les clics sur les boutons
          var boutonCommande = divReponse.querySelector('.boutonCommande');
          var boutonPanier = divReponse.querySelector('.boutonPanier');
          var boutonDeconnexion = divReponse.querySelector('.boutonDeconnexion');

          boutonDeconnexion.addEventListener('click', function() {
            // Envoyer une requête AJAX pour déconnecter l'utilisateur
            $.ajax({
              url: '/chatbot/php/actionsChatbot/deconnexion.php',
              type: 'POST',
              success: function(response) {
                // Afficher un message de déconnexion
                divReponse.innerHTML = `
                  <div class="messages__item messages__item--assistant">
                    <p>Vous avez été déconnecté.</p>
                  </div>
                `;
              }
            });
          });
        }
      }
    });
  });


  ////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////Connexion Admin///////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////


} else if (recupererMessage.toLowerCase() === 'admin') {
  // Réponse spécifique pour le mot-clé "admin"
  divReponse.classList.add('messages__item', 'messages__item--visitor');
  divReponse.innerHTML = `
    <div class="dashboard"><a href="/chatbot/php/connexion.php">Connexion au dashboard.</a></div>
  `;


  ////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////Inscription Utilisateur///////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////

} else if (recupererMessage.toLowerCase() === 'inscription') {
  // Réponse spécifique pour le mot-clé "inscription"
  divReponse.classList.add('messages__item', 'messages__item--visitor');
  divReponse.innerHTML = `
    <form class="chatbot-form">
      <h2 class="title">Inscription</h2>
      <label for="email">E-mail :</label>
      <input type="text" placeholder="Adresse email" />
      <br>
      <label for="password">Mot de passe :</label>
      <input type="password" placeholder="Mot de passe" />
      <br>
      <label for="password">Confirmation du mot de passe :</label>
      <input type="password" placeholder="Mot de passe" />
      <br>
      <button type="submit" class="boutonInscription">S'inscrire</button>
    </form>
  `;
} else {


  ////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////
  //Connexion à la base de données pour récupérer la réponse associée au message de l'utilisateur/
  ////////////////////////////////////////////////////////////////////////////////////////////////
  $.ajax({
    url: '/chatbot/php/actionsChatbot/messageBddChatbot.php',
    type: 'POST',
    dataType: 'json',
    data: JSON.stringify({ "motscles": recupererMessage }),
    processData: false,
    success: function(response) {
      if (response.question !== '') {
        // Si une réponse est trouvée dans la base de données
        var phraseAssociee = response.question;
        divReponse.classList.add('messages__item', 'messages__item--visitor');
        console.log(response.question);
        divReponse.textContent = phraseAssociee;
      } else {
        // Si aucun résultat n'est trouvé dans la base de données, afficher une réponse aléatoire
        var reponsesAleatoires = ["Désolé, je ne comprends pas.", "Je ne peux pas répondre à cette question.", "Pouvez-vous reformuler votre question ?"];
        var reponseAleatoire = reponsesAleatoires[Math.floor(Math.random() * reponsesAleatoires.length)];
        divReponse.classList.add('messages__item', 'messages__item--visitor');
        divReponse.textContent = reponseAleatoire;
      }
    }
  });
}

// Ajout de la div de réponse comme enfant de l'élément HTML avec l'identifiant "msg"
msg.appendChild(divReponse);

// Effacement du champ de texte
champTexte.value = '';
  }
}

// Fin de discussion chatbot & utilisateur


  
