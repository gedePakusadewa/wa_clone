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
        
    </style>
  </head>
  <body>
    <div>
    <h3>Register User</h3>
    <form action="{{route('save_registration')}}" method="POST">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" />
        <input type="text" placeholder="Name" id="name" name="name" required autofocus />
        <input type="text" placeholder="Email" id="email_address" name="email" required autofocus />
        <input type="password" placeholder="Password" id="password" name="password" required />
        <button type="submit" >Sign up</button>
    </form>
    <a href = "{{route('login')}}">LOGIN</a>
    </div>
  </body>
</html>