<?php
require ("../header.php");
include '../sidebar.php';
?>

 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
      <md-content>
        <md-list-item class="md-3-line rrList" ng-repeat="x in pending">
            <div id="rrListDiv">
                <h3>{{x.Name}}</h3>
                <span>{{x.CheckInMonth}} {{x.CheckInDay}}, {{x.CheckInYear}} - {{x.CheckOutMonth}} {{x.CheckOutDay}}, {{x.CheckOutYear}}</span>
                <br>
                <span>Adults: {{AdultQty}}</span>
                <br>
                <span>Children: {{ChildQty}}
                <div class="acceptrejectDiv">
                    <button class="btn btn-success" ng-click="acceptReservation(x.ReservationRequestId)">Accept</button>
                    <button class="btn btn-danger">Reject</button>
                </div>
            </div>       
        </md-list-item>
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

var app = angular.module('unwindApp', ['ngMaterial', 'doowb.angular-pusher']);
app.config(['PusherServiceProvider',
  function(PusherServiceProvider) {
    PusherServiceProvider
    .setToken('c6d79884ae59d5152965')
    .setOptions({
        cluster: 'ap2'
    });
  }
]);


app.controller('floorController', function($scope, $http, $mdDialog, $interval, Pusher) {
    
    $scope.items = [];
    Pusher.subscribe('items', 'updated', function (item) {
    // an item was updated. find it in our list and update it.
        for (var i = 0; i < $scope.items.length; i++) {
        if ($scope.items[i].id === item.id) {
            $scope.items[i] = item;
            break;
        }
        }
    });

    var retrieveItems = function () {
    // get a list of items from the api located at '/api/items'
        $http.get('../queries/get/getPendingReservations.php').then(function (items) {
            $scope.items = items;
        });
    };

    $scope.updateItem = function (item) {
        $http.post('../queries/get/getPendingReservations.php', item);
     };

    retrieveItems();

    $scope.init = function () {
        $http.get("../queries/get/getPendingReservations.php").then(function (response) {
           $scope.pending = response.data.records;
           
        });
    };
    /*
    $interval(function(){
        $scope.init();
    }, 5000);*/

    $scope.acceptReservation = function($id, $room_qty){
        $http.post('../queries/update/acceptReservationRequest.php', {
            'id': $id,
        }).then(function(data, status){
            $scope.insertReservation($id);
            $scope.insertRoomReserved($id, $room_qty);
            $scope.init();
        })
    };

    $scope.rejectReservation = function(){
        $http.post('../queries/update/rejectReservationRequest.php', {
            'id': $scope.requestId,
        }).then(function(data, status){
            $scope.init();
        })
    };

    $scope.insertReservation = function($id){
        $http.post('../queries/insert/insertReservation.php', {
            'reservation_request_id': $id,
        }).then(function(data, status){
        })
    }

    $scope.insertRoomReserved($reservationId, $room_qty){
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
    }
});
</script>