<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Unwind | Home</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  
  <script src="../includes/js/angular.min.js"></script>
  <script src="../includes/js/angular-animate.min.js"></script>
  <script src="../includes/js/angular-aria.min.js"></script>
  <script src="../includes/js/angular-messages.min.js"></script>
  <script src="../includes/js/angular-material.min.js"></script>
  <script src="../includes/js/moment.js"></script>
  <script src="../bower_components/angular-pusher/angular-pusher.min.js" type="text/javascript"></script>
  <script src="../includes/js/SweetAlert.min.js"></script>
  <script src="../includes/js/sweetalert.js"></script>
  <script src="../includes/js/Chart.min.js"></script>
  <script src="../includes/js/angular-chart.min.js"></script>
  <script src='../includes/js/loading-bar.min.js' type='text/javascript'></script>
  
  <link rel="stylesheet" href="../includes/css/style.css">
  <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
  <link rel="stylesheet" href="../includes/css/font-awesome.min.css">
  <link rel="stylesheet" href="../includes/css/ionicons.min.css">
  <link rel="stylesheet" href="../includes/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../includes/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../includes/css/sweetalert.css">
  <link rel='stylesheet' href='../includes/css/loading-bar.min.css' type='text/css' media='all' />
  
  
  <link rel="stylesheet" href="../includes/css/angular-material.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
      <a href="../../index2.html" class="logo">
        
        <span class="logo-mini"><b>UWD</b></span>
        <span class="logo-lg"><img src="../includes/img/logo2.png" style="height:40px; width:40px;">  <b>UNWIND</b></span>
      </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo $_SESSION['picture'];?>" class="user-image">
              <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $_SESSION['picture'];?>" class="img-circle">
                <p>
                  <?php echo $_SESSION['name']; ?>
                  <small><?php echo $_SESSION['position']; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  
