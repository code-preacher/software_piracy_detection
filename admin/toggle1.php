<?php
ob_start();
session_start();
error_reporting(0);
include '../inc/checklogin.php';
checkLogin();
$id=$_GET['id'];
?>
<?php
include '../inc/config.php';

$ret=mysqli_query($con,"SELECT * FROM software_order where id='$id'");
$row=mysqli_fetch_array($ret);
$idp=$row['id'];
$apm=$row['payment_status'];


 if($apm=='0'){
mysqli_query($con,"UPDATE software_order SET payment_status='1' WHERE id='$idp'");
 }            
 elseif($apm=='1'){
mysqli_query($con,"UPDATE software_order SET payment_status='0' WHERE id='$idp'");
 }
 elseif($apm==''){
mysqli_query($con,"UPDATE software_order SET payment_status='0' WHERE id='$idp'");
 }
 header('location: view-os.php');



?>

