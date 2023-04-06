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

// Récupération de l'image et du champ de texte
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

// Fonction pour envoyer le message
function envoyerMessage() {
  // Récupération du texte dans le champ de texte
  var recupererMessage = document.getElementById('envoyer').value;
    console.log(recupererMessage);
  //const message = champTexte.value;//

  // Vérification que le champ de texte n'est pas vide
  if (recupererMessage.trim() !== '') {
    // Envoi du message
    // Code pour envoyer le message...
    console.log("Le message "+ recupererMessage + "a été envoyé !");

    // Effacement du champ de texte
    champTexte.value = '';
  }
}