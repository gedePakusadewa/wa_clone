<!DOCTYPE html>
<html>
  <head>
    <title>WhatsApp</title>
    <meta charset = "utf-8" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
    <style>
      *{
          box-sizing: border-box;
          padding:0;
          margin:0;
          width:100%;
        }
        
        .flex-row{
            display:flex;
            flex-direction:row;
        }

        .flex-column{
            display:flex;
            flex-direction:column;
        }

        .friend-section{
            width:27%;
            height:618px;
            border:1px solid black;
        }

        .chat-section{
            width:73%;
            height:618px;
            border:1px solid green;
            background-color:#f8f9fb;
        }

        .border{
            border:1px solid green;
        }

        .center-black-home{
            position:relative;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            text-align:center;
            width:400px;
        }

    </style>
  </head>
  <body>
    <div class = "flex-row">
      <div class = "friend-section">
        <div class = "flex-column">
          <div class = "border" >
            <div style = "width:59px; padding:5px;">
              <img style = "border-radius: 50%;" src = "/photo-profile/kapou-profile.jpg" width = "100px" />
              <div id = "account-{{$dataAccount->id}}" class = "account-section">{{$dataAccount->username}}
              </div>
            </div>
          </div>
          <div>
            <form action = "">
              <input type = "search" name = "keywords" placeholder = "search or start a new conversation" autocomplete = "false"/>
            </form>
          </div>
          <div style = "height:500px; overflow:auto;">
            @foreach($friendList as $data)  
              <div id = "user-{{$data->id}}" class = "flex-row" style = "padding:6px; border-bottom:1px solid black; height:70px;">
                <div style = "width:65px; padding:5px;">
                  <img id = "user-{{$data->id}}-img" style = "border-radius: 50%;" src = "/photo-profile/kapou-profile.jpg" width = "100px" />
                </div>
                <div class = "flex-column">
                  <div id = "user-{{$data->id}}-username">{{$data->username}}
                  </div>
                  <div id = "user-{{$data->id}}-message">this feature on progress
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div id = "blank_home" class = "chat-section" style = "display:none" >
        <div class = "center-black-home">
          <img style = "width:300px;" src = "/icon/blank_wa.jpg" alt = "blank logo" height = "300px"/>
          <h1>Keep your phone connected</h1>
          <p>WhatsApp connects to your phone to sync messages. To reduce data usage, connect your phone to Wi-Fi.</p>
        </div>
      </div>

      <div id = "message-block">
      </div>

    </div>
  </body>
  <script src = "https://code.jquery.com/jquery-2.2.4.min.js"
		  integrity = "sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		  crossorigin = "anonymous">
  </script>
  <script>
    "use strict";

    // window.addEventListener("load", function(){
    //   tes112();
    // });
    // $(document).ready(function(){

    // });

    function getDataFromServer(friendID, accountID){
      $.ajax({
        url: '/tes123',
        type: 'get',
        data: { 
          friend_id : '' + friendID,
          account_id: '' + accountID
        },

        success:function(dataServer){
          //console.log(dataServer);
          //alert('success!');
          setNewData(dataServer, accountID);
        },
        error: function(){alert('error');}, 
      });  
    }

    function setMessageBlock($dataMessage){
      
    }

    function getIdFromDataID(dta = ""){
      return dta.substr(5, 1);
    }

    function setNewData(dta, thisUserId){
      let chatData = JSON.parse(dta);
      //console.log(typeof(chatData[0].sender_id));
      let lengthChatData = chatData.length;
      let y = 0;
      let dataInView = "";
      for(y = lengthChatData - 1; y >= 0; y--){
        if(chatData[y].sender_id === parseInt(thisUserId)){
          dataInView += '<div style = "text-align:right; background-color:red;">' + chatData[y].memo + '</div>';
        }else{
          dataInView += '<div style = "text-align:left; background-color:green;">' + chatData[y].memo + '</div>';
        }
      }

      document.getElementById('message-block').innerHTML = dataInView;
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
            getDataFromServer(getIdFromDataID(target.getAttribute('id')), getAccountID());
          }else{
            console.log('false');
          }
        }
      });
    });
    
  </script>
</html>