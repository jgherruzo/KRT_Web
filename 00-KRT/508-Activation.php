<?php

$conn=mysqli_connect('localhost','root','','krt_users');

$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$c=mysqli_query($conn,"SELECT Id FROM users WHERE Code='$code'");

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($conn,"SELECT Id FROM users WHERE code='$code' and Estado='0'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($conn,"UPDATE users SET Estado='1' WHERE code='$code'");
$msg="Your account is activated"; 
}
else
{
$msg ="Your account is already active, no need to activate again";
}

}
else
{
$msg ="Wrong activation code.";
}

}
?>

<?php echo $msg; ?>