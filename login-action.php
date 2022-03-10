<?php 
    session_start();
    include('_connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE username='$username' AND password = '$password'";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if(mysqli_num_rows($query) >= 1){
        $login = mysqli_fetch_array($query);
        $_SESSION["id"] = $login["id"];
        $_SESSION["username"] = $login["username"];
        header("location: index.php?page=admin");
    }else{
        header("Location: login.php");
    }
?>