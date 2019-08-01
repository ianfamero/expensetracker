<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title></title>
</head>
  <body>
    <div id="app">
      <user-login></user-login>
    </div>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>