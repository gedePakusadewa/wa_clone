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
            </div>
          </div>
          <div>
            <form action = "">
              <input type = "search" name = "keywords" placeholder = "search or start a new conversation" autocomplete = "false"/>
            </form>
          </div>
          <div style = "height:500px; overflow:auto;">
            @for($i = 0; $i < 7; $i++)  
              <div id = "user-{{$i}}" class = "flex-row" style = "padding:6px; border-bottom:1px solid black; height:70px;">
                <div style = "width:65px; padding:5px;">
                  <img id = "user-{{$i}}-img" style = "border-radius: 50%;" src = "/photo-profile/kapou-profile.jpg" width = "100px" />
                </div>
                <div class = "flex-column">
                  <div id = "user-{{$i}}-username">Mokfij nsj {{$i}}
                  </div>
                  <div id = "user-{{$i}}-message">hajsk cnksic mdkicml ksockdm sjick..
                  </div>
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>
      <div class = "chat-section" style = "display:none;">
        <div id = "blank_home" class = "center-black-home">
          <img style = "width:300px;" src = "/icon/blank_wa.jpg" alt = "blank logo" height = "300px"/>
          <h1>Keep your phone connected</h1>
          <p>WhatsApp connects to your phone to sync messages. To reduce data usage, connect your phone to Wi-Fi.</p>
        </div>
      </div>

      <div id = "tes212">
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

    function tes112(dta){
      $.ajax({
        url: '/tes123',
        type: 'get',
        data: { 
          code : '' + dta
        },

        success:function(dataServer){
          //console.log(dataServer);
          //alert('success!');
          setNewData(dataServer);
        },
        error: function(){alert('error');}, 
      });  
    }

    function getIdFromDataID(dta = ""){
      return dta.substr(5, 1);
    }

    function setNewData(dta){
      document.getElementById('tes212').innerHTML = dta;
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
            tes112(getIdFromDataID(target.getAttribute('id')));
            //console.log(getIdFromDataID(target.getAttribute('id')));
          }else{
            console.log('false');
          }
        }
      });
    });
    
  </script>
</html>