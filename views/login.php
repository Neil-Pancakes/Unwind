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
  <!--<link rel="stylesheet" href="../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  
  
  <link rel="stylesheet" href="../includes/css/angular-material.min.css">
</head>
<body style="background-image:url('../includes/img/rumah/rumah3.jpg'); background-size:100% 100%;">
	<div ng-app="unwindApp" >
		<div ng-controller="loginCtrl">
			
      <div class="container">
          <div class="card card-container" style="opacity:0.9; margin-top:12%;">
              <img id="profile-img" class="profile-img-card" src="../includes/img/logo2.png" />
              <p id="profile-name" class="profile-name-card"></p>
              <form class="form-signin" ng-submit="checkUser()">
                  <span id="reauth-email" class="reauth-email"></span>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" ng-model="email" required autofocus>
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" ng-model="password" required>
                  
                  <button class="btn btn-lg btn-primary btn-block btn-signin" style="background-color:#800300" type="submit">Sign in</button>
              </form>
          </div>
      </div>
		</div>
	</div>
</body>
<script>
var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('loginCtrl', function($scope, $http, $mdDialog, SweetAlert) {
	$scope.checkUser = function(){	
    	$http.post('../queries/get/getUser.php', {
            'email': $scope.email,
            'password': $scope.password  
        }).then(function(response){
        	if(response.data==1){
            window.location.assign("home.php");
          }else{
            alert("Login Failed!");
          }
        })
    };
});
</script>
</html>
