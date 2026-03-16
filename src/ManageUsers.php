<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sistema de Control de Accesos</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="Favico" href="https://www.parqueexplora.org/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">
	
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"
	        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	        crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <script type="text/javascript" src="js/select2.min.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script defer src="js/manage_users.js"></script>
	<script>
	  	$(window).on("load resize ", function() {
		    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
		    $('.tbl-header').css({'padding-right':scrollWidth});
		}).resize();
	</script>
	<script>
	  $(document).ready(function(){
	  	  $.ajax({
	        url: "manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    setInterval(function(){
	      $.ajax({
	        url: "manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    },5000);
	  });
	</script>
</head>
<body>
<?php include'header.php';?>
<main>
	<h1 class="slideInDown animated">Agregar, Actualizar o Eliminar Usuarios, Información y Permisos</h1>
	<div class="form-style-5 slideInDown animated">
		<form enctype="multipart/form-data">
			<div class="alert_user"></div>
			<fieldset>
				<legend><span class="number">1</span> Información del Usuario</legend>
				<input type="hidden" name="user_id" id="user_id">
				<input type="text" name="name" id="name" placeholder="Nombre del Usuario">
				<input type="text" name="number" id="number" placeholder="Numero Serial de Tarjeta">
				<input type="email" name="email" id="email" placeholder="Correo Electrónico del Usuario">
			</fieldset>
			<fieldset>
			<legend><span class="number">2</span> Información Adicional y Permisos</legend>
			<label>
				<label for="Device"><b>Accesos del Usuario:</b></label>
                    <select multiple class="dev_sel" name="dev_sel[]" id="dev_sel" style="color: #000; width: 100%">
                      <?php
                        require'connectDB.php';
                        $sql = "SELECT * FROM devices ORDER BY device_name ASC";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo '<p class="error">SQL Error</p>';
                        } 
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            while ($row = mysqli_fetch_assoc($resultl)){
                      ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['device_dep']; ?></option>
                      <?php
                            }
                        }
                      ?>
                    </select>
				<input type="radio" name="gender" class="gender" value="Female">Mujer
	          	<input type="radio" name="gender" class="gender" value="Male" checked="checked">Hombre
	      	</label >
			</fieldset>
			<button type="button" name="user_add" class="user_add">Agregar Usuario</button>
			<button type="button" name="user_upd" class="user_upd">Actualizar Usuario</button>
			<button type="button" name="user_rmo" class="user_rmo">Eliminar Usuario</button>
		</form>
	</div>

	<!--User table-->
	<div class="section">
		
		<div class="slideInRight animated">
			<div id="manage_users"></div>
		</div>
	</div>
</main>
<?php include 'footer.php'; ?>
</body>
</html>