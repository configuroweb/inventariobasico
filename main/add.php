<?php
session_start();
require_once "../Database/Database.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));
$sql = "SELECT username FROM user WHERE username ='" . $username . "'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
if ($result) {
    echo "<script>alert('Usuario actualmente está en uso')</script>";
    header("Refresh:0 , url = member.html");
    exit();
}else{
if ($_POST['username'] != null && $_POST['password'] != null && $_POST['name'] != null && $_POST['cfpassword'] != null && $_POST['cfpassword'] == $_POST['password']) {
    $sql = "INSERT INTO user (username,password,name) VALUES ('" . trim($_POST['username']) . "','" . trim(md5($_POST['password'])) . "','" . trim($_POST['name']) . "')";
    if ($conn->query($sql)) {
        echo "<script>alert('Registro completado exitósamente')</script>";
        header("Refresh:0 , url = ../index.html");
        exit();
    } else {
        echo "<script>alert('Registro incompleto')</script>";
        header("Refresh:0 , url = member.html");
        exit();
    }
} else {
    echo "<script>alert('Los campos de contraseña no coinciden')</script>";
    header("Refresh:0 , url = member.html");
    exit();
}
    mysqli_close($conn);
}
