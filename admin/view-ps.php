<?php 
ob_start();
session_start();
include '../inc/checklogin.php';
checkLogin();
include('../inc/config.php');
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

<!-- Main open -->
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View Payed-Used Software</li>
        </ol>



<!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-check-circle"></i>
            ALL PAYED/USED SOFTWARES</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Software Name</th>
                    <th>Computer Name</th>
                    <th>Licence Key</th>
                    <th>Date of Activation</th>
                    <th>Delete</th>
                   

                  </tr>
                </thead>
                
                <tbody>
<?php

 $seat=mysqli_query($con,"SELECT * FROM software_usage order by id desc");
 while($dy=mysqli_fetch_array($seat)){
?>
                  <tr>
                   <td><?php echo $dy['software_name']; ?></td>
                    <td><?php echo $dy['computer_name']; ?></td>
                    <td><?php echo $dy['licence_key']; ?></td>

                  <td><?php echo $dy['activation_date']; ?></td>
                  <td><a href="del-ps.php?id=<?php echo $dy['id']; ?>" onClick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a></td>
                  
                  </tr>
                <?php
}
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
<!-- Main close -->

<?php
include 'inc/footer.php';
?>