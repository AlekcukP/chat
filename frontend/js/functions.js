window.addEventListener('DOMContentLoaded', ()=>{
    const sendBtn = document.getElementById('btn_send'),
        inputForm = document.getElementById('input_message'),
        messagesBlock = document.getElementById('log'),
        messageTemplate = document.getElementById('message_template');
    
    //sendBtn.addEventListener('click', onSendBtnSubmit);
    
    function onSendBtnSubmit(){
        messagesBlock.insertAdjacentHTML('beforeend', createMessage(inputForm.value));
        inputForm.value = '';
    }
    
    function createMessage(text){
        let message = messageTemplate.innerHTML.replace('{{text}}', text);
    
        return message;
    }
})
