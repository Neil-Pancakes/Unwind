<?php
require ("../header.php");
include '../sidebar.php';
/*
require(dirname(__FILE__).'/../vendor/autoload.php');
$pusher = new Pusher('c6d79884ae59d5152965', '5c63ac5939edc6da56dd', '449720');
$text = "Ayyyy Lmao";
$data['message'] = $text;
$pusher->trigger('notifications', 'new_notification', $data);*/

?>
<!-- Reservations
 Services
 Reports
 Inquiries
 Feedback
 Food
 Employees

Fatal error: Class 'Pusher' not found in C:\xampp\htdocs\Unwind\views\reservations.php on line 5
<input class="create-notification" placeholder="Send a notification :)"></input>
<button class="submit-notification">Go!</button>-->
<div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="reservationController" data-ng-init="init()">
      <md-content>
      <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Pending Reservation Requests">
            <md-content>
                
                <md-button class="md-raised" ng-click="init()">Refresh <span class="fa fa-refresh"></span></md-button>
                <md-list-item class="md-3-line rrList" ng-repeat="x in pending">
                    <div id="rrListDiv">
                        <h3>{{x.Name}}</h3>
                        <span>{{x.CheckInMonth}} {{x.CheckInDay}}, {{x.CheckInYear}} - {{x.CheckOutMonth}} {{x.CheckOutDay}}, {{x.CheckOutYear}}</span>
                        <br>
                        <span>Adults: {{x.AdultQty}}</span>
                        <br>
                        <span>Children: {{x.ChildQty}}
                        <div class="acceptrejectDiv">
                            <button class="btn btn-success" ng-click="acceptReservation(x.ReservationRequestId)">Accept</button>
                            <button class="btn btn-danger" ng-click="rejectModal(x.ReservationRequestId)" data-target="#reject" data-toggle="modal">Reject</button>
                        </div>
                    </div>       
                </md-list-item>
    
            </md-content>
          </md-tab>

          <md-tab label="Upcoming Reservations">
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
                            <md-button class="md-raised md-primary" ng-click="checkinReservation(x.ReservationId)">Check-In</md-button>
                            <md-button style="background-color:red; color:white;" ng-click="cancelReservation(x.ReservationId)">Cancel</md-button>
                        </div>
                    </div>       
                </md-list-item>
            </md-content>
          </md-tab>
      </md-tabs>
      
      <div id="reject" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form ng-submit="sendReject()">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#003300; color:white;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2>Reject Reservation</h2>
                                </div>
                                <div class="modal-body">
                                    <input ng-model="mod.Id" required hidden>
                                    <textarea class="form-control" placeholder="Why did you reject the Reservation?" ng-model="mod.Message" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning" onclick="$('#reject').modal('hide');">Reject the request <span class="fa fa-edit"></span></button>
                                    <button type="button" class="btn btn-danger" onclick="$('#reject').modal('hide');">Close <span class="fa fa-close"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
var active = angular.element( document.querySelector( '#reservationsTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('reservationController', function($scope, $http, $mdDialog, SweetAlert) {

    $scope.init = function () {
        $http.get("../queries/get/getPendingReservations.php").then(function (response) {
           $scope.pending = response.data.records;
           
        });
        $http.get("../queries/get/getUpcomingCheckIn.php").then(function (response){
                $scope.checkin = response.data.records;
            })
    };

    $scope.acceptReservation = function($id){
        $http.post('../queries/update/acceptReservationRequest.php', {
            'id': $id,
        }).then(function(data, status){
            $scope.insertReservation($id);
            $http.get("../queries/get/getPendingReservations.php").then(function (response) {
                $scope.pending = response.data.records;
                
            });
            SweetAlert.swal("Success!", "You Accepted the Request", "success");
        })
    };

    $scope.rejectReservation = function($id){
        $http.post('../queries/update/rejectReservationRequest.php', {
            'id': $id,
        }).then(function(data, status){
        })
    };

    $scope.checkinReservation = function($id){
        $http.post('../queries/update/checkinReservation.php', {
            'id': $id,
        }).then(function(data, status){
            $http.post('../queries/insert/insertCheckIn.php', {
                'id': $id,
            }).then(function(data, status){
                
                $http.get("../queries/get/getPendingReservations.php").then(function (response) {
                    $scope.pending = response.data.records;
                });
                $http.get("../queries/get/getUpcomingCheckIn.php").then(function (response){
                    $scope.checkin = response.data.records;
                })
            })
            SweetAlert.swal("Success!", "Guest was checked in!", "success");
        })
    };

    $scope.cancelReservation = function($id){
        $http.post('../queries/update/cancelReservation.php', {
            'id': $id,
        }).then(function(data, status){
            $http.get("../queries/get/getPendingReservations.php").then(function (response) {
                $scope.pending = response.data.records;
           
            });
            
            $http.get("../queries/get/getUpcomingCheckIn.php").then(function (response){
                $scope.checkin = response.data.records;
            })
            SweetAlert.swal("Success!", "You cancelled his reservation!", "error");
        })
    };


    $scope.insertReservation = function($id){
        $http.post('../queries/insert/insertReservation.php', {
            'reservation_request_id': $id,
        }).then(function(data, status){
            $http.get("../queries/get/getPendingReservations.php").then(function (response) {
                $scope.pending = response.data.records;
           
            });
        })
    };

    $scope.insertRoomReserved = function($reservationId, $room_qty){
        $http.get("../queries/get/getAvailableRooms.php").then(function (response) {
            $scope.availableRooms = response.data.records;
            for($x=0; $x<$room_qty; $x++){
                $http.post('../queries/insert/insertRoomReserved.php', {
                'reservation_id': $reservationId,
                'room_id': $scope.availableRooms[$x]
                }).then(function(data, status){
                })
            }
        });
    };

    $scope.mod = {
        $Id: "",
        $Message: ""
    };

    
    $scope.rejectModal = function($id) {
        $scope.mod.Id = $id;
    };

    $scope.sendReject = function(){
        $http.post('../queries/insert/insertReservationReject.php', {
            'id': $scope.mod.Id,
            'message': $scope.mod.Message
        }).then(function(data, status){
            $scope.rejectReservation($scope.mod.Id);
            $scope.init();
            SweetAlert.swal("Success!", "You Rejected the Request", "error");
        })
    };
});
</script>