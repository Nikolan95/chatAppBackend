// const { default: axios } = require('axios');

// require('./bootstrap');


// const message_el = document.getElementById("rightChatId");
// const userId_input = document.getElementById("user_id");
// const conversationId_input = document.getElementById("conversation_id");
// const message_input = document.getElementById("body");
// const message_form = document.getElementById("sendMessage");

// message_form.addEventListener('submit', function(e){
//     e.preventDefault();

//     let has_errors = false;

//     if(userId_input.value == ''){
//         has_errors = true;
//     }
//     if(conversationId_input.value == ''){
//         has_errors = true;
//     }
//     if(message_input.value == ''){
//         has_errors = true;
//     }
//     if(has_errors){
//         return;
//     }
//     const options = {
//         method: 'post',
//         url: '/sendMessage',
//         data: {
//             user_id: userId_input.value,
//             conversation_id: conversationId_input.value,
//             body: message_input.value,
//             read: false
//         },
//     }
//     console.log(options);
//     axios(options);

// });
// window.Echo.channel('chat')
//     .listen('.message', (e) =>{
//         console.log(e);
// });