const chatButton = document.querySelector('.chatbox__button');
const chatContent = document.querySelector('.chatbox__fenetre');
const icons = {
    isClicked: '<img src="./images/icons/bulledark.png" />',
    isNotClicked: '<img src="./images/icons/bulledark.png" />'
}
const chatbox = new InteractiveChatbox(chatButton, chatContent, icons);
chatbox.display();
chatbox.toggleIcon(false, chatButton);