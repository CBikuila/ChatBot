// Fonction pour envoyer la requête AJAX
function envoyerReponseConnexionUtilisateur() {
    // Récupérer les valeurs de l'email et du mot de passe
    var email = document.getElementById("email").value;
    var motDePasse = document.getElementById("motDePasse").value;
  
    // Créer un objet FormData pour envoyer les données au serveur
    var formData = new FormData();
    formData.append("email", email);
    formData.append("motDePasse", motDePasse);
  
    // Créer une requête AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "C:\MAMP\htdocs\chatbot\php\actionsChatbot\actionConnexionAdminUtilisateurs.php", true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
  
        // Vérifier la réponse du serveur
        if (response.erreur) {
          // Afficher le message d'erreur dans le chatbot
          afficherMessage("Email ou mot de passe faux");
        } else {
          // Afficher le message de succès dans le chatbot
          afficherMessage("Connexion réussie");
        }
      } else {
        // Afficher un message d'erreur en cas de problème avec la requête
        afficherMessage("Une erreur s'est produite lors de la requête.");
      }
    };
    xhr.send(formData);
  }
  
  // Fonction pour afficher un message dans le chatbot
  function afficherMessage(message) {
    // Créer un élément de paragraphe
    var paragraphe = document.createElement("p");
    paragraphe.textContent = message;
  
    // Ajouter le paragraphe à la div du chatbot (ou tout autre élément cible)
    var chatbotDiv = document.getElementById("chatbot");
    chatbotDiv.appendChild(paragraphe);
  }
  
  // Exemple d'utilisation : déclencher la requête AJAX lorsque l'utilisateur clique sur un bouton
  var boutonConnexion = document.getElementById("boutonConnexion");
  boutonConnexion.addEventListener("click", envoyerRequete);
  