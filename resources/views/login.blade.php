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
      <form action = "{{route('validate_login')}}" method = "post" >
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" />
        <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
          autofocus />
        <input type="password" placeholder="Password" id="password" class="form-control" name="password" required />
        <button type="submit" class="btn btn-dark btn-block">Signin</button>
      </form>
      <a href = "{{route('register')}}">REGISTER</a>
    </div>
  </body>
</html>