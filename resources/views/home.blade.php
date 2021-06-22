<!DOCTYPE html>
<html>
  <head>
    <title>WhatsApp</title>
    <meta charset = "utf-8" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
            width:34%;
            height:618px;
            //border:1px solid black;
        }

        .chat-section{
            width:66%;
            height:618px;
            border-left:1px solid #e4e5e6;
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

        .tes12s{
          display:flex; 
          justify-content:flex-end;
        }

        .icon-form-chat{
          width:5%; 
          padding:10px;
        }

        .icon-form-chat-spec{
          font-size:20px;
          color:#919191
        }

    </style>
  </head>
  <body>
    <div class = "flex-row">
      <div class = "friend-section">
        <div class = "flex-column">
          <div style = "background-color:#ededed;">
            <div style = "width:59px; padding:5px; ">
              <img style = "border-radius: 50%;" src = "{{$dataAccount->path_img_profile}}" width = "100px" />
              <div id = "account-{{$dataAccount->id}}" class = "account-section">{{$dataAccount->name}}
              </div>
              <div><a href = "{{route('log_out')}}">SIGN OUT</a>
              </div>
            </div>
          </div>
          <div style = "background-color:#f6f6f6; padding:10px;">
            <form>
              <input type = "search" name = "keywords" placeholder = "search or start a new conversation" autocomplete = "false" style = "font-size:15px; padding:5px;"/>
            </form>
          </div>
          <div style = "height:500px; overflow:auto;">
            @foreach($friendList as $data)  
              <div id = "user-{{$data->id}}" class = "flex-row" style = "padding:6px; border-bottom:1px solid #f2f2f2; height:70px;">
                <div style = "width:65px; padding:5px;">
                  <img id = "user-{{$data->id}}-img" style = "border-radius: 50%;" src = "{{$data->path_img_profile}}" width = "100px" />
                </div>
                <div class = "flex-column">
                  <div id = "user-{{$data->id}}-username">{{$data->name}}
                  </div>
                  <div id = "user-{{$data->id}}-message" style = "font-weight:bold;">this feature on progress
                  </div>
                </div>
                <div id = "user-{{$data->id}}-notif-section">
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

      <div id = "chat_section" class = "flex-column" style = "display:none; height:600px; overflow:auto;  background-image:url('bg-img/default.jpg')" >
        <div id = "inner-notification" style  = "position:absolute; background-color:red; display:none;">
          New Message
        </div>
        <div id = "message-block" style = "margin-bottom:40px;">
        </div>
        <div style = "width:1090px; padding:10px; background-color:#f0f0f0; position:fixed; bottom:0;" class = "flex-row">
          <div class = "icon-form-chat" ><i class='far fa-smile icon-form-chat-spec' ></i></div>
          <div class = "icon-form-chat" ><i class='fas fa-paperclip icon-form-chat-spec'></i></div>
          <div >
            <form id = "formChat" name = "">
              <input type = "text" autocomplete="off" name = "chatText" placeholder = "Type a message" style = "font-size: 15px; width:100%; height:35px;"/>
            </form>
          </div>
          <div class = "icon-form-chat" ><i class='fas fa-microphone icon-form-chat-spec' ></i></div>
        </div>
      </div>

    </div>
  </body>
  <script src = "https://code.jquery.com/jquery-2.2.4.min.js"
		  integrity = "sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		  crossorigin = "anonymous">
  </script>
  <script src = "./js/app.js">
  </script>
</html>