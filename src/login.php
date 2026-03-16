<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Control de Accesos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="Favico" href="https://www.parqueexplora.org/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css"> 
    <script src="js/jquery-2.2.3.min.js"></script>
    <script>
      $(window).on("load resize ", function() {
          var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
          $('.tbl-header').css({'padding-right':scrollWidth});
      }).resize();
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.message', function(){
          $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
          $('h1').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
      });
    </script>
</head>
<body>
<?php include'header.php'; ?> 
<main>
<h1 class="slideInDown animated" style="font-family: 'Roboto', sans-serif;">Sistema de Control de Accesos - Parque Explora</h1>
<h1 class="slideInDown animated" style="font-family: 'Roboto', sans-serif;">Inicie sesión con la dirección de correo electrónico y la contraseña de administrador</h1>
<h1 class="slideInDown animated" id="reset" style="font-family: 'Roboto', sans-serif;">Sistema de Control de Accesos - Parque Explora</h1>
<h1 class="slideInDown animated" id="reset" style="font-family: 'Roboto', sans-serif;">Introduzca su dirección de correo electrónico para enviarle el enlace de restablecimiento de contraseña.</h1>
<!-- Log In -->
<section>
  <div class="slideInDown animated">
    <div class="login-page">
      <div class="form">
        <?php  
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "invalidEmail") {
                echo '<div class="alert alert-danger">
                        Este correo es inválido
                      </div>';
            }
            elseif ($_GET['error'] == "sqlerror") {
                echo '<div class="alert alert-danger">
                        There a database error!!
                      </div>';
            }
            elseif ($_GET['error'] == "wrongpassword") {
                echo '<div class="alert alert-danger">
                        Contraseña Incorrecta
                      </div>';
            }
            elseif ($_GET['error'] == "nouser") {
                echo '<div class="alert alert-danger">
                        El correo electronico no existe
                      </div>';
            }
          }
          if (isset($_GET['reset'])) {
            if ($_GET['reset'] == "success") {
                echo '<div class="alert alert-success">
                        Revisa tu correo electronico
                      </div>';
            }
          }
          if (isset($_GET['account'])) {
            if ($_GET['account'] == "activated") {
                echo '<div class="alert alert-success">
                        Por favor ingresa
                      </div>';
            }
          }
          if (isset($_GET['active'])) {
            if ($_GET['active'] == "success") {
                echo '<div class="alert alert-success">
                        El link de activación ha sido enviado
                      </div>';
            }
          }
        ?>
        <div class="alert1"></div>
        <form class="reset-form" action="reset_pass.php" method="post" enctype="multipart/form-data">
          <input type="email" name="email" placeholder="Correo Electronico" required/>
          <button type="submit" name="reset_pass">RESTABLECER</button>
          <p class="message"><a href="#">Ingresar</a></p>
        </form>
        <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">
          <input type="email" name="email" id="email" placeholder="Correo Electronico" required/>
          <input type="password" name="pwd" id="pwd" placeholder="Contraseña" required/>
          <button type="submit" name="login" id="login">Ingresar</button>
          <p class="message">¿Ha olvidado su contraseña? 
        </br>
        <a href="#">Restablecer contraseña</a></p>
        </form>
      </div>
    </div>
  </div>
</section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>