const { entries } = require('lodash');

require('./bootstrap');

"use strict";

/* set main chat section blank when user dont click any
chat friend */
document.getElementById('blank_home').style.display = '';

function showChatSection(){
    document.getElementById('chat_section').style.display = '';
    document.getElementById('blank_home').style.display = 'none';
}

/* get data chat from specific user(accountID) dan his/her specific friend(friendID) based 
on their id. Then set new data for chat section. */
function getDataFromServer(friendID, accountID){
    $.ajax({
        url: '/get-chat-data-from-friend-id',
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

//get id from id element in html object
function getIdFromDataID(dta = ""){
    return dta.substr(5, 1);
}

/* set new data or change the entire data conversation in currently 
open chat section. Delete notification number in friend section.*/
function setNewData(dta, thisUserId, thisUserFriendId){
    let chatData = dta;
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
    deleteNewNotificationSideBar(document.getElementById('formChat').getAttribute('name'));
}

//get owner ID of currently account/user chat
function getAccountID(){
    return document.getElementsByClassName('account-section')[0].getAttribute('id').substr(8, 1);
}

//invoke some necessary function if page done loading
window.addEventListener("load", function(){
    /* when user click ne of his/her friend section
    then this function hide black display and generate
    new chat section based on user ID and friend ID */
    document.body.addEventListener('click', function(e){
        let target = e.target;
        if(target.getAttribute('id') !== null){
            if(target.getAttribute('id').includes('user-')){
                showChatSection();
                getDataFromServer(getIdFromDataID(target.getAttribute('id')), getAccountID()); 
            }else{
                console.log('Something Wrong When Displaying User Chat');
            }
        }
    });

   /*  when user send something to currently open chat section friend
    this function sent new data chat to server and refresh currently chat section
    page whenever user click enter. This function also send data to server using
    axios (and i am still reserch why i do this) */
    document.getElementById('formChat').addEventListener('submit', function(e){
        e.preventDefault();
        let friend_id = document.getElementById('formChat').getAttribute('name');
        let chatData = document.forms['formChat']['chatText'].value;
        sendNewDataChatAndGetLastestChatData(friend_id, getAccountID(), chatData);
        //console.log(friend_id);
        document.forms['formChat']['chatText'].value = "";

        const options = {
			method: 'post',
			url: '/set-and-send-new-notification',
			data: {
				targetId: friend_id,
                senderId: getAccountID()
			}
		}

		axios(options);
    });

    //nilai id harus interger
    //pastikan melakukan config: cache ; config: clear ; route: cache ; route: clear ; optimize
    /* to listening channel from server continuously when page done loading. Its listen using
    user ID to help server distinguish who is listening and do they can listen or not
    This function also refresh chat section when user already on chat section not in blank page */
	window.Echo.private('notificat.' + getAccountID()).listen('.notif', (e) => {
		//console.log(e);
        notification(e.senderUser, e.targetUser);
        let friend_id = document.getElementById('formChat').getAttribute('name');
        if(friend_id !== ""){
            getDataFromServer(friend_id, getAccountID());
        }
	}); 
});

//send and receive the latest data conversation from server
function sendNewDataChatAndGetLastestChatData(friendID, accountID, chatText){
    $.ajax({
    url: '/save-and-get-latest-data',
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

/* some function to display, and delete notification
whenever user get new message, these function will
make new notification number (1), and if user is in
one of his/her friend chat section that these function
will display notification inside chat section */
function notification(senderId, targetId){
  if(document.getElementById('formChat').getAttribute('name') === senderId.toString()){
    setNewNotificationMain(senderId);
    setTimeout(deleteNewNotificationMainBar, 3000);
  }else{
    setNewNotificationSideBar(senderId);
  }
}

function setNewNotificationSideBar(senderId){
  document.getElementById('user-' + senderId + '-notif-section').innerHTML = "1";
}

function setNewNotificationMain(senderId){
  document.getElementById('inner-notification').style.display = "";
}

function deleteNewNotificationSideBar(senderId){
  document.getElementById('user-' + senderId + '-notif-section').innerHTML = "";
}

function deleteNewNotificationMainBar(){
    document.getElementById('inner-notification').style.display = "none";
}