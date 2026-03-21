<?php

session_start();
include("conexion.php");

$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM usuarios WHERE email='$email'";
$result=$conn->query($sql);

if($result->num_rows>0){

$usuario=$result->fetch_assoc();

if(password_verify($password,$usuario['password'])){

$_SESSION['usuario']=$usuario['nombre'];
$_SESSION['rol']=$usuario['rol_id'];

if($usuario['rol_id']==1){

header("Location: admin/dashboard.php");

}else{

header("Location: usuario/perfil.php");

}

}else{

echo "Contraseña incorrecta";

}

}else{

echo "Usuario no encontrado";

}

?>
