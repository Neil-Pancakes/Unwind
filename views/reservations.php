<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
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
                    <button class="btn btn-success">Accept</button>
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

    $scope.insertReservation = function(){
        
    }
});
</script>