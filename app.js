const chatButton = document.querySelector('.chatbox__button'); //Elle sélectionne un élément HTML avec la classe CSS "chatbox__button" et le stocke dans la variable chatButton.
const chatContent = document.querySelector('.chatbox__support'); //Elle sélectionne un élément HTML avec la classe CSS "chatbox__support" et le stocke dans la variable chatContent.
const icons = { //La ligne crée un objet icons qui contient deux propriétés : isClicked et isNotClicked, chacune étant une chaîne de caractères HTML qui représente une icône d'une bulle de discussion.
    isClicked: '<img src="./images/icons/bulledark.png" />',
    isNotClicked: '<img src="./images/icons/bulledark.png" />'
}
//La ligne crée une nouvelle instance de la classe InteractiveChatbox, qui prend en paramètre l'élément HTML chatButton, l'élément HTML chatContent et l'objet icons.
const chatbox = new InteractiveChatbox(chatButton, chatContent, icons);
chatbox.display();//La ligne appelle la méthode display() de l'instance de la classe InteractiveChatbox, qui affiche la boîte de dialogue de discussion à l'utilisateur
chatbox.toggleIcon(false, chatButton); //La ligne appelle la méthode toggleIcon() de l'instance de la classe InteractiveChatbox, qui permet de changer l'icône de la bulle de discussion en fonction de son état actuel. 
                                       //Le premier paramètre, false, indique que l'icône n'est pas encore cliquée, et le deuxième paramètre chatButton indique sur quel élément HTML doit être appliquée la modification de l'icône.