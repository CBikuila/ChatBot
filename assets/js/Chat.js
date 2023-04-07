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
  Chatbox_support.style.display = 'none';
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



// Réponse chatbot aléatoires //

// Liste des réponses aléatoires //
var reponsesAleatoires = [
  "Je ne comprends pas ce que vous voulez dire.",
  "Pouvez-vous reformuler votre demande s'il vous plaît?",
  "Je suis désolé, je ne peux pas répondre à cela.",
  "N'hésitez pas à nous contactez par téléphone.",
  "Je suis un chatbot, mais je suis ravi de discuter avec vous!"
];

// Fonction pour générer une réponse aléatoire //
function genererReponseAleatoire() {
  var index = Math.floor(Math.random() * reponsesAleatoires.length);
  return reponsesAleatoires[index];
}

// Fin de réponse chatbot aléatoires  //


// Fonction pour envoyer le message // 
function envoyerMessage() {
  // Récupération du texte dans le champ de texte.
  var recupererMessage = document.getElementById('envoyer').value;
    console.log(recupererMessage);

  // Vérification que le champ de texte n'est pas vide.
  if (recupererMessage.trim() !== '') {
    // Envoi du message
    // Code pour envoyer le message...
    console.log("Le message "+ recupererMessage + "a été envoyé !");
    
        var div = document.createElement("div"); //crée un élément HTML <div> vide et le stocke dans la variable div
        div.textContent = document.getElementById('envoyer').value; // Cette ligne récupère la valeur du champ de formulaire HTML avec l'identifiant "envoyer" et l'assigne à la propriété textContent de la variable div. Cela permet d'afficher le contenu du champ texte dans la nouvelle div créé.        var msg = document.getElementById('msg');// Cette ligne récupère un élément HTML avec l'identifiant "msg" et le stocke dans la variable msg.
        
        console.log(msg);
        
        div.classList.add('messages__item', 'messages__item--operator'); // Ajouter une classe CSS afin d'avoir la bulle bleu 
        msg.appendChild(div); //IL ajoute la div créée à l'étape 1 en tant qu'enfant de l'élément HTML msg. Cela insère la div à l'intérieur de l'élément msg dans le document HTML.
        // On affiche le message de l'utlisateur // 


        // On affiche une réponse aléatoire du chatbot//
        // Ajout d'une réponse aléatoire
        var divReponse = document.createElement("div"); //ajoute d'une réponse aléatoire générée en tant que div avec la classe messages__item messages__item--visitor.
        divReponse.textContent = genererReponseAleatoire();
        divReponse.classList.add('messages__item', 'messages__item--visitor');
        msg.appendChild(divReponse);
         
    // Effacement du champ de texte
    champTexte.value = '';
  }
}



  
