<?php

$conn=mysqli_connect('localhost','root','','krt_users');

$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$c=mysqli_query($conn,"SELECT Id FROM users WHERE Code='$code'");

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($conn,"SELECT Id FROM users WHERE code='$code' and Cambio='1'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($conn,"UPDATE users SET Cambio='0' WHERE code='$code'");
$msg="Cambio de contraseña activado, recuerda que debes volver a poner el email en el formulario de cambio de contraseña"; 
}
else
{
$msg ="El cambio de contraseña ya está activado";
}

}
else
{
$msg ="Error en el codigo de activación.";
}

}
?>

<?php echo $msg; ?>