<?php
session_start(); 
require '../includes/config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $email = $_POST['email']; 
    $password = $_POST['password'];


    $db = conectarDB();

    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header("Location: ../admin/index.php");
        exit();
    } else {
        $error = "Email o contraseña incorrectos";
    }

    $db->close(); 
}
?>

<!-- global $errors;
    if (empty($username)) {
        array_push($errors, "Usuario es Requerido");
    }
    if (empty($password)) {
        array_push($errors, "Contraseña es Requerida");
    }
    
    $errors=[];
    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = ("SELECT * FROM users 
WHERE (username='$username' OR email='$username') AND password='$password'
LIMIT 1");
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin') {

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "Usted se ha conectado";
                header('location: ../admin/index.php');       
            }else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "Usted se ha conectado";

                header('location: ../index.html');
            }
        }else {
            array_push($errors, "Combinación incorrecta de nombre de usuario/contraseña");
        }
    } -->