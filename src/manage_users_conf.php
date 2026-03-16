<?php  
//Connect to database
require'connectDB.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//Add user
if (isset($_POST['Add'])) {
     
    $user_id = $_POST['user_id'];
    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    $Email = $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $Gender = $_POST['gender'];
    // print_r($dev_uid);
    
    //check if there any selected user
    $sql = "SELECT add_card FROM users WHERE id=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_bind_param($result, "i", $user_id);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['add_card'] == 0) {

                if (!empty($Uname) && !empty($Number) && !empty($Email) && count($dev_uid??[]) > 0) {
                    //check if there any user had already the Serial Number
                    $sql = "SELECT serialnumber FROM users WHERE serialnumber=? AND id NOT like ?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "di", $Number, $user_id);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {

                            $sql="UPDATE users SET username=?, serialnumber=?, gender=?, email=?, user_date=CURDATE(), add_card=1 WHERE id=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_select_Fingerprint";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "sdssi", $Uname, $Number, $Gender, $Email, $user_id );
                                mysqli_stmt_execute($result);
                                foreach($dev_uid as $idDevice) {
                                    $sqlNuevoDevice = "INSERT INTO user_devices (id_user, id_device) VALUES (? ,?)";
                                    $resultNuevoDevice = mysqli_stmt_init($conn);
                                    if (mysqli_stmt_prepare($resultNuevoDevice, $sqlNuevoDevice)) {
                                        mysqli_stmt_bind_param($resultNuevoDevice, "ii", $user_id, $idDevice);
                                        mysqli_stmt_execute($resultNuevoDevice);
                                    }
                                }
                                echo 1;
                                exit();
                            }
                        }
                        else {
                            echo "El número de serie ya está tomado";
                            exit();
                        }
                    }
                }
                else{
                    echo "Campos vacíos";
                    exit();
                }
            }
            else{
                echo "Este usuario ya existe";
                exit();
            }    
        }
        else {
            echo "No hay una tarjeta seleccionada";
            exit();
        }
    }
}
// Update an existance user 
if (isset($_POST['Update'])) {

    $user_id = $_POST['user_id'];
    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    $Email = $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $Gender = $_POST['gender'];

    //check if there any selected user
    $sql = "SELECT add_card FROM users WHERE id=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_bind_param($result, "i", $user_id);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['add_card'] == 0) {
                echo "First, You need to add the User!";
                exit();
            }
            else{
                if (empty($Uname) && empty($Number) && empty($Email) && count($dev_uid??[]) == 0) {
                    echo "Empty Fields";
                    exit();
                }
                else{
                    //check if there any user had already the Serial Number
                    $sql = "SELECT serialnumber FROM users WHERE serialnumber=? AND id NOT like ?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "di", $Number, $user_id);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            if (!empty($Uname) && !empty($Email)) {
                                $sql="UPDATE users SET username=?, serialnumber=?, gender=?, email=? WHERE id=?";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_select_Card";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sdssi", $Uname, $Number, $Gender, $Email, $user_id );
                                    mysqli_stmt_execute($result);
                                    $sqlDeleteDevices = "DELETE FROM user_devices WHERE id_user = ?";
                                    $resultDelete = mysqli_stmt_init($conn);
                                    if (mysqli_stmt_prepare($resultDelete, $sqlDeleteDevices)) {
                                        mysqli_stmt_bind_param($resultDelete, "i", $user_id);
                                        mysqli_stmt_execute($resultDelete);
                                    }
                                    foreach($dev_uid as $idDevice) {
                                        $sqlNuevoDevice = "INSERT INTO user_devices (id_user, id_device) VALUES (? ,?)";
                                        $resultNuevoDevice = mysqli_stmt_init($conn);
                                        if (mysqli_stmt_prepare($resultNuevoDevice, $sqlNuevoDevice)) {
                                            mysqli_stmt_bind_param($resultNuevoDevice, "ii", $user_id, $idDevice);
                                            mysqli_stmt_execute($resultNuevoDevice);
                                        }
                                    }
                                    echo 1;
                                    exit();
                                }
                            }
                        }
                        else {
                            echo "¡El número de serial ya está tomado";
                            exit();
                        }
                    }
                }
            }    
        }
        else {
            echo "No hay ningún usuario seleccionado para ser actualizado";
            exit();
        }
    }
}
// select fingerprint 
if (isset($_GET['select'])) {

    $card_uid = $_GET['card_uid'];

    $sql = "SELECT * FROM users WHERE card_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $card_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        // echo "User Fingerprint selected";
        // exit();
        header('Content-Type: application/json');
        $data = array();
        if ($row = mysqli_fetch_assoc($resultl)) {
            foreach ($resultl as $row) {
                $userId = $row['id'];
                    $sqlUserDevices = "SELECT * FROM user_devices WHERE id_user = ?";
                    $resultUserDevices = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($resultUserDevices, $sqlUserDevices);
                    mysqli_stmt_bind_param($resultUserDevices, 'i', $userId);
                    mysqli_stmt_execute($resultUserDevices);
                    $userDevices = mysqli_stmt_get_result($resultUserDevices);
                    $userDevicesResults = [];
                    while($userDevice = mysqli_fetch_assoc($userDevices)) {
                      $userDevicesResults[] = $userDevice;
                    }
                    $row['departamentos'] = $userDevicesResults;
                $data[] = $row;
            }

        }
        $resultl->close();
        $conn->close();
        print json_encode($data);
    } 
}
// delete user 
if (isset($_POST['delete'])) {

    $user_id = $_POST['user_id'];

    if (empty($user_id)) {
        echo "There no selected user to remove";
        exit();
    } else {
        $sql = "DELETE FROM users WHERE id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_delete";
            exit();
        }
        else{
            $sqlDeleteDevices = "DELETE FROM user_devices WHERE id_user = ?";
            $resultDelete = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($resultDelete, $sqlDeleteDevices)) {
                mysqli_stmt_bind_param($resultDelete, "i", $user_id);
                mysqli_stmt_execute($resultDelete);
            }
            mysqli_stmt_bind_param($result, "i", $user_id);
            mysqli_stmt_execute($result);
            echo 1;
            exit();
        }
    }
}
?>