<div class="table-responsive-sm" style="width: 100%;"> 
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>UID de Tarjeta</th>
        <th>Nombre</th>
        <th>Genero</th>
        <th>Numero de Serial</th>
        <th>Fecha de Detección</th>
        <th>Permisos Asignados</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
    <?php
      //Connect to database
      require'connectDB.php';
        $departments = [];
        $sql = "SELECT * FROM users ORDER BY id DESC";
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
                // $sqlDpts = "SELECT * FROM devices WHERE id = ? ORDER BY id DESC";
      ?>
                  <TR>
                  	<TD><?php  
                    		if ($row['card_select'] == 1) {
                    			echo "<span><i class='glyphicon glyphicon-ok' title='The selected UID'></i></span>";
                    		}
                        $card_uid = $row['card_uid'];
                    	?>
                    	<form>
                    		<button type="button" class="select_btn" id="<?php echo $card_uid;?>" title="select this UID"><?php echo $card_uid;?></button>
                    	</form>
                    </TD>
                  <TD><?php echo $row['username'];?></TD>
                  <TD><?php echo $row['gender'];?></TD>
                  <TD><?php echo $row['serialnumber'];?></TD>
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