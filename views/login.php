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
  <script src="../includes/js/sweetalert2.min.js"></script>
  
  <link rel="stylesheet" href="../includes/css/style.css">
  <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
  <link rel="stylesheet" href="../includes/css/font-awesome.min.css">
  <link rel="stylesheet" href="../includes/css/ionicons.min.css">
  <link rel="stylesheet" href="../includes/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../includes/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../includes/css/sweetalert2.min.css">
  <!--<link rel="stylesheet" href="../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  
  
  <link rel="stylesheet" href="../includes/css/angular-material.min.css">
</head>
<body>
	<div class="content-wrapper" ng-app="unwindApp">
		<div ng-controller="loginCtrl">
			<div>
				<div class="login-box">
					<md-content>
						<div>
					         	<!-- /.box-header -->
					        	<!-- form start -->
					        <div class="login-box-body">
					        <form ng-submit="checkUser()">
						        Username:<input type="text" id="username" class="form-control" ng-model="username" required>
						        Password:<input type="password" id="password" class="form-control" ng-model="password" required>
					            <!-- /.box-body -->
					            No existing account?<a href="register.php">Register here.</a><br>
					            <button type="submit" class="btn btn-default">Cancel</button>
					            <button type="submit" class="btn btn-info pull-right">Sign in</button>
					            <!-- /.box-footer -->
					        </form>
					    	</div>
					    </div>	
					</md-content>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
var app = angular.module('unwindApp', ['ngMaterial']);

app.controller('loginCtrl', function($scope, $http) {
	$scope.checkUser = function(){	
    	$http.post('../queries/get/getUser.php', {
            'username': $scope.username,
            'password': $scope.password  
        }).then(function(response){
        	console.log(response);
            if(response.data==1){
            	window.location.assign("home.php");
            }else{
            	alert("Incorrect username or password");
            }
        })
    };
});
</script>
</html>
