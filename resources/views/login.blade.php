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
      <form action = "{{route('home_page')}}" method = "post" >
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" />
        <input type = "number" name = "userId" autocomplete = "off" />
      </form>
    </div>
  </body>
</html>