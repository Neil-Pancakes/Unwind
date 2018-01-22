<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
  <input ng-model="checkInId" ng-init="checkInId = '<?php if(isset($_GET['checkInId'])){echo $_GET['checkInId'];}else{echo "";}?>'" hidden>
    <div ng-cloak ng-controller="serviceController" data-ng-init="init()">
      <md-content>
            <h3>Service Requests from {{user[0].Name}}</h3>
            <md-list flex>
                <md-list-item class="md-3-line rrList" ng-click="null" ng-repeat = "x in requestList track by $index">
                  <div>
                    {{x.Name}}
                    <span><small>({{x.ServiceRequestMonth}} {{x.ServiceRequestDay}}, {{x.ServiceRequestYear}})</small></span><br>
                    <strong>{{x.ServiceName}}</strong>
                    ({{x.ServiceType}})<br>
                    <div ng-if="x.ServiceRequestStatus=='Pending'">
                        <button class="btn btn-success" ng-click="acceptServiceRequest(x.ServiceRequestId, x.ServiceName, x.Name)">Accept <span class="fa fa-check"></button>
                        <button class="btn btn-danger" ng-click="rejectServiceRequest(x.ServiceRequestId, x.ServiceName, x.Name)">Reject <span class="fa fa-close"></button>
                    </div>
                    <div ng-if="x.ServiceRequestStatus=='Waiting'">
                        <button class="btn btn-warning" ng-click="completeServiceRequest(x.ServiceRequestId, x.ServiceName, x.Name)">Complete Service Request <span class="fa fa-check-square-o"></span></button>
                    </div>
                  </div>  
                </md-list-item>
            <md-list>  
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
var active = angular.element( document.querySelector( '#servicesTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('serviceController', function($scope, $http, $mdDialog, SweetAlert) {
 
    $scope.init = function () {
        $scope.serviceName=$scope.serviceType="";
        $http.get("../queries/get/getUserFromRoomId.php?roomId="+$scope.checkInId).then(function (response) {
          $scope.user = response.data.records;
          
        });
        if($scope.checkInId==""){
            $http.get("../queries/get/getServiceRequest.php").then(function (response){
                $scope.requestList = response.data.records;
            });
        }else{
            $http.get("../queries/get/getServiceRequestFromCheckIn.php?check_in_id="+$scope.checkInId).then(function (response){
                $scope.requestList = response.data.records;
            });
        }
    };

    $scope.acceptServiceRequest = function($id, $service, $name){
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Do you want to accept "+$service+" request made by "+$name,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Accept!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
         function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/updateServiceRequestWaiting.php', {
                    'id': $id,
                }).then(function(data, status){
                    $scope.init();
                    SweetAlert.swal("Accept Successful!", "You accepted the service request", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You didn't accept the request", "error");
            }
         });
    };

    $scope.rejectServiceRequest = function($id, $service, $name){
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Do you want to reject "+$service+" request made by "+$name,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Accept!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
         function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/updateServiceRequestRejected.php', {
                    'id': $id,
                }).then(function(data, status){
                    $scope.init();
                    SweetAlert.swal("Reject Successful!", "You rejected the service request", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You didn't reject the request", "error");
            }
         });
    };

    $scope.completeServiceRequest = function($id, $service, $name){
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Is the "+$service+" made by "+$name+" Completed?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "It's Completed!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
        function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/updateServiceRequestCompleted.php', {
                    'id': $id,
                }).then(function(data, status){
                    $scope.init();
                    SweetAlert.swal("Service Completed!", $service+" was completed", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You didn't confirm that the service was completed", "error");
            }
        });
    };
});
</script>