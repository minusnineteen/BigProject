const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const sentbtn = form.querySelector('.send-btn');
const chatBox = document.querySelector('.chat-content');
const incoming_id = form.querySelector('.incoming_id').value;

form.onsubmit = (e) => {
    e.preventDefault();
}
inputField.focus();
inputField.onkeyup = () =>{
    if(inputField.value != ""){
        sentbtn.classList.add("active");
    }
    else{
        sentbtn.classList.remove("active");
    }
}
sentbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'insert-chat.php', true);
    xhr.onload = () => {
        if((xhr.readyState === XMLHttpRequest.DONE) && (xhr.status === 200)){
            inputField.value = "";
            scrollToBottom();
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

setInterval(() => {
	let xhr = new XMLHttpRequest();
	xhr.open("POST", 'get_chat.php', true);
	xhr.onload = () => {
		if((xhr.readyState === XMLHttpRequest.DONE) && (xhr.status === 200)){
			chatBox.innerHTML = xhr.response;
			if(!chatBox.classList.contains('active')){
				scrollToBottom();
			}
		}
	}
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send('incoming_id='+incoming_id);
}, 500)
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
