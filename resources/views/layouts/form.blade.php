<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  

  <title>Sistema de Agendamiento de Citas Medicas</title>
  <!-- General CSS Files -->
  {{-- <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css"> --}}
  @vite(['resources/assets/css/app.min.css',
         'resources/assets/bundles/bootstrap-social/bootstrap-social.css',
         'resources/assets/css/style.css',
         'resources/assets/css/components.css',
         //'resources/assets/css/custom.css'
         ])
         
  <link rel='shortcut icon' type='image/x-icon' href='/favicon-template.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    
    @yield('content')
    
  </div>

  @vite([//'resources/assets/js/app.min.js',
         'resources/assets/js/scripts.js',
         'resources/assets/js/custom.js'])

  <!-- General JS Scripts -->
  {{-- <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>