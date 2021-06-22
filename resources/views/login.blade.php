<!DOCTYPE html>
<html>
  <head>
    <title>WhatsApp Log In</title>
    <meta charset = "utf-8" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
    <style>
      *{
        box-sizing: border-box;
        padding:0;
        margin:0;
      }

      .login-modal{
        position:absolute;
        top:105px;
        background-color:#ffffff;
        height:400px;
        width:1000px;
        left: 50%;
        transform: translate(-50%, 0);
        border-radius:5px;
        border:1px solid white;
      }

      .login-bkg-top{
        background-color:#00bfa5;
        height:200px;
        padding: 3% 10%;
        display:flex;
        flex-direction:row;
      }

      .login-bkg-btom{
        background-color:#d3dbda;
        height:450px;
      }

      .login-lgo-dsc{
        color:white;
        margin-top:10px;
        margin-left:5px;
      }

      .login-mdl-contnr{
        display:flex;
        flex-direction:row;
      }

      .login-guide-text{
        padding-top:40px;
        padding-left:24px;
        padding-right:34px;
        width:60%;
      }

      .login-header-1{
        font-size:28px;
        font-weight:bold;
        padding-bottom:20px;
      }

      .login-p{
        padding-bottom:20px;
      }

      .login-form-contr{
        width:40%;
        margin-top:40px;
        padding:0px 50px;
        border-left:1px solid #d3dbda;
      }

      .login-input-bar{
        padding:7px;
        width:250px;
        border-radius:3px;
        border:1px solid #d3dbda;
        margin-bottom:20px;
        width:100%;
      }

      a.sign-up-link:link, a.sign-up-link:visited, a.sign-up-link:hover, a.sign-up-link:active {
			  color: #006658;
			  text-decoration: none;
			  display: inline-block;
			}

    </style>
  </head>
  <body>
    <div class="login-bkg-top">
      <div>
        <img src="icon/whatsapp-logo-v2.png" alt="whatsapp-logo" width="39" />
      </div>
      <div class="login-lgo-dsc">
        WHATSAPP WEB
      </div>
    </div>
    <div class="login-bkg-btom">
    </div>
    <div id="modal-log-in" class="login-modal" >
      <div class="login-mdl-contnr">
        <div class="login-guide-text">
            <p class="login-header-1">To Use Whatsapp On Your Computer:</p>
            <p class="login-p">1. Log In with your registered e-mail and password.</p>
            <p class="login-p">2. If you dont have registered e-mail and password, please register in <a class="sign-up-link" href ="{{route('register')}}">sign up</a>.</p>
        </div>
        <div class="login-form-contr">
          <p style="text-align:center; font-size:20px; padding-bottom:20px;">Log In</p>
          <form action = "{{route('validate_login')}}" method = "post" >
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" />
            <input type="text" placeholder="Email" id="email" class="login-input-bar" name="email" required
              autofocus/><br />
            <input type="password" placeholder="Password" id="password" class="login-input-bar" name="password" required /><br />
            <button type="submit" style="font-size:17px; background-color:#00bfa5; color:white; border:1px solid white; border-radius:3px; padding:5px; width:100%; margin-bottom:20px;">Log In</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>