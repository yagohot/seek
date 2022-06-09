
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo '<a href="./login.php">Login</a></br>';
    echo '<a href="./register.php">Register</a>';
  }else{
      echo '<p>Estás logueado</p>';
  }
?>
 <form method="post" action="main.php">
 <label>Texto de búsqueda</label>
 <input id="searched_text" name="searched_text" type="text"/>

 <input type="submit" name="buscar" value="buscar"/>
</form>
<?php
if(isset($_POST['searched_text'])){
    $buscar = $_POST['searched_text'];
    require __DIR__ .'/db_connection.php';
    $db = get_db_connection_or_die();
    $sql = "SELECT * FROM tFilms WHERE nombre LIKE '%".$buscar."%'";
    $resultado = mysqli_query($db,$sql);
    $count_results = mysqli_num_rows($resultado);

    if($count_results>0){
        echo '<p>Hay' .$count_results.' resultados';

        while($row_searched = mysqli_fetch_array($resultado)){
            echo '<p>'.$row_searched['nombre'].'</p>';
            echo '<p>'.$row_searched['genero'].'</p>';
            echo '<p>'.$row_searched['año'].'</p>';
            echo '<form method="post" action="/do_add_to_list.php">';
            echo '<input type="hidden" name="film_id" value='.$row_searched['id'].'/>';
			if(isset($_SESSION['user_id'])){
				echo '<input type="submit" name="agregar" value="agregar"/>';
			}
            echo '</form>';
        }
    }else{
        echo '<p>No hay resultados</p>';
}
}
?>
    <a href="/my_list.php">Lista</a>
<?php
if(isset($_SESSION['user_id'])){
	echo '</br><a href="/do_logout.php">Cerrar sesión</a>';
}
?>
</body>
</html>