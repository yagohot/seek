<?php
    require __DIR__ . '/db_connection.php';
    $db = get_db_connection_or_die();
    session_start();
    if(!isset($_SESSION['user_id'])){
        echo '<p>No estás logueado</p>';
    }else{
        #hay que revisarla
        $sql = "SELECT * FROM tFilm INNER JOIN tMyList ON tFilm.id = tMyList.idfilm";
        $resultado = mysqli_query($db,$sql);
        $resultados = mysqli_num_rows($resultado);

        if($count_results>0){
            echo '<p>Hay' .$count_results.' resultados';
    
            while($row_searched = mysqli_fetch_array($resultado)){
                echo '<p>'.$row_searched['nombre'].'</p>';
                echo '<p>'.$row_searched['genero'].'</p>';
                echo '<p>'.$row_searched['año'].'</p>';
            }
        }else{
            echo '<p>No hay resultados</p>';
    }
    }
?>