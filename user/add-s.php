<?php
session_start();
error_reporting(0);
include '../inc/checklogin.php';
checkLogin();
?>
<?php
include("../inc/config.php");
if(isset($_POST['submit'])){
  $sn=$_POST['sn'];
  $ref=str_shuffle(rand(uniqid(),99999999));
  $date=date("d-m-y @ g:i A");

$fd=mysqli_query($con,"SELECT * FROM user WHERE email='".$_SESSION['email']."'");
$pv=mysqli_fetch_array($fd);
$cn=$pv['name'];
$em=$pv['email'];

$da=mysqli_query($con,"insert into software_order(cname,cemail,software_name,payment_ref,payment_status,delivery_status,date) values('$cn','$em','$sn','$ref','0','0','$date')");
if ($da) {
$_SESSION['qmsg']='<div class="alert alert-success hide alert-dismissible fade show" role="alert">
  <strong>Software Order was successful....</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  $_SESSION['qmsg']='<div class="alert alert-danger hide alert-dismissible fade show" role="alert">
  <strong>Error Sending Order....</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

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



  <div id="wrapper">
<?php
include 'inc/sidebar.php';
?>


    <div id="content-wrapper">

<div class="container-fluid col-lg-12">
  <?php
               if (!empty($_SESSION['qmsg'])) {
                      echo $_SESSION['qmsg'];
                       $_SESSION['qmsg']="";
               }
         
               ?>
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Order Software</div>
      <div class="card-body">
       <form action="#" method="post">
        <br/>
          <div class="form-group">
 
              <label>Please choose software of choice below : </label>           
              <select name="sn" required="required" autofocus="autofocus" class="form-control" style="height: 60px;">
                <?php
                $rt=mysqli_query($con,"select * from software order by id desc");
                while ($f=mysqli_fetch_array($rt)) {
               ?>
                <option value="<?php echo $f['name'];  ?>"><?php echo $f['name'].' ('.$f['info'].' costs: ₦'.$f['price'].')';  ?></option>
<?php } ?>
              </select>
            
          </div>
         
<br/>
          <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" name="submit">Order Software</button>
          </div>
         
        </form>
        <div class="text-center">
         
        </div>
      </div>
    </div>
  </div>

      <!-- /.container-fluid -->
<!-- Main close -->

<?php
include 'inc/footer.php';
?>