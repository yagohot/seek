<?php
   require __DIR__. '/db_connection.php';
   $db = get_db_connection_or_die();

   $usuario = $_POST['usuario'];
   $pwd = $_POST['pwd'];

   $sql = "SELECT * FROM tUsers WHERE nombre = '".$usuario."'";

   $resultado =mysqli_query($db,$sql);

   if(mysqli_num_rows($resultado)==0){
       echo ('El usuario no existe');
   }else{
       $only_row = mysqli_fetch_assoc($resultado);
       if(password_verify($pwd,$only_row['password'])){
           session_start();
           $_SESSION['user_id'] = $only_row['id'];
           header('Location: main.php');
       } else {
		   echo 'La contraseña introducida no es correcta';
		   echo '</br><a href="./login.php">Login</a>';
	   }
   }
?>