<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="employeeController" data-ng-init="init()">
      <md-content>
        
                        <div class="file-upload">
					        <input type="file" file-model="myFile"/>
					        <button ng-click="uploadFile()">upload me</button>
					    </div>
                    
            </md-content>
          </md-tab>
        </md-tabs>

      </md-content>
    </div>  
  </section>
</div>

<?php
include '../footer.php';
include '../control_sidebar.php';
?>
<!-- End of div wrapper-->
</div>
<!-- End of body-->
</body>


<script>
var active = angular.element( document.querySelector( '#employeeTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })

app.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

// We can write our own fileUpload service to reuse it in the controller
app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file){
         var fd = new FormData();
         fd.append('file', file);
         $http.post('../queries/insert/insertPicture.php', fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
            console.log("Success");
         })
         .error(function(){
            console.log("Success");
         });
     }
 }]);

app.controller('employeeController', function($scope, $http, $mdDialog, SweetAlert) {
   
    $scope.uploadFile = function(){
        var file = $scope.myFile;
        console.log('file is ' );
        console.dir(file);

        fileUpload.uploadFileToUrl(file);
   };
});

</script>

<?php
// require ("../header.php");
// include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <!-- <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="checkinController" data-ng-init="init()">
      <md-content>
      <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Currently Checked-in" ng-click="">
            <md-content>
              <md-button class="md-raised" ng-click="init()">Refresh <span class="fa fa-refresh"></span></md-button>
              <md-list-item class="md-3-line rrList" ng-repeat="x in checkin">
                  <div id="rrListDiv">
                      <h3>{{x.Name}}</h3>
                      <span>{{x.CheckInMonth}} {{x.CheckInDay}}, {{x.CheckInYear}} - {{x.CheckOutMonth}} {{x.CheckOutDay}}, {{x.CheckOutYear}}</span>
                      <br>
                      <span>Adults: {{x.AdultQty}}</span>
                      <br>
                      <span>Children: {{x.ChildQty}}
                      <div class="acceptrejectDiv">
                          <md-button ng-click="checkoutModal(x.ReservationId, x.CheckInId, x.Name, x.CheckInMonth, x.CheckInDay, x.CheckInYear, 
                          x.CheckOutMonth, x.CheckOutDay, x.CheckOutYear, x.AdultQty, x.ChildQty)" style="background-color:red; color:white;" data-target="#checkout" data-toggle="modal">Check-Out</md-button>
                      </div>
                  </div>       
              </md-list-item>
  
            </md-content>
          </md-tab>
          <md-tab label="Create a Check-in" ng-click="">
            <md-content>
                <div id="Checkincreate">
                    <div>
                                <span>Create Check-in for </span>
                                <md-button class="md-accent md-raised" data-target="#userExist" data-toggle="modal" style="color:white; background-color:blue">Existing User</md-button>
                                <md-button  class="md-accent md-raised" data-target="#userNew" data-toggle="modal" style="color:white; background-color:green">New User</md-button>

            </div>
        </div>


      </md-content>
          </md-tab>
                                
      </md-tabs>
      
      <div id="checkout" class="modal fade" role="dialog">
            <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header createRoom">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Check-Out Invoice</h2>
                        </div>
                        <div class="modal-body">
                            
    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            {{mod.Name}}
          </h2>
        </div>
      </div>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            {{mod.CheckInMonth}} {{mod.CheckInDay}}, {{mod.CheckInYear}}
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          To
          <address>
            {{mod.CheckOutMonth}} {{mod.CheckOutDay}}, {{mod.CheckOutYear}}
          </address>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Room</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="room in mod.room">
                <td>{{room.Name}}</td>
                <td>{{room.Count}}</td>
                <td>{{room.Price}}</td>
                <td>{{room.Description}}</td>
                <td>{{room.Total}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Timestamp Ordered</th>
                <th>Order Completed</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="food in mod.food">
                <td>{{food.TimestampOrdered}}</td>
                <td>{{food.ResponseTime}}</td>
                <td>{{food.Price}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
       
        <div class="col-xs-6">
          <p class="lead">Amount Due</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Total:</th>
                <td>{{total}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      
    </section>
  </div>
                        <div class="modal-footer">
                          <md-button style="background-color:red; color:white;" ng-click="checkout(mod.ResId, mod.CheckInId)">Check-Out</md-button>
                        </div>
                    </div>
            </div>
        </div>
            </md-content>

                <div id="userNew" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form ng-submit="createCheckin()">
                                    <div class="modal-content">
                                        <div class="modal-header userNew">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h2>Create Check-In</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div id="newUser">
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
                                              <md-input-container>
                                                  <label>Number of Adults</label>
                                                  <input type="number" class="form-control" ng-model="adult_qty" required>
                                              </md-input-container>
                                              <md-input-container>
                                                  <label>Number of Children</label>
                                                  <input type="number" class="form-control" ng-model="child_qty" required>
                                              </md-input-container>
                                              <br>
                                              <md-input-container>
                                                <label>Gender</label>
                                                <md-select ng-model="gender">
                                                    <md-option>Male</md-option>
                                                    <md-option>Female</md-option>
                                                </md-select>
                                              </md-input-container>
                                              <md-datepicker ng-model="checkin_date" md-placeholder="Check-in Date" required></md-datepicker>
                                              <md-datepicker ng-model="checkout_date" md-placeholder="Check-out Date" required></md-datepicker>
                                              <md-datepicker ng-model="birthDate" md-placeholder="Birth date" required></md-datepicker>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn createRoomType" onclick="$('#userNew').modal('hide');">Create Check-in <span class="fa fa-check"></span></button>
                                            <button type="button" class="btn btn-danger" onclick="$('#userNew').modal('hide');">Close <span class="fa fa-close"></span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
           

           <div id="userExist" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="createCheckin()">
                    <div class="modal-content">
                        <div class="modal-header userExist">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Create Check-In</h2>
                        </div>
                        <div class="modal-body">
                            <div id="existingUser">
                                  <select class="form-control" placeholder="Users" ng-model="user" required>
                                    <option ng-repeat="x in users" value="{{x.id}}">{{x.name}}</option>
                                  </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn createRoomType" onclick="$('#userExist').modal('hide');">Create Check-in <span class="fa fa-check"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#userExist').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
          </div>
                    </div>
          
    </div>  
  </section>
</div>

<?php
include '../footer.php';
include '../control_sidebar.php';
?>
<!-- End of div wrapper-->
</div>
<!-- End of body-->
</body>

<script>
// var active = angular.element( document.querySelector( '#checkinTab' ) );
// active.addClass('active');

// var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
// app.config(function(cfpLoadingBarProvider) {
//     cfpLoadingBarProvider.includeSpinner = true;
//   })
// app.controller('checkinController', function($scope, $http, $mdDialog, SweetAlert) {
//   $scope.mod = {
//         $ResId: "",
//         $CheckInId: "",
//         $Name: "",
//         $CheckInMonth: "",
//         $CheckInDay: "",
//         $CheckInYear: "",
//         $CheckOutMonth: "",
//         $CheckOutDay: "",
//         $CheckOutYear: "",
//         $AdultQty: "",
//         $ChildQty: "",
//         $CheckInYear: "",
//         $room: "",
//         $food: ""
//     };

//   $scope.init = function(){
//     $http.get("../queries/get/getCurrentlyCheckedIn.php").then(function (response){
//       $scope.checkin = response.data.records;
//     })
//     $http.get("../queries/get/getUserAccount.php").then(function (response){
//       $scope.users = response.data.records;
//       console.log($scope.users);
//     })
//   };
//   $scope.createCheckin = function(){
//     $http.post('../queries/insert/insertRoomType.php', {
//      'fn':$scope.firstName,
//      'mi':$scope.middleInitial,
//      'ln':$scope.lastName,
//      'email':$scope.email,
//      'bday':$scope.birthDate,
//      'gender':$scope.gender,
//      'cnum':$scope.contactNo,
//      'pass':$scope.password,
//      'checkin_date':$scope.checkin_date,
//      'checkout_date':$scope.checkout_date,
//      'adult_qty':$scope.adult_qty,
//      'child_qty':$scope.child_qty,
//      'user_id':$scope.user,
//      'room_id':$scope.room_id
//     }.then(function(response){
//       console.log(response.data);
//       }
//     });
//   $scope.checkoutModal = function($res, $checkin, $name, $cimonth, $ciday, $ciyear, $comonth, $coday, $coyear, $adult, $child){
//     $scope.mod.ResId = $res;
//     $scope.mod.CheckInId = $checkin;
//     $scope.mod.Name = $name;
//     $scope.mod.CheckInMonth = $cimonth;
//     $scope.mod.CheckInDay = $ciday;
//     $scope.mod.CheckInYear = $ciyear;
//     $scope.mod.CheckOutMonth = $comonth;
//     $scope.mod.CheckOutDay = $coday;
//     $scope.mod.CheckOutYear = $coyear;
//     $scope.mod.AdultQty = $adult;
//     $scope.mod.ChildQty = $child;
//     $scope.total = 0;
//     $http.get("../queries/get/getRoomReservedFromCheckIn.php?check_in_id="+$checkin).then(function(response){
//       $scope.mod.room = response.data.records;
//       for($x=0; $x<$scope.mod.room.length; $x++){
//         $scope.total += parseFloat($scope.mod.room[$x].Total);
//       }
//     })
//     $http.get("../queries/get/getAllFoodOrderFromCheckIn.php?check_in_id="+$checkin).then(function(response){
//       $scope.mod.food = response.data.records;
//       for($x=0; $x<$scope.mod.food.length; $x++){
//         $scope.total += parseFloat($scope.mod.room[$x].Total);
//       }
//     })
//   }


//   $scope.checkout = function($res, $checkin){
//     $http.post("../queries/update/checkoutReservation.php", {
//      'id': $res
//     }).then(function (data, status){
//       $http.post("../queries/update/checkout.php", {
//        'id': $checkin
//       }).then(function (data, status){
//         $http.get("../queries/get/getCurrentlyCheckedIn.php").then(function (response){
//           $scope.checkin = response.data.records;
//         })
//         SweetAlert.swal("Success!", "You have checked-out the guest!", "error");
//       })
//     })
//   }
// });
</script> -->