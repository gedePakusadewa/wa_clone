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
          <div class = "border" >photo profil
          </div>
          <div>
            <form action = "">
              <input type = "search" name = "keywords" placeholder = "search or start a new conversation" autocomplete = "false"/>
            </form>
          </div>
          <div style = "height:500px; overflow:auto;">
          @for($i = 0; $i < 100; $i++)
            <div>
              <h2>Marginal semi rata</h2>
            </div>
          @endfor
          </div>
        </div>
      </div>
      <div class = "chat-section">
        <div id = "blank_home" class = "center-black-home">
          <img style = "width:300px;" src = "/icon/blank_wa.jpg" alt = "blank logo" height = "300px"/>
          <h1>Keep your phone connected</h1>
          <p>WhatsApp connects to your phone to sync messages. To reduce data usage, connect your phone to Wi-Fi.</p>
        </div>
      </div>
    </div>
  </body>
</html>