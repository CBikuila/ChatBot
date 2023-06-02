class InteractiveChatbox {
    constructor(a, b, c) {
        this.args = {
            button: a,
            chatbox: b
        }
        this.icons = c;
        this.state = false; 
    }
    // Définit une méthode display() qui récupère les propriétés button et chatbox de this.args (l'objet qui contient les arguments passés au constructeur), 
    //puis ajoute un écouteur d'événements au clic du bouton qui appelle la méthode toggleState() avec la boîte de chat passée en paramètre.
    display() {
        const {button, chatbox} = this.args;
        
        button.addEventListener('click', () => this.toggleState(chatbox))
    }
    //Définit une méthode toggleState() qui inverse la valeur de this.state (qui est initialisée à false dans le constructeur) 
    // et appelle la méthode showOrHideChatBox() avec la boîte de chat et le bouton passés en paramètre.
    toggleState(chatbox) {
        this.state = !this.state;
        this.showOrHideChatBox(chatbox, this.args.button);
    }

    //Définit une méthode showOrHideChatBox() qui ajoute ou supprime la classe 'chatbox--active' de la boîte de chat en fonction de la valeur de this.state, 
    //et appelle la méthode toggleIcon() avec l'état et le bouton passés en paramètre.
    showOrHideChatBox(chatbox, button) {
        if(this.state) {
            chatbox.classList.add('chatbox--active')
            this.toggleIcon(true, button);
        } else if (!this.state) {
            chatbox.classList.remove('chatbox--active')
            this.toggleIcon(false, button);
        }
    }

    //Définit une méthode toggleIcon() qui change le contenu de la première enfant du bouton en fonction de l'état et des icônes passés en paramètre. 
    //La propriété isClicked est utilisée lorsque state est true et isNotClicked est utilisée lorsque state est false.
    toggleIcon(state, button) {
        const { isClicked, isNotClicked } = this.icons;
        let b = button.children[0].innerHTML;

        if(state) {
            button.children[0].innerHTML = isClicked; 
        } else if(!state) {
            button.children[0].innerHTML = isNotClicked;
        }
    }
}

// Récupération du bouton et de la chatbox
const button = document.querySelector('.button');

// Ajout d'un écouteur d'événement sur le bouton
button.addEventListener('click', () => {
  // Fermeture de la chatbox en masquant l'élément
  //Chatbox_support.style.display = 'none';

});


// Ecrire un message puis le valider en cliquant sur l'image ou sur valider en cliquant sur entrée du clavier //

// Récupération de l'image et du champ de text
const image = document.querySelector('#send-message');
const champTexte = document.querySelector('#envoyer');
// Ajout d'un écouteur d'événements au clic de l'image
image.addEventListener('click', envoyerMessage);

// Ajout d'un écouteur d'événements à la touche Entrée dans le champ de texte
champTexte.addEventListener('keydown', function(e) {
  if (e.keyCode === 13) {
    envoyerMessage();
  }
});

// disscution chatbot & utulisateur //


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


    //Connexion Administrateur//
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
          <input type="text" placeholder="Adresse email" />
          <br>
          <label for="password">Mot de passe :</label>
          <input type="password" placeholder="Mot de passe" />
          <br>
          <button type="submit" class="bouton" > Se Connecter</button>
        </form>
      `;
    }  else if (recupererMessage.toLowerCase() === 'inscription') {
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
          <button type="submit" class="bouton">S'inscrire</button>
        </form>
      `;
    } else {
    // fin de connexion administrateur//
      // Connexion à la base de données pour récupérer la réponse associée au message de l'utilisateur
      $.ajax({
        url: './php/messageBddChatbot.php',
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


  
