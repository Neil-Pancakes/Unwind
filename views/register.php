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
					        <form ng-submit="registerUser()">
						            <div>
                                <div>
                                    <md-input-container>
                                        <label>First Name</label>
                                        <input type="text" class="form-control" ng-model="firstName" required>
                                    </md-input-container>
                                    <md-input-container>
                                        <label>Middle Initial</label>
                                        <input type="text" class="form-control" max-length="1" ng-model="middleInitial" required>
                                    </md-input-container>
                                    <md-input-container>
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" ng-model="lastName" required>
                                    </md-input-container>

                                    <md-input-container>
                                        <label>Email</label>
                                        <input type="text" class="form-control" ng-model="email" required>
                                    </md-input-container>
                                    
                                    <md-input-container>
                                        <label>Password</label>
                                        <input type="password" class="form-control" ng-model="password" required>
                                    </md-input-container>
                                    <md-input-container>
                                        <label>Number</label>
                                        <input type="number" class="form-control" ng-model="contactNo" required>
                                    </md-input-container>
                                    <br>
                                    <md-input-container>
                                      <label>Gender</label>
                                      <md-select ng-model="gender">
                                          <md-option>Male</md-option>
                                          <md-option>Female</md-option>
                                      </md-select>
                                    </md-input-container>
                                    <md-datepicker ng-model="birthDate" md-placeholder="Birth date" required></md-datepicker>
                                </div>
                            </div>
                            <md-button type="submit" class="md-raised md-primary">Create Employee <span class="fa fa-check"></span></button>
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
	$scope.registerUser = function(){	
    	$http.post('../queries/insert/registerUser.php', {
            'password':$scope.password,
            'firstName':$scope.firstName,
            'middleInitial':$scope.middleInitial,
            'lastName':$scope.lastName,
            'email':$scope.email,
            'contactNo':$scope.contactNo,
            'gender':$scope.gender,
            'birthDate': $scope.birthDate
        }).then(function(response){
        	console.log(response);
          window.location.assign("login.php");
        })
    };
});
</script>
</html>