<?php
   require __DIR__. '/db_connection.php';
   $db = get_db_connection_or_die();

   $usuario = $_POST['usuario'];
   $contrasena = $_POST['password'];

   $sql = "SELECT * FROM tUsers WHERE nombre = ".$usuario.'';

   $resultado =mysqli_query($db,$sql);

   if(mysqli_num_rows($resultado)==0){
       echo ('El usuario no existe');
   }else{
       $only_row = mysqli_fetch_array($resultado);
       if(password_verify($contrasena,$only_row[3])){
           session_start();
           $_SESSION['user_id'] = $only_row[0];
           header('Location: main.php');
       }
   }