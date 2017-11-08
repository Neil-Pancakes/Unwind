<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
      <md-content>
        <md-list-item class="md-3-line" ng-repeat="x in pending">
            <div>
                <h3>{{x.Name}}</h3>
                <span>{{x.ReservationRequestDate}}</span>
                <span ng-model="requestId">{{x.ReservationRequestId}}</span>
                <button class="btn btn-success">Accept</button>
                <button class="btn btn-danger">Reject</button>
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
var app = angular.module('unwindApp', ['ngMaterial']);
app.controller('floorController', function($scope, $http, $mdDialog) {
    $scope.init = function () {
        $http.get("../queries/get/getPendingReservations.php").then(function (response) {
           $scope.pending = response.data.records;
        });
    };

    $scope.acceptReservation = function(){
        $http.post('../queries/update/acceptReservationRequest.php', {
            'id': $scope.requestId,
        }).then(function(data, status){
            $scope.init();
            $scope.showEdit();
        })
    };

    $scope.rejectReservation = function(){
        $http.post('../queries/update/rejectReservationRequest.php', {
            'id': $scope.requestId,
        }).then(function(data, status){
            $scope.init();
            $scope.showEdit();
        })
    };
});
</script>