require('./bootstrap');

"use strict";

document.getElementById('blank_home').style.display = '';

function showChatSection(){
    document.getElementById('chat_section').style.display = '';
    document.getElementById('blank_home').style.display = 'none';
}

function getDataFromServer(friendID, accountID){
    $.ajax({
    url: '/get-client-data',
    type: 'get',
    data: { 
        friend_id : '' + friendID,
        account_id: '' + accountID
    },

    success:function(dataServer){
        //console.log(dataServer);
        setNewData(dataServer, accountID, friendID);
    },
    error: function(){alert('error');}, 
    });  
}

function getIdFromDataID(dta = ""){
    return dta.substr(5, 1);
}

function setNewData(dta, thisUserId, thisUserFriendId){
    let chatData = JSON.parse(dta);
    let lengthChatData = chatData.length;
    let y = 0;
    let dataInView = "";
    for(y = lengthChatData - 1; y >= 0; y--){
        if(chatData[y].sender_id === parseInt(thisUserId)){
            dataInView += '<div style = "text-align:right; padding:20px;"><span style = "background-color:#dcf8c6; padding:5px; border-radius:5px; margin:5px;">' + chatData[y].memo + '</span></div>';
        }else{
            dataInView += '<div style = "text-align:left; padding:20px;"><span style = "background-color:#ffffff; padding:5px; border-radius:5px; margin:5px;">' + chatData[y].memo + '</span></div>';
        }
    }

    document.getElementById('message-block').innerHTML = dataInView;
    document.getElementById('formChat').setAttribute('name', thisUserFriendId);
    //console.log(lengthChatData);
}

function getAccountID(){
    //console.log(document.getElementsByClassName('account-section')[0].getAttribute('id').substr(8, 1));
    return document.getElementsByClassName('account-section')[0].getAttribute('id').substr(8, 1);
}

window.addEventListener("load", function(){
    document.body.addEventListener('click', function(e){
        let target = e.target;
        //alert(e.currentTarget.getAttribute('id'));
        //console.log(e.target.getAttribute('id'));
        //e.stopPropagation();
        if(target.getAttribute('id') !== null){
            if(target.getAttribute('id').includes('user-')){
            //console.log(typeof(target.getAttribute('id')));
            //tes112(getIdFromDataID(target.getAttribute('id')));
            //console.log(getIdFromDataID(target.getAttribute('id')));
            //getAccountID();
            showChatSection();
            getDataFromServer(getIdFromDataID(target.getAttribute('id')), getAccountID());
            }else{
            console.log('false');
            }
        }
    });

    document.getElementById('formChat').addEventListener('submit', function(e){
        e.preventDefault();
        let friend_id = document.getElementById('formChat').getAttribute('name');
        let chatData = document.forms['formChat']['chatText'].value;
        sentChatAndGetNewDataFromServer(friend_id, getAccountID(), chatData);
        //console.log(friend_id);
        document.forms['formChat']['chatText'].value = "";

        const options = {
			method: 'post',
			url: '/notif-to-client',
			data: {
				// username: username_input.value,
				// message: message_input.value,
				targetId: friend_id
			}
		}

		axios(options);
        //console.log(friend_id);
    });

    //nilai id harus interger
    //pastikan melakukan config: cache ; config: clear ; route: cache ; route: clear ; optimize
	window.Echo.private('notificat.' + getAccountID()).listen('.notif', (e) => {
		//messages_el.innerHTML += '<div><strong>' + e.username + ':</strong>' + e.message + '</div>';
		//console.log(e);
	}); 

    // window.Echo.private('notificat.4').listen('.notif', (e) => {
	// 	messages_el.innerHTML += '<div><strong>' + e.username + ':</strong>' + e.message + '</div>';
	// 	//console.log(e);
	// }); 


});

function sentChatAndGetNewDataFromServer(friendID, accountID, chatText){
    $.ajax({
    url: '/send-and-get-new-data',
    type: 'get',
    data: { 
        friend_id : friendID,
        account_id: accountID, 
        chatData: chatText
    },

    success:function(newData){
        //console.log(newData);
        setNewData(newData, accountID, friendID);
    },
    error: function(){alert('error');}, 
    });  
}