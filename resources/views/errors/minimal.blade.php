<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield('title')</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
   <style>
      body {
          font-family: 'Nunito', sans-serif;
      }
  </style>
</head>
<body style="text-align: center;padding-top:5%">
   <div>
      @yield('image')
   </div>
   <h2>@yield('message')</h2>
</body>
</html>

