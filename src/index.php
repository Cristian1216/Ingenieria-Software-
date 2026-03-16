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

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Users.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css"> 
    <script>
      $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();
    </script>
</head>
<body>
<?php include'header.php'; ?> 
<main>
<section>
<h1 class="slideInDown animated" style="font-family: 'Roboto', sans-serif;">Base de Datos de Todos los Usuarios</h1></br>
  <!--User table-->
  <div class="table-responsive slideInRight animated" style="max-height: 400px;"> 
    <table class="table">
      <thead class="table-primary">
        <tr>
          <th>ID | Nombre</th>
          <th>Numero de Serial</th>
          <th>Genero</th>
          <th>UID de Tarjeta</th>
          <th>Fecha de Asignación de Permisos</th>
          <th>Permisos Asignados</th>
        </tr>
      </thead>
      <tbody class="table-secondary">
        <?php
          //Connect to database
          require'connectDB.php';
          $departments = [];
            $sql = "SELECT * FROM users WHERE add_card=1 ORDER BY id DESC";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo '<p class="error">SQL Error</p>';
            }
            else{
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
              if (mysqli_num_rows($resultl) > 0){
                  while ($row = mysqli_fetch_assoc($resultl)){
                    $userId = $row['id'];
                    $sqlUserDevices = "SELECT * FROM user_devices WHERE id_user = ?";
                    $resultUserDevices = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($resultUserDevices, $sqlUserDevices);
                    mysqli_stmt_bind_param($resultUserDevices, 'i', $userId);
                    mysqli_stmt_execute($resultUserDevices);
                    $userDevices = mysqli_stmt_get_result($resultUserDevices);
                    $userDevicesResults = [];
                    while($userDevice = mysqli_fetch_assoc($userDevices)) {
                      $userDeviceTemp = $userDevice;
                      if (isset($departments[$userDevice['id_device']])) {
                        $userDeviceTemp['departamento'] = $departments[$userDevice['id_device']];
                      } else {
                        $sqlDpts = "SELECT * FROM devices WHERE id = ?";
                        $resultDpts = mysqli_stmt_init($conn);
                        if (mysqli_stmt_prepare($resultDpts, $sqlDpts)) {
                          mysqli_stmt_bind_param($resultDpts, 'i', $userDevice['id_device']);
                          mysqli_stmt_execute($resultDpts);
                          $dptResult = mysqli_stmt_get_result($resultDpts);
                          if ($dpt = mysqli_fetch_assoc($dptResult)) {
                            $departments[$userDevice['id_device']] = $dpt;
                            $userDeviceTemp['departamento'] = $dpt;
                          }
                        }
                      }
                      $userDevicesResults[] = $userDeviceTemp;
                    }
                    $departamentos = array_map(fn($userDevice) => $userDevice['departamento']['device_dep'], $userDevicesResults);
          ?>
                      <TR>
                      <TD><?php echo $row['id']; echo" | "; echo $row['username'];?></TD>
                      <TD><?php echo $row['serialnumber'];?></TD>
                      <TD><?php echo $row['gender'];?></TD>
                      <TD><?php echo $row['card_uid'];?></TD>
                      <TD><?php echo $row['user_date'];?></TD>
                      <TD><?php echo implode(', ', $departamentos);?></TD>
                      </TR>
        <?php
                }   
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>