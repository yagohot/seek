<?php
    require __DIR__ . '/db_connection.php';
    $db = get_db_connection_or_die();

    $film_id = $_POST['film_id'];
    $user_id = $_SESSION['user_id'];

    try{
        $sql = "INSERT INTO tMyList (idfilm,iduser) VALUES (?,?)";
        $stmt=$db->prepare($sql);
        $stmt->bind_param("ii",$film_id,$user_id);
        $stmt->execute();
        echo '<p>Película añadida a tu lista</p>';
        echo '<a href="main.php"></a>';
    }catch(Exception $e){
        error_log($e);
    }

    mysqli_close($db);
?>