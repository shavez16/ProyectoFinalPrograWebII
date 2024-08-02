<?php
require '../includes/config/database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $db = conectarDB();


    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password); 
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        header("Location: ../index.html"); 
        exit();
    } else {
        echo "Error al registrar el usuario.";
    }

    $db->close();
}
?>