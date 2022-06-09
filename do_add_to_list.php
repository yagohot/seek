<?php
    require __DIR__ . '/db_connection.php';
    $db = get_db_connection_or_die();
	session_start();

    $film_id = $_POST['film_id'];

    try{
        $sql = "INSERT INTO tMylist (film_id,user_id) VALUES (?,?)";
        $stmt=$db->prepare($sql);
        $stmt->bind_param("ii",$film_id,$_SESSION['user_id']);
        $stmt->execute();
        echo '<p>Película añadida a tu lista</p>';
        echo '<a href="/main.php">Volver</a>';
    }catch(Exception $e){
        error_log($e);
    }

    mysqli_close($db);
?>