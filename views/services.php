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
        
        <md-tabs md-dynamic-height md-border-bottom>
          <md-tab label="Service List">
            <md-content>
                <div>
                    <md-button class="md-raised" style="color:white; background-color:green" data-target="#insertService" data-toggle="modal">Add Service</md-button>
                </div>

                <div id="insertService" class="modal fade" role="dialog" ng-hide="serviceModal">
                    <div class="modal-dialog">
                        <form ng-submit="createService()">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#003300; color:white;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2>Create Service</h2>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" placeholder="Service Name" ng-model="serviceName" required>
                                    <select class="form-control" ng-model="serviceType" required>
                                        <option value="" hidden disabled selected>Choose Service Type</option>
                                        <option value="Cleaning">Cleaning</option>
                                        <option value="Restock">Restock</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" onclick="$('#insertService').modal('hide');">Create Service <span class="fa fa-check"></span></button>
                                    <button type="button" class="btn btn-danger" onclick="$('#insertService').modal('hide');">Close <span class="fa fa-close"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div ng-cloak layout-gt-sm="row" layout="column">
                
    <div flex-gt-sm="50" flex >

        <md-toolbar layout="row" class="md-hue-3">
        <div class="md-toolbar-tools">
            <span>Cleaning</span>
        </div>
        </md-toolbar>

        <md-content>
            <md-list flex>
                <md-list-item class="md-3-line rrList" ng-repeat = "x in serviceList track by $index" ng-click="null" ng-if="x.ServiceType=='Cleaning'" style="border: 1px solid grey;">
                    <div>
                        <div>{{x.ServiceName}}</div>
                    </div>  
                </md-list-item>
            </md-list>
        </md-content>
    </div>
    <md-divider></md-divider>
    <div flex-gt-sm="50" flex>

        <md-toolbar layout="row" class="md-hue-3">
        <div class="md-toolbar-tools">
            <span>Restock</span>
        </div>
        </md-toolbar>

        <md-content>
            <md-list flex>
                <md-list-item class="md-3-line rrListB" ng-repeat = "x in serviceList track by $index" ng-click="null" ng-if="x.ServiceType=='Restock'" style="border: 1px solid grey;">
                    <div>
                        <div>{{x.ServiceName}}</div>
                    </div>  
                </md-list-item>
            </md-list>
        </md-content>
    </div>
                
            </md-content>
          </md-tab>
          <md-tab label="Service Requests">
            <md-content>
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
          </md-tab>
        </md-tabs>
      </md-content>
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

        $http.get("../queries/get/getServices.php").then(function (response){
            $scope.serviceList = response.data.records;
            
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

    $scope.createService = function() {
        $http.post('../queries/insert/insertService.php', {
            'serviceName': $scope.serviceName,
            'serviceType': $scope.serviceType
        }).then(function(data, status){
          $scope.init();
          SweetAlert.swal("Success!", "You Created a Service", "success");
        })
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