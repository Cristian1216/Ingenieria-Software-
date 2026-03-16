<?php  
//Connect to database
require 'connectDB.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');
$d = date("Y-m-d");
$t = date("H:i:s");
if (isset($_GET['card_uid']) && isset($_GET['device_token'])) {
    
    $card_uid = $_GET['card_uid'];
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM devices WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            $device_mode = $row['device_mode'];
            $device_dep = $row['device_dep'];
            $idDevice = $row['id'];
            if ($device_mode == 1) {
                $sql = "SELECT * FROM users WHERE card_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $card_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)){
                        // ROW ES == USER
                        //*****************************************************
                        //An existed Card has been detected for Login or Logout
                        if ($row['add_card'] == 1){
                            // GET DEVICES UIDS AVAILABLE
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
                                $sqlDpts = "SELECT * FROM devices WHERE id = ?";
                                $resultDpts = mysqli_stmt_init($conn);
                                if (mysqli_stmt_prepare($resultDpts, $sqlDpts)) {
                                    mysqli_stmt_bind_param($resultDpts, 'i', $userDevice['id_device']);
                                    mysqli_stmt_execute($resultDpts);
                                    $dptResult = mysqli_stmt_get_result($resultDpts);
                                    if ($dpt = mysqli_fetch_assoc($dptResult)) {
                                      $userDeviceTemp['departamento'] = $dpt;
                                    }
                                }
                                $userDevicesResults[] = $userDeviceTemp;
                            }
                            $devicesUid = array_map(fn($userDevice) => $userDevice['departamento']['device_uid'], $userDevicesResults);
                            if (in_array($device_uid, $devicesUid)){
                                $Uname = $row['username'];
                                $Number = $row['serialnumber'];
                                // NO REQUERIDO PORQUE YA SOLO HABRÁ LOGS IN
                                // $sql = "SELECT * FROM users_logs WHERE card_uid=? AND checkindate=? AND card_out=0";
                                // $result = mysqli_stmt_init($conn);
                                // if (!mysqli_stmt_prepare($result, $sql)) {
                                //     echo "SQL_Error_Select_logs";
                                //     exit();
                                // }
                                // else{
                                    // mysqli_stmt_bind_param($result, "ss", $card_uid, $d);
                                    // mysqli_stmt_execute($result);
                                    // $resultl = mysqli_stmt_get_result($result);
                                    //*****************************************************
                                    //Login
                                    // if (!$row = mysqli_fetch_assoc($resultl)){

                                        $sql = "INSERT INTO users_logs (username, serialnumber, card_uid, device_uid, device_dep, checkindate, timein) VALUES (? ,?, ?, ?, ?, ?, ?)";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_Select_login1";
                                            exit();
                                        }
                                        else{
                                            mysqli_stmt_bind_param($result, "sdsssss", $Uname, $Number, $card_uid, $device_uid, $device_dep, $d, $t);
                                            mysqli_stmt_execute($result);
                                            echo .$Uname;
                                            exit();
                                        }
                                    // }
                                    //*****************************************************
                                    //Logout
                                    // else{
                                    //     $sql="UPDATE users_logs SET timeout=?, card_out=1 WHERE card_uid=? AND checkindate=? AND card_out=0";
                                    //     $result = mysqli_stmt_init($conn);
                                    //     if (!mysqli_stmt_prepare($result, $sql)) {
                                    //         echo "SQL_Error_insert_logout1";
                                    //         exit();
                                    //     }
                                    //     else{
                                    //         mysqli_stmt_bind_param($result, "sss", $t, $card_uid, $d);
                                    //         mysqli_stmt_execute($result);

                                    //         echo "logout".$Uname;
                                    //         exit();
                                    //     }
                                    // }
                                // }
                            }
                            else {
                                echo "Acceso Denegado";
                                exit();
                            }
                        }
                        else if ($row['add_card'] == 0){
                            echo "Tarjeta no Registrada";
                            exit();
                        }
                    }
                    else{
                        echo "Not found!";
                        exit();
                    }
                }
            }
            else if ($device_mode == 0) {
                //New Card has been added
                $sql = "SELECT * FROM users WHERE card_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $card_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //The Card is available
                    if ($row = mysqli_fetch_assoc($resultl)){
                        $sql = "SELECT card_select FROM users WHERE card_select=1";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            
                            if ($row = mysqli_fetch_assoc($resultl)) {
                                $sql="UPDATE users SET card_select=0";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_execute($result);

                                    $sql="UPDATE users SET card_select=1 WHERE card_uid=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_insert_An_available_card";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "s", $card_uid);
                                        mysqli_stmt_execute($result);

                                        echo "Disponible";
                                        exit();
                                    }
                                }
                            }
                            else{
                                $sql="UPDATE users SET card_select=1 WHERE card_uid=?";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert_An_available_card";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "s", $card_uid);
                                    mysqli_stmt_execute($result);

                                    echo "available";
                                    exit();
                                }
                            }
                        }
                    }
                    //The Card is new
                    else{
                        $sql="UPDATE users SET card_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $sql = "INSERT INTO users (card_uid, card_select, user_date) VALUES (?, 1, CURDATE())";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_Select_add";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "s", $card_uid );
                                mysqli_stmt_execute($result);
                                $newUserId = mysqli_insert_id($conn);
                                $sqlNuevoDevice = "INSERT INTO user_devices (id_user, id_device) VALUES (? ,?)";
                                $resultNuevoDevice = mysqli_stmt_init($conn);
                                if (mysqli_stmt_prepare($resultNuevoDevice, $sqlNuevoDevice)) {
                                    mysqli_stmt_bind_param($resultNuevoDevice, "ii", $newUserId, $idDevice);
                                    mysqli_stmt_execute($resultNuevoDevice);
                                }
                                echo "Enviada Servidor";
                                exit();
                            }
                        }
                    }
                }    
            }
        }
        else{
            echo "Invalid Device!";
            exit();
        }
    }          
}
?>