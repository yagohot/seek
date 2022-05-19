<?php
require __DIR__ .'/db_connection.php';
$db = get_db_connection_or_die();

$usuario=$_POST['usuario'];
$email=$_POST['email'];
$contrasena=$_POST['contrasena'];
$contrasena2=$_POST['contrasena2'];

if($contrasena!=$contrasena2){
    die("contraseña distinta");
}

$sentencia = "SELECT * FROM tUsers WHERE nombre=".$usuario.'';
$stmt = $db->prepare($sentencia);
$stmt->bind_param("s",$usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if($result->num_rows==1){
    die ('usuario duplicado');
}
else{
    $sentencia2= "SELECT * FROM tUsers WHERE email=".$email.'';
    $stmt = $db->prepare($sentencia2);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($result->num_rows==1){
        die ('email duplicado');
    }
}

try{
    $registro = "INSERT INTO tUsers (nombre,email,password) VALUES (?,?,?)";
    $stmt=$db->prepare($registro);
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $stmt->bind_param("sss",$usuario,$email,$contrasena);
    $stmt->execute();
    $stmt->close();
}catch(Exception $e){
    error_log($e);
}

mysqli_close();
?>