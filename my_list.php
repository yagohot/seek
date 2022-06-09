<?php
    require __DIR__ . '/db_connection.php';
    $db = get_db_connection_or_die();
    session_start();
    if(!isset($_SESSION['user_id'])){
        echo '<p>No estás logueado</p>';
		echo '<a href="/main.php">Volver</a>';
    }else{
        #hay que revisarla
        $sql = "SELECT * FROM tFilms INNER JOIN tMylist ON tFilms.id = tMylist.film_id WHERE tMylist.user_id = '".$_SESSION['user_id']."'";
        $resultado = mysqli_query($db,$sql);
        $resultados = mysqli_num_rows($resultado);

        if($resultados>0){
            echo '<p>Hay ' .$resultados.' resultados';
    
            while($row_searched = mysqli_fetch_array($resultado)){
                echo '<p>'.$row_searched['nombre'].'</p>';
                echo '<p>'.$row_searched['genero'].'</p>';
                echo '<p>'.$row_searched['año'].'</p>';
            }
			echo '<a href="/main.php">Volver</a>';
        }else{
            echo '<p>No hay resultados</p>';
			echo '<a href="/main.php">Volver</a>';
    }
    }
?>