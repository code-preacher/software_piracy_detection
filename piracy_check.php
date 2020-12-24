<?php
session_start();
error_reporting(0);
include("inc/config.php");
$cn=$_GET['cn'];
$lk=$_GET['lk'];
?>

<?php

$vb=mysqli_query($con,"select licence_key,name from software where licence_key='$lk'");
$vx=mysqli_num_rows($vb);
$vz=mysqli_fetch_array($vb);
$sn=$vz['name'];
$ls=$vz['licence_key'];
$date=date("d-m-y @ g:i A");
//check for existence
if ($vx>0) {
$zb=mysqli_query($con,"select * from software_usage where licence_key='$ls'");
$zx=mysqli_num_rows($zb);
$zw=mysqli_fetch_array($zb);
$cp=$zw['computer_name'];
$lsk=$zw['licence_key'];

if ($cp==$cn && $lsk==$lk) {
 $_SESSION['psg']='<div class="alert alert-primary hide alert-dismissible fade show" role="alert">
  <strong>This software is Licenced to you '.$cn.'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

//check for usage
else if ($zx<1) {
 $_SESSION['psg']= '<div class="alert alert-success hide alert-dismissible fade show" role="alert">
  <strong>Thank you for purchasing our software....</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>'.'<div class="alert alert-primary hide alert-dismissible fade show" role="alert">
  <strong>This software is Licenced to '.$cn.'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
mysqli_query($con,"insert into software_usage(software_name,computer_name,licence_key,activation_date) values('$sn','$cn','$lk','$date')");
}
else{
 $_SESSION['psg']= '<div class="alert alert-info hide alert-dismissible fade show" role="alert">
  <strong>This software is Licenced to '.$cp.' and, it is not to be pirated. Please purchase your own copy...</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

}

else if ($lk=='NAITES') {
 $_SESSION['psg']='<div class="alert alert-primary hide alert-dismissible fade show" role="alert">
  <strong>You are running this software on Trial Mode '.$cn.'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

 else{
 $_SESSION['psg']= '<div class="alert alert-danger hide alert-dismissible fade show" role="alert">
  <strong>Invalid Licence Key, please purchase one....</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SOFTWARE PIRACY SYSTEM</title>

  <?php
include 'inc/header.php';
  ?>

<marquee behavior="alternate" scrollDelay="10">
  <div class="alert alert-success hide alert-dismissible fade show" role="alert">
  <strong>Welcome to software piracy system....</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</marquee>

  <div id="wrapper">



    <div id="content-wrapper">

<div class="container-fluid col-lg-4">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Software Status</div>
      <div class="card-body">
      
      <?php
               if (!empty($_SESSION['psg'])) {
                      echo $_SESSION['psg'];
                       $_SESSION['psg']="";
               }
         
               ?>
        <div class="text-center">
         
        </div>
      </div>
    </div>
<br/>

  </div>



      <!-- /.container-fluid -->
<!-- Main close -->

<?php
include 'inc/footer.php';
?>